<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Presence\StorePresenceRequestAPI;
use App\Http\Requests\Presence\UpdatePresenceRequestAPI;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceAPIController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Presence::myPresenceAPI(request()->user()->id)
        ]);
    }

    public function store(StorePresenceRequestAPI $request)
    {
        // $presence = Presence::whereDate('check_in_time', Carbon::today())->first();
        // if ($presence) {
        //     return response()->json([
        //         'message' => 'Hari ini sudah mengisi presensi'
        //     ], 422);
        // }
        $form = $request->safe()->only(['latitude', 'longitude']);
        $form['sdm_id'] = $request->user()->id;
        $form['check_in_time'] = date('Y-m-d H:i:s');
        $form['latitude_in'] = $request->latitude;
        $form['longitude_in'] = $request->longitude;
        if (!$form['sdm_id']) {
            return response()->json([
                'message' => 'Pastikan token benar'
            ], 422);
        }
        if (!$form['check_in_time']) {
            return response()->json([
                'message' => 'Pastikan datetime server benar'
            ], 422);
        }
        Presence::create($form);
        return response()->json([
            'message' => 'Berhasil menambah presensi kehadiran'
        ]);
    }

    public function show(Presence $presence)
    {
        return response()->json([
            'data' => $presence
        ]);
    }

    public function update(UpdatePresenceRequestAPI $request, Presence $presence)
    {
        if ($presence->check_out_time) {
            return response()->json([
                'message' => 'Sudah ter-absensi pulang'
            ], 422);
        }
        $form = $request->safe()->only(['latitude', 'longitude']);
        $form['check_out_time'] = date('Y-m-d H:i:s');
        $form['latitude_out'] = $request->latitude;
        $form['longitude_out'] = $request->longitude;
        if (!$form['check_out_time']) {
            return response()->json([
                'message' => 'Pastikan datetime server benar'
            ], 422);
        }
        $presence->update($form);
        return response()->json([
            'message' => 'Berhasil presensi pulang'
        ]);
    }
}
