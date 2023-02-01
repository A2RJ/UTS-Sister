<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Presence\PermissionPresenceRequest;
use App\Http\Requests\Presence\StorePresenceRequestAPI;
use App\Http\Requests\Presence\UpdatePresenceRequestAPI;
use App\Models\Presence;
use App\Models\PresencePermission;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresenceAPIController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Presence::myPresenceAPI(request()->user()->id)
        ]);
    }

    public function today()
    {
        return response()->json([
            'data' => Presence::where('sdm_id', request()->user()->id)
                ->whereDate('check_in_time', Carbon::today())
                ->latest()
                ->first()
        ]);
    }

    public function isLateCheck($request)
    {
        if (!$request->user()->sdm_type) return response()->json(['message' => 'Set SDM type'], 500);
        $data = Presence::$workHour[$request->user()->sdm_type];
        return Carbon::now() < $data['in'] ? true : false;
    }

    public function isLate(Request $request)
    {
        return $this->isLateCheck($request);
    }

    public function store(StorePresenceRequestAPI $request)
    {
        DB::transaction();
        try {
            $presence = Presence::where('sdm_id', $request->user()->id)
                ->whereDate('check_in_time', Carbon::today())
                ->first();
            if (!isset($presence)) throw new Exception('Hari ini sudah mengisi presensi');

            $presence = Presence::create([
                'sdm_id' => $request->user()->id,
                'check_in_time' => date('Y-m-d H:i:s'),
                'latitude_in' => $request->input('latitude'),
                'longitude_in' => $request->input('longitude')
            ]);

            if ($this->isLateCheck($request)) {
                $file = $request->file('attachment');
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/presense/attachments', $filename);
                $presence->attachment()->create([
                    'detail' => $request->detail,
                    'attachment' => $filename
                ]);
            }

            DB::commit();
            return response()->json(['data' => $presence], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function show(Presence $presence)
    {
        return response()->json([
            'data' => $presence
        ]);
    }

    public function update(UpdatePresenceRequestAPI $request)
    {
        try {
            if (request()->user()->isSecurity()) {
                $presence = Presence::where('sdm_id', request()->user()->id)
                    ->whereDate('check_in_time', Carbon::yesterday())
                    ->latest()
                    ->first();
            } else {
                $presence = Presence::where('sdm_id', request()->user()->id)
                    ->whereDate('check_in_time', Carbon::today())
                    ->latest()
                    ->first();
            }

            if (empty($presence)) throw new Exception('Anda belum absen masuk', 422);
            if ($presence->check_out_time) throw new Exception('Sudah ter-absensi pulang', 400);

            $presence->check_out_time = date('Y-m-d H:i:s');
            $presence->latitude_out = $request->input('latitude');
            $presence->longitude_out = $request->input('longitude');
            $presence->save();

            return response()->json([
                'data' => $presence
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function halfDayPresence(PermissionPresenceRequest $request)
    {
        DB::transaction();
        try {
            $checkInHour = Presence::$workHour[$request->sdm_type];
            if (!isset($checkInHour))  throw new Exception('Jam masuk tidak ditemukan');

            $presence = PresencePermission::where('sdm_id', $request->sdm_id)
                ->whereDate('check_in_time', Carbon::today())
                ->first();
            if (!isset($presence)) throw new Exception('Hari ini sudah mengisi presensi');


            $presence = PresencePermission::create([
                'sdm_id' => $request->sdm_id,
                'check_in_time' => $checkInHour['in'],
                'latitude_in' => Presence::$latitude,
                'longitude_in' => Presence::$longitude
            ]);

            $file = $request->file('attachment');
            $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/presense/attachments', $filename);
            $presence->attachment()->create([
                'detail' => $request->detail,
                'attachment' => $filename
            ]);

            DB::commit();
            return response()->json(['data' => $presence], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function fullDayPresence(PermissionPresenceRequest $request)
    {
        DB::transaction();
        try {
            $checkInHour = Presence::$workHour[$request->sdm_type];
            if (!isset($checkInHour))  throw new Exception('Jam masuk tidak ditemukan');

            $presence = PresencePermission::where('sdm_id', $request->sdm_id)
                ->whereDate('check_in_time', Carbon::today())
                ->first();
            if (!isset($presence)) throw new Exception('Hari ini sudah mengisi presensi');

            $presence = PresencePermission::create([
                'sdm_id' => $request->sdm_id,
                'check_in_time' => $checkInHour['in'],
                'latitude_in' => Presence::$latitude,
                'longitude_in' => Presence::$longitude,
                'check_out_time' => $checkInHour['out'],
                'latitude_out' => Presence::$latitude,
                'longitude_out' => Presence::$longitude,
            ]);

            $file = $request->file('attachment');
            $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/presense/attachments', $filename);
            $presence->attachment()->create([
                'detail' => $request->detail,
                'attachment' => $filename
            ]);

            DB::commit();
            return response()->json(['data' => $presence], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function confirmPermissionPresence(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate(['id' => 'required']);
            $data = PresencePermission::where('id', $request->id)->first();

            $tabel2 = new Presence();
            $tabel2->fill($data->toArray());
            $tabel2->save();

            $data->delete();

            DB::commit();
            return response()->json(['message' => 'Berhasil terima izin']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
