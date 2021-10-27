<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\API;
use Illuminate\Http\Request;

class DataPribadi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = API::getProfil(env('ID_SDM'));
        $kependudukan = API::getKependudukan(env('ID_SDM'));
        $keluarga = API::getKeluarga(env('ID_SDM'));
        $bidangIlmu = API::getBidangIlmu(env('ID_SDM'));
        $alamat = API::getAlamat(env('ID_SDM'));
        $kepegawaian = API::getKepegawaian(env('ID_SDM'));
        $lain = API::getLain(env('ID_SDM'));

        return [$profil, $kependudukan, $keluarga, $bidangIlmu, $alamat, $kepegawaian, $lain];
        return view('API.index', compact('profil', 'kependudukan', 'keluarga', 'bidangIlmu', 'alamat', 'kepegawaian', 'lain')); 
    }

    public function showProfile($id_sdm = null)
    {
        $profil = API::getProfil(env('ID_SDM'));
    
        return view('API.profile', compact('profil'));
    }

    public function StoreProfile(Request $request)
    {
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('API.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        API::create($request->all());

        return back()->with('message', 'item stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\API $API
     * @return \Illuminate\Http\Response
     */
    public function show(API $API)
    {
        return view('API.show', compact('API'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\API $API
     * @return \Illuminate\Http\Response
     */
    public function edit(API $API)
    {
        return view('API.edit', compact('API'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\API $API
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, API $API)
    {
        $API->update($request->all());

        return back()->with('message', 'item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\API $API
     * @return \Illuminate\Http\Response
     */
    public function destroy(API $API)
    {
        $API->delete();

        return back()->with('message', 'item deleted successfully');
    }
}
