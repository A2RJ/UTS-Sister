<?php

namespace App\Http\Controllers\Presence;

use App\Helpers\FileHelper;
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
use Illuminate\Support\Facades\Storage;

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
            Presence::permission($request);
            return redirect()->route('presence.my-presence')->with('message', 'Berhasil mengisi ijin');
        } catch (Exception $th) {
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
