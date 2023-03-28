<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Presence\PermissionRequest;
use App\Http\Requests\Presence\StorePresenceRequestAPI;
use App\Http\Requests\Presence\UpdatePresenceRequestAPI;
use App\Models\HumanResource;
use App\Models\Presence;
use App\Models\StructuralPosition;
use App\Models\Structure;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PresenceAPIController extends Controller
{
    public function index()
    {
        return $this->responseData(Presence::myPresenceAPI(request()->user()->id));
    }

    public function today()
    {
        return $this->responseData(
            Presence::where('sdm_id', request()->user()->id)
                ->whereDate('check_in_time', Carbon::today())
                ->latest()
                ->first()
        );
    }

    public function totalHour(Request $request)
    {
        $startDate = request('start');
        $endDate = request('end');

        $result = HumanResource::join('presences', 'human_resources.id', 'presences.sdm_id')
            ->where('human_resources.id', $request->user()->id)
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('presences.check_in_time', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            })
            ->select('human_resources.sdm_name', 'human_resources.id')
            ->workHours()
            // ->with(['presence' => function ($query) use ($startDate, $endDate) {
            //     return $query->select('sdm_id', 'check_in_time', 'check_out_time')
            //         ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            //             return $query->whereBetween('presences.check_in_time', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            //         });
            // }])
            ->groupBy('human_resources.id', 'human_resources.sdm_name')
            ->first();

        return $this->responseData($result);
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

            if (Presence::isLate($request->user()->sdm_type)) {
                $request->validate([
                    'detail' => 'required',
                    'attachment' => 'required|mimes:xls,xlsx,doc,docx,pdf,jpeg,jpg,png|max:4096',
                ]);
                $file = $request->file('attachment');
                $filename = time() . uniqid() . "." . $file->getClientOriginalExtension();
                if (!$file->storeAs('presense/attachments', $filename)) throw new Exception("Gagal menyimpan file.", 422);
                $presence->attachment()->create([
                    'detail' => $request->detail,
                    'attachment' => $filename
                ]);
            }

            DB::commit();
            return $this->responseData($presence, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage(), 500);
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
            // if ($presence->check_out_time) throw new Exception('Sudah ter-absensi pulang', 422);

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
        } catch (Exception $e) {
            return $this->responseError($e->getMessage(), $e->getCode());
        }
    }

    public function permissionType()
    {
        return $this->responseData(Presence::$jenisIzin);
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
        } catch (Exception $e) {
            return $this->responseError($e->getMessage(), 500);
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
        } catch (Exception $e) {
            return $this->responseError($e->getMessage(), 500);
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
                    ->whereNull('check_out_time')
                    ->latest()
                    ->first();

                if (!$presence) throw new Exception('Anda belum absen masuk atau anda sudah mengisi ijin hari ini', 422);

                $presence->update([
                    'check_out_time' => $checkOutHour,
                    'latitude_out' => Presence::$latitude,
                    'longitude_out' => Presence::$longitude,
                    'permission' => 0
                ]);
                $presence->attachment->update([
                    'detail' => $presence->attachment->detail . ", " . Presence::$jenisIzin[$request->jenis_izin - 1] . " - " . $request->detail
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

                $validatedData = $request->only(['detail', 'attachment']);
                $file = $request->file('attachment');
                $filename = time() . uniqid() . "." . $file->getClientOriginalExtension();
                $file->move(public_path('/presense/attachments'), $filename);
                if (!File::exists(public_path('/presense/attachments/' . $filename))) throw new Exception('Gagal menyimpan file');
                $validatedData['attachment'] = $filename;
                $validatedData['detail'] = Presence::$jenisIzin[$request->jenis_izin - 1] . " - " . $request->detail;

                $presence->attachment()->create($validatedData);
            }
            DB::commit();
            return redirect()->route('presence.my-presence')->with('message', 'Berhasil mengisi ijin');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function confirm(Presence $presence)
    {
        try {
            $child_id = collect(Auth::user()->structure)->pluck('child_id');
            $child_id = Structure::whereIn("parent_id", $child_id)->get();
            $structure_id = collect($child_id)->pluck('id');
            $sdm_id = collect(StructuralPosition::whereIn('structure_id', $structure_id)
                ->select('sdm_id')
                ->get())
                ->pluck('sdm_id');
            if (!in_array($presence->sdm_id, $sdm_id->toArray())) throw new Exception('Anda tidak dapat memberikan izin');
            $presence->update(['permission' => 1]);
            return back()->with('message', 'berhasil menyetujui ijin');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function delete(Presence $presence)
    {
        $presence->delete();
        return back();
    }
}
