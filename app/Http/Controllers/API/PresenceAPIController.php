<?php

namespace App\Http\Controllers\API;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Presence\PermissionRequest;
use App\Http\Requests\Presence\StorePresenceRequestAPI;
use App\Http\Requests\Presence\UpdatePresenceRequestAPI;
use App\Models\Presence;
use App\Models\StructuralPosition;
use App\Models\Structure;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresenceAPIController extends Controller
{
    public function index()
    {
        return $this->responseData([
            'presences' => Presence::myPresenceAPI(request()->user()->id),
            'effective_hours' => Presence::getPresenceHours(request()->user()->id)
        ]);
    }

    public function today()
    {
        $result = Presence::where('sdm_id', request()->user()->id)
            ->whereDate('check_in_time', Carbon::today())
            ->latest()
            ->first();
        if ($result && $result->permission == 0) $result->check_out_time = NULL;

        return $this->responseData($result);
    }

    public function totalHour(Request $request)
    {
        return $this->responseData(Presence::getPresenceHours(request()->user()->id));
    }

    public function isLate(Request $request)
    {
        return $this->responseData(Presence::isLate($request->user()->sdm_type) ? true : false);
    }

    public function store(StorePresenceRequestAPI $request)
    {
        try {
            DB::beginTransaction();
            $today = Presence::where('sdm_id', $request->user()->id)
                ->whereDate('created_at', Carbon::today())
                ->exists();
            if ($today) throw new Exception('Hari ini sudah mengisi presensi', 422);

            $presence = Presence::create([
                'sdm_id' => $request->user()->id,
                'check_in_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'latitude_in' => $request->latitude,
                'longitude_in' => $request->longitude
            ]);

            if (Presence::isTendik($request->user()->sdm_type) && Presence::isLate($request->user()->sdm_type)) {
                $filename = FileHelper::upload($request, 'attachment', 'attachments');
                $presence->attachment()->create([
                    'detail' => $request->detail,
                    'attachment' => $filename
                ]);
            }

            DB::commit();
            return $this->responseData($presence, 200);
        } catch (Exception $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function show(Presence $presence)
    {
        return $this->responseData($presence);
    }

    public function update(UpdatePresenceRequestAPI $request)
    {
        try {
            $presence = Presence::where('sdm_id', $request->user()->id)
                ->whereDate('created_at', $request->user()->isSecurity() ? Carbon::yesterday() : Carbon::today())
                ->latest()
                ->first();

            if (!$presence) throw new Exception('Anda belum absen masuk', 422);

            $presence->update([
                'check_out_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'latitude_out' => $request->latitude,
                'longitude_out' => $request->longitude
            ]);
            $presence = Presence::where('sdm_id', $request->user()->id)
                ->whereDate('created_at', $request->user()->isSecurity() ? Carbon::yesterday() : Carbon::today())
                ->latest()
                ->first();

            return $this->responseData($presence, 200);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function permissionType()
    {
        $jenisIzin = Presence::$jenisIzin;

        $izinArray = [];
        foreach ($jenisIzin as $key => $value) {
            $izinArray[] = [
                'id' => $key + 1,
                'jenis_izin' => $value
            ];
        }

        return $this->responseData($izinArray);
    }

    public function subPermission(Request $request)
    {
        try {
            $child_id = collect($request->user()->structure)->pluck('child_id');
            $child_id = Structure::whereIn("parent_id", $child_id)->get();
            $structure_id = collect($child_id)->pluck('id');
            $sdm_id = collect(StructuralPosition::whereIn('structure_id', $structure_id)
                ->select('sdm_id')
                ->get())
                ->pluck('sdm_id');

            $permissions = Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
                ->whereIn('presences.sdm_id', $sdm_id)
                ->where('permission', '0')
                ->with('attachment')
                ->select(
                    'presences.id',
                    'presences.sdm_id',
                    'sdm_name',
                    'presences.created_at'
                )
                ->groupBy(
                    'presences.id',
                    'presences.sdm_id',
                    'sdm_name',
                    'presences.created_at'
                )
                ->get();

            return $this->responseData($permissions);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function myPermission(Request $request)
    {
        try {
            $permissions = Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
                ->where('presences.sdm_id', $request->user()->id)
                ->where('permission', '0')
                ->with('attachment')
                ->select(
                    'presences.id',
                    'presences.sdm_id',
                    'sdm_name',
                    'presences.created_at'
                )
                ->groupBy(
                    'presences.id',
                    'presences.sdm_id',
                    'sdm_name',
                    'presences.created_at'
                )
                ->get();

            return $this->responseData($permissions);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function permission(PermissionRequest $request)
    {
        try {
            $result = Presence::permission($request);
            return $this->responseData($result, 200);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function confirm(Request $request, Presence $presence)
    {
        try {
            if (!$this->checkRole($request, $presence->sdm_id)) throw new Exception('Anda tidak dapat memberikan izin', 422);
            $presence->update(['permission' => 1]);
            return $this->responseData(true);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function delete(Request $request, Presence $presence)
    {
        $presence->update([
            'check_out_time' => NULL,
            'latitude_out' => NULL,
            'longitude_out' => NULL,
            'permission' => 1
        ]);
        $this->responseMessage(true, 200);
    }

    public function checkRole($request, $sdm_id)
    {
        $child_id = collect($request->user()->structure)->pluck('child_id');
        $child_id = Structure::whereIn("parent_id", $child_id)->get();
        $structure_id = collect($child_id)->pluck('id');
        $sdm_id = collect(StructuralPosition::whereIn('structure_id', $structure_id)
            ->select('sdm_id')
            ->get())
            ->pluck('sdm_id');

        return in_array($sdm_id, $sdm_id->toArray());
    }
}
