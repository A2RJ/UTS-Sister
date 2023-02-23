<?php

namespace App\Http\Controllers\Presence;

use App\Http\Controllers\Controller;
use App\Http\Requests\Presence\PermissionPresenceRequest;
use App\Http\Requests\Presence\PermissionRequest;
use App\Http\Requests\Presence\StorePresenceRequest;
use App\Http\Requests\Presence\UpdatePresenceRequest;
use App\Models\Presence;
use App\Models\HumanResource;
use App\Models\StructuralPosition;
use App\Models\Structure;
use App\Models\Subject;
use App\Models\User;
use App\Traits\Utils\CustomPaginate;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PresenceController extends Controller
{
    use CustomPaginate;

    public function index()
    {
        return view('home');
    }

    public function myPresence()
    {
        return view('presence.dashboard.index')
            ->with('withDate', true)
            ->with('exportUrl', route('download.my-presence', request()->getQueryString()))
            ->with('presences', Presence::getPresences([Auth::id()]))
            ->with('hours', Presence::getPresenceHours(Auth::id()));
    }

    public function subPresenceByCivitas()
    {
        return view('presence.dashboard.structural')
            ->with('withDate', true)
            ->with('exportUrl', route('download.per-civitas', request()->getQueryString()))
            ->with('presences', Presence::subPresenceByCivitas());
    }

    public function subPresenceAll()
    {
        return view('presence.dashboard.index')
            ->with('withDate', true)
            ->with('exportUrl', route('download.civitas-all', request()->getQueryString()))
            ->with('presences', Presence::subPresenceAll());
    }

    public function subLecturer()
    {
        return view('presence.dashboard.lecturer')
            ->with('exportUrl', route('download.sub-lecturer', request()->getQueryString()))
            ->with('lecturers', Subject::subLecturer());
    }

    public function allLecturer()
    {
        return view('presence.dashboard.lecturer')
            ->with('exportUrl', route('download.all-lecturer', request()->getQueryString()))
            ->with('lecturers', Subject::allLecturer());
    }

    public function dsdmByCivitas()
    {
        return view('presence.dashboard.structural')
            ->with('exportUrl', route('download.dsdm-civitas', request()->getQueryString()))
            ->with('withDate', true)
            ->with('presences', Presence::dsdmByCivitas());
    }

    public function dsdmAllCivitas()
    {
        return view('presence.dashboard.index')
            ->with('withDate', true)
            ->with('exportUrl', route('download.dsdm-civitas-all', request()->getQueryString()))
            ->with('presences', Presence::dsdmAllCivitas());
    }

    public function create()
    {
        return view('presence.dashboard.create')
            ->with('human_resources', HumanResource::selectAllOption());
    }

    public function store(StorePresenceRequest $request)
    {
        $form = $request->safe()->only(['sdm_id', 'check_in_time', 'latitude_in', 'longitude_in']);
        Presence::create($form);
        return redirect()->route('presence.index')->with('message', "Berhasil menambah presensi kehadiran");
    }

    public function detail($sdm_id)
    {
        return view('presence.dashboard.index')
            ->with('sdm', HumanResource::where('id', $sdm_id)->first())
            ->with('exportUrl', route('download.detail', ['sdm_id' => $sdm_id]))
            ->with('presences', Presence::getPresences([$sdm_id]));
    }

    public function edit(Presence $presence)
    {
        return view('presence.dashboard.edit')
            ->with('presence', $presence)
            ->with('human_resources', HumanResource::selectAllOption());
    }

    public function update(UpdatePresenceRequest $request, Presence $presence)
    {
        $form = $request->safe()->only(['check_out_time', 'latitude_out', 'longitude_out']);
        $presence->update($form);
        return redirect()->route('presence.index')->with('message', "Berhasil edit presensi kehadiran");
    }

    public function destroy(Presence $presence)
    {
        $presence->delete();
        return redirect()->route('presence.index')->with('message', "Berhasil hapus presensi kehadiran");
    }

    public function form(Request $request)
    {
        return view('presence.permission.sub')
            ->with('jenis_izin', [
                'Tidak Masuk',
                'Izin Berkegiatan Diluar 1/2 Hari',
                'Izin Berkegiatan Diluar 1 Hari',
                'Izin Sakit'
            ]);
    }

    public function subPermission(Request $request)
    {
        $child_id = collect(Auth::user()->structure)->pluck('child_id');
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
            )->paginate();

        return view('presence.permission.index')
            ->with('permissions', $permissions);
    }

    public function myPermission(Request $request)
    {
        $permissions = Presence::join('human_resources', 'presences.sdm_id', 'human_resources.id')
            ->where('presences.sdm_id', Auth::id())
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
            )->paginate();

        return view('presence.permission.index')
            ->with('permissions', $permissions);
    }

    public function delete(Request $request, Presence $presence)
    {
        $presence->delete();
        return back();
    }

    public function permission(PermissionRequest $request)
    {
        try {
            DB::beginTransaction();
            $today = Presence::where('sdm_id', Auth::id())
                ->whereDate('check_in_time', Carbon::today())
                ->exists();
            if ($today) return back()->with('message', 'Anda sudah mengisi ijin');

            $today = Carbon::today();
            $checkInHour = Presence::workHour(Auth::user()->sdm_type)['in'];
            $checkInHour = Carbon::parse($today->toDateString() . ' ' . $checkInHour)->format('Y-m-d H:i:s');
            $checkOutHour = Presence::workHour(Auth::user()->sdm_type)['out'];
            $checkOutHour = Carbon::parse($today->toDateString() . ' ' . $checkOutHour)->format('Y-m-d H:i:s');

            if ($request->jenis_izin == 1) {
                $presence = Presence::create([
                    'sdm_id' => Auth::id(),
                    'check_in_time' => NULL,
                    'check_out_time' => NULL,
                    'permission' => 0
                ]);
            } else if ($request->jenis_izin == 2) {
                $presence = Presence::create([
                    'sdm_id' => Auth::id(),
                    'check_in_time' => $checkInHour,
                    'latitude_in' => Presence::$latitude,
                    'longitude_in' => Presence::$longitude,
                    'permission' => 0
                ]);
            } else if ($request->jenis_izin == 3) {
                $presence = Presence::create([
                    'sdm_id' => Auth::id(),
                    'check_in_time' => $checkInHour,
                    'latitude_in' => Presence::$latitude,
                    'longitude_in' => Presence::$longitude,
                    'check_out_time' => $checkOutHour,
                    'latitude_out' => Presence::$latitude,
                    'longitude_out' => Presence::$longitude,
                    'permission' => 0
                ]);
            } else if ($request->jenis_izin == 4) {
                $presence = Presence::create([
                    'sdm_id' => Auth::id(),
                    'check_in_time' => $checkInHour,
                    'latitude_in' => Presence::$latitude,
                    'longitude_in' => Presence::$longitude,
                    'check_out_time' => $checkOutHour,
                    'latitude_out' => Presence::$latitude,
                    'longitude_out' => Presence::$longitude,
                    'permission' => 0
                ]);
            }

            $validatedData = $request->only(['detail', 'attachment']);
            $file = $request->file('attachment');
            $filename = time() . '' . uniqid() . '' . $file->getClientOriginalName();
            $file->move(public_path('/presense/attachments'), $filename);
            if (!File::exists(public_path('/presense/attachments/' . $filename))) return  back()->with('message', 'Gagal menyimpan file');
            $validatedData['attachment'] = $filename;
            $presence->attachment()->create($validatedData);

            DB::commit();
            return redirect()->route('presence.my-presence')->with('message', 'berhasil mengisi ijin');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('message', $e->getMessage());
        }
    }

    public function confirm(Request $request, Presence $presence)
    {
        try {
            $child_id = collect(Auth::user()->structure)->pluck('id');
            $user = StructuralPosition::whereIn('structure_id', $child_id)
                ->whereNot('sdm_id', Auth::id())
                ->distinct()
                ->select('sdm_id')
                ->get();
            $user_id = collect($user)->pluck('sdm_id');
            if (!in_array($presence->sdm_id, $user_id->toArray())) throw new Exception('Anda tidak dapat memberikan izin');
            $presence->update(['permission' => 1]);
            return back()->with('message', 'berhasil menyetujui ijin');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
