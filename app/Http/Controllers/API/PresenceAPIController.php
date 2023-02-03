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

    public function store(StorePresenceRequestAPI $request)
    {
        try {
            DB::beginTransaction();
            $presence = Presence::where('sdm_id', $request->user()->id)
                ->whereDate('check_in_time', Carbon::today())
                ->exists();
            if ($presence) throw new Exception('Hari ini sudah mengisi presensi');

            $presence = Presence::create([
                'sdm_id' => $request->user()->id,
                'check_in_time' => date('Y-m-d H:i:s'),
                'latitude_in' => $request->input('latitude'),
                'longitude_in' => $request->input('longitude')
            ]);

            if (Presence::isLate()) {
                $validatedData = $request->validate([
                    'detail' => 'required',
                    'attachment' => 'nullable|mimes:xls,xlsx,doc,docx,pdf,jpeg,jpg,png|max:2048',
                ]);

                if ($request->hasFile('attachment')) {
                    $file = $request->file('attachment');
                    $filename = time() . '' . uniqid() . '' . $file->getClientOriginalName();
                    if (!$file->storeAs('presense/attachments', $filename)) throw new Exception("Gagal menyimpan file.");
                    $validatedData['attachment'] = $filename;
                }
                $presence->attachment()->create($validatedData);
            }

            DB::commit();
            return $this->responseData($presence, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage(), 422);
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

            if (!$presence) throw new Exception('Anda belum absen masuk');
            if ($presence->check_out_time) throw new Exception('Sudah ter-absensi pulang');

            $presence->update([
                'check_out_time' => date('Y-m-d H:i:s'),
                'latitude_out' => $request->input('latitude'),
                'longitude_out' => $request->input('longitude')
            ]);

            return $this->responseData(true, 204);
        } catch (Exception $e) {
            return $this->responseError($e->getMessage(), 400);
        }
    }

    public function halfDayPresence(PermissionPresenceRequest $request)
    {
        try {
            DB::beginTransaction();
            $presencePermission = PresencePermission::where('sdm_id', $request->user()->id)
                ->whereDate('check_in_time', Carbon::today())
                ->first();
            $presence = Presence::where('id', $request->user()->sdm_id)
                ->whereDate('check_in_time', Carbon::today())
                ->first();
            if ($presence) throw new Exception('Hari ini sudah mengisi presensi');
            if ($presencePermission) throw new Exception('Hari ini sudah mengisi ijin presensi');

            $checkInHour = Presence::workHour()['in'];
            $today = Carbon::today();
            $targetTime = Carbon::parse($today->toDateString() . ' ' . $checkInHour)->format('Y-m-d H:i:s');
            $presence = PresencePermission::create([
                'sdm_id' => $request->user()->id,
                'check_in_time' => $targetTime,
                'latitude_in' => Presence::$latitude,
                'longitude_in' => Presence::$longitude
            ]);

            $validatedData = $request->only(['detail', 'attachment']);
            $file = $request->file('attachment');
            $filename = time() . '' . uniqid() . '' . $file->getClientOriginalName();
            if (!$file->storeAs('presense/attachments', $filename)) throw new Exception("Gagal menyimpan file.");
            $validatedData['attachment'] = $filename;
            $presence->attachment()->create($validatedData);

            DB::commit();
            return $this->responseData($presence, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage(), 400);
        }
    }

    public function fullDayPresence(PermissionPresenceRequest $request)
    {
        try {
            DB::beginTransaction();
            $checkInHour = Presence::workHour();
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
            return $this->responseData($presence, 201);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage(), 400);
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
            return $this->responseMessage('Berhasil terima izin');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage(), 400);
        }
    }
}
