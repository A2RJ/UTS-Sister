<?php

namespace App\Http\Controllers\Presence;

use App\Http\Controllers\Controller;
use App\Http\Requests\Presence\PermissionRequest;
use App\Models\Presence;
use App\Models\StructuralPosition;
use App\Models\Structure;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PresencePermissionController extends Controller
{
    public function form()
    {
        return view('presence.permission.sub')
            ->with('jenis_izin', Presence::$jenisIzin);
    }

    public function subPermission(Request $request)
    {
        return view('presence.permission.index')
            ->with('permissions', Presence::subPermission());
    }

    public function myPermission(Request $request)
    {
        return view('presence.permission.index')
            ->with('permissions', Presence::myPermission());
    }

    public function permission(PermissionRequest $request)
    {
        try {
            DB::beginTransaction();

            $today = Carbon::today();
            $checkInHour = Presence::workHour(Auth::user()->sdm_type)['in'];
            $checkInHour = Carbon::parse($today->toDateString() . ' ' . $checkInHour)->format('Y-m-d H:i:s');
            $checkOutHour = Presence::workHour(Auth::user()->sdm_type)['out'];
            $checkOutHour = Carbon::parse($today->toDateString() . ' ' . $checkOutHour)->format('Y-m-d H:i:s');

            if ($request->jenis_izin == 6) {
                $presence = Presence::where('sdm_id', Auth::id())
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
                $today = Presence::where('sdm_id', Auth::id())
                    ->whereDate('check_in_time', Carbon::today())
                    ->exists();
                if ($today) throw new Exception('Anda sudah mengisi ijin hari ini', 422);

                if ($request->jenis_izin == 1) {
                    $presenceForm = [
                        'sdm_id' => Auth::id(),
                        'check_in_time' => NULL,
                        'check_out_time' => NULL,
                        'permission' => 0
                    ];
                } else if ($request->jenis_izin == 2 || $request->jenis_izin == 5) {
                    $presenceForm = [
                        'sdm_id' => Auth::id(),
                        'check_in_time' => $checkInHour,
                        'latitude_in' => Presence::$latitude,
                        'longitude_in' => Presence::$longitude,
                        'permission' => 0
                    ];
                } else if ($request->jenis_izin == 3) {
                    $presenceForm = [
                        'sdm_id' => Auth::id(),
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
                        'sdm_id' => Auth::id(),
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
                        'sdm_id' => Auth::id(),
                        'check_in_time' => $checkInHour,
                        'latitude_in' => Presence::$latitude,
                        'longitude_in' => Presence::$longitude,
                        'permission' => 0
                    ];
                }

                $presence = Presence::create($presenceForm);
            }

            $request->only(['detail', 'attachment']);
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
            return redirect()->route('presence.my-presence')->with('message', 'Berhasil mengisi ijin');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function confirm(Presence $presence)
    {
        try {
            if (!Structure::isMySub($presence->sdm_id)) throw new Exception('Anda tidak dapat memberikan izin');
            $presence->update(['permission' => 1]);
            return back()->with('message', 'berhasil menyetujui ijin');
        } catch (Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function decline(Presence $presence)
    {
        $presence->update([
            'check_out_time' => NULL,
            'latitude_out' => NULL,
            'longitude_out' => NULL,
            'permission' => 0
        ]);
        return back();
    }
}
