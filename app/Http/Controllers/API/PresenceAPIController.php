<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Presence\StorePresenceRequestAPI;
use App\Http\Requests\Presence\UpdatePresenceRequestAPI;
use App\Models\Presence;
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

    public function isLate(Request $request)
    {
        return Presence::isLate($request->user()->sdm_type);
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
                $validatedData = $request->validate([
                    'detail' => 'required',
                    'attachment' => 'required|mimes:xls,xlsx,doc,docx,pdf,jpeg,jpg,png|max:2048',
                ]);

                if ($request->hasFile('attachment')) {
                    $file = $request->file('attachment');
                    $filename = time() . '' . uniqid() . '' . $file->getClientOriginalName();
                    if (!$file->storeAs('presense/attachments', $filename)) throw new Exception("Gagal menyimpan file.", 422);
                    $validatedData['attachment'] = $filename;
                }
                $presence->attachment()->create($validatedData);
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
            if ($presence->check_out_time) throw new Exception('Sudah ter-absensi pulang', 422);

            $presence->update([
                'check_out_time' => $request->check_out_time,
                'latitude_out' => $request->latitude,
                'longitude_out' => $request->longitude
            ]);

            return $this->responseData(true, 204);
        } catch (Exception $e) {
            return $this->responseError($e->getMessage(), $e->getCode());
        }
    }
}
