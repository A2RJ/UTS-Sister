<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\API;
use Illuminate\Http\Request;

class DataPribadiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $API = API::all();

        return view('API.index', compact('API'));
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
