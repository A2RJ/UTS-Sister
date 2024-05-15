<?php

namespace App\Http\Controllers\BKD;

use App\Http\Controllers\Controller;
use App\Models\Bkd;
use App\Models\HumanResource;
use Illuminate\Http\Request;

/**
 * Class BkdController
 * @package App\Http\Controllers
 */
class BkdController extends Controller
{
    public function index()
    {
        $bkds = Bkd::paginate(10);

        return view('BKD.index', compact('bkds'))
            ->with('i', (request()->input('page', 1) - 1) * $bkds->perPage());
    }

    public function create()
    {
        $bkd = new Bkd();
        $lecturers = HumanResource::query()
            ->get(['id', 'sdm_name', 'nidn']);

        return view('BKD.create', compact('bkd', 'lecturers'));
    }

    public function store(Request $request)
    {
        request()->validate(Bkd::$rules);

        $bkd = Bkd::create($request->all());

        return redirect()->route('bkd.index')
            ->with('success', 'Bkd created successfully.');
    }

    public function edit($id)
    {
        $bkd = Bkd::find($id);
        $lecturers = HumanResource::query()
            ->get(['id', 'sdm_name', 'nidn']);

        return view('BKD.edit', compact('bkd', 'lecturers'));
    }

    public function update(Request $request, Bkd $bkd)
    {
        request()->validate(Bkd::$rules);

        $bkd->update($request->all());

        return redirect()->route('bkd.index')
            ->with('success', 'Bkd updated successfully');
    }

    public function destroy($id)
    {
        $bkd = Bkd::find($id)->delete();

        return redirect()->route('bkd.index')
            ->with('success', 'Bkd deleted successfully');
    }
}
