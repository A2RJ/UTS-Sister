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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

        // $today = Carbon::today();
        // $todayStartOfDay = $today->startOfDay();
        // if ($result && $result->check_out_time == NULL) $result->check_out_time = $todayStartOfDay->toDateTimeString();
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
                ->whereDate('check_in_time', Carbon::today())
                ->exists();
            if ($today) throw new Exception('Hari ini sudah mengisi presensi', 422);

            $presence = Presence::create([
                'sdm_id' => $request->user()->id,
                'check_in_time' => $request->check_in_time,
                'latitude_in' => $request->latitude,
                'longitude_in' => $request->longitude
            ]);

            if ($request->user()->sdm_type == 'Tenaga Kependidikan' && Presence::isLate($request->user()->sdm_type)) {
                $request->validate([
                    'detail' => 'required',
                    'attachment' => 'required|mimes:xls,xlsx,doc,docx,pdf,jpeg,jpg,png|max:4096',
                ]);
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
            $presence = Presence::where('sdm_id', request()->user()->id)
                ->whereDate('check_in_time', request()->user()->isSecurity() ? Carbon::yesterday() : Carbon::today())
                ->latest()
                ->first();

            if (!$presence) throw new Exception('Anda belum absen masuk', 422);

            $presence->update([
                'check_out_time' => $request->check_out_time,
                'latitude_out' => $request->latitude,
                'longitude_out' => $request->longitude
            ]);
            $presence = Presence::where('sdm_id', request()->user()->id)
                ->whereDate('check_in_time', request()->user()->isSecurity() ? Carbon::yesterday() : Carbon::today())
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
                ->where('permission', 0)
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
                ->where('permission', 0)
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
            DB::beginTransaction();

            $today = Carbon::today();
            $checkInHour = Presence::workHour($request->user()->sdm_type)['in'];
            $checkInHour = Carbon::parse($today->toDateString() . ' ' . $checkInHour)->format('Y-m-d H:i:s');
            $checkOutHour = Presence::workHour($request->user()->sdm_type)['out'];
            $checkOutHour = Carbon::parse($today->toDateString() . ' ' . $checkOutHour)->format('Y-m-d H:i:s');

            if ($request->jenis_izin == 6) {
                $presence = Presence::where('sdm_id', $request->user()->id)
                    ->whereDate('check_in_time', Carbon::today())
                    ->latest()
                    ->first();

                if (!$presence) throw new Exception('Anda belum absen masuk hari ini', 422);
                if ($presence->check_out_time) throw new Exception('Anda sudah mengisi absen pulang hari ini', 422);

                $presence->update([
                    'check_out_time' => $checkOutHour,
                    'latitude_out' => Presence::$latitude,
                    'longitude_out' => Presence::$longitude,
                    'permission' => 0
                ]);
            } else {
                $today = Presence::where('sdm_id', $request->user()->id)
                    ->whereDate('check_in_time', Carbon::today())
                    ->exists();
                if ($today) throw new Exception('Anda sudah mengisi ijin hari ini', 422);

                if ($request->jenis_izin == 1) {
                    $presenceForm = [
                        'sdm_id' => $request->user()->id,
                        'check_in_time' => NULL,
                        'check_out_time' => NULL,
                        'permission' => 0
                    ];
                } else if ($request->jenis_izin == 2 || $request->jenis_izin == 5) {
                    $presenceForm = [
                        'sdm_id' => $request->user()->id,
                        'check_in_time' => $checkInHour,
                        'latitude_in' => Presence::$latitude,
                        'longitude_in' => Presence::$longitude,
                        'permission' => 0
                    ];
                } else if ($request->jenis_izin == 3) {
                    $presenceForm = [
                        'sdm_id' => $request->user()->id,
                        'check_in_time' => $checkInHour,
                        'latitude_in' => Presence::$latitude,
                        'longitude_in' => Presence::$longitude,
                        'check_out_time' => $checkOutHour,
                        'latitude_out' => Presence::$latitude,
                        'longitude_out' => Presence::$longitude,
                        'permission' => 0
                    ];
                } else if ($request->jenis_izin == 4) {
                    $presenceForm = [
                        'sdm_id' => $request->user()->id,
                        'check_in_time' => $checkInHour,
                        'latitude_in' => Presence::$latitude,
                        'longitude_in' => Presence::$longitude,
                        'check_out_time' => $checkOutHour,
                        'latitude_out' => Presence::$latitude,
                        'longitude_out' => Presence::$longitude,
                        'permission' => 0
                    ];
                } else if ($request->jenis_izin == 5) {
                    $presenceForm = [
                        'sdm_id' => $request->user()->id,
                        'check_in_time' => $checkInHour,
                        'latitude_in' => Presence::$latitude,
                        'longitude_in' => Presence::$longitude,
                        'permission' => 0
                    ];
                }

                $presence = Presence::create($presenceForm);
            }

            $file = $request->file('attachment');
            $filename = time() . uniqid() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('/presense/attachments'), $filename);
            if (!File::exists(public_path('/presense/attachments/' . $filename))) throw new Exception('Gagal menyimpan file');

            if ($presence->attachment && $presence->attachment->detail)  $detail = $presence->attachment->detail . ", " . Presence::$jenisIzin[$request->jenis_izin - 1] . " - " . $request->detail;
            else $detail = Presence::$jenisIzin[$request->jenis_izin - 1] . " - " . $request->detail;

            $presence->attachment()->updateOrCreate(
                ['presence_id' => $presence->id],
                [
                    'attachment' => $filename,
                    'detail' => $detail
                ]
            );

            DB::commit();
            return $this->responseData(true, 200);
        } catch (Exception $th) {
            DB::rollBack();
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
