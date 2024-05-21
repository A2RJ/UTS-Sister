<?php

namespace App\Http\Controllers\Sub;

use App\Http\Controllers\Controller;
use App\Models\Jafung;
use Illuminate\Http\Request;

/**
 * Class JafungController
 * @package App\Http\Controllers
 */
class JafungController extends Controller
{
    public function index()
    {
        $jafung = request('jafung', false);
        $jafungs = Jafung::query()
            ->with('sdm')
            ->when($jafung, function ($query) use ($jafung) {
                $query
                    ->whereAny([
                        'jafung', 'sk_number', 'start_from'
                    ], "LIKE", "%$jafung%")
                    ->orWhereHas('sdm', function ($query) use ($jafung) {
                        $query->where('sdm_name', 'LIKE', "%$jafung%");
                    });
            })
            ->paginate(10);

        return view('sub.jafung.index', compact('jafungs'))
            ->with('i', (request()->input('page', 1) - 1) * $jafungs->perPage());
    }

    public function create()
    {
        $jafung = new Jafung();
        return view('sub.jafung.create', compact('jafung'));
    }

    public function store(Request $request)
    {
        request()->validate(Jafung::$rules);
        $name = now()->timestamp . "." . $request->attachment->getClientOriginalName();
        $path = $request->file('attachment')->storeAs('jafung', $name, 'public');
        $form = $request->all();
        $form['attachment'] = $path;
        $form['human_resource_id'] = auth()->id();
        $jafung = Jafung::create($form);

        return redirect()->route('jafung.index')
            ->with('success', 'Jafung created successfully.');
    }

    public function edit($id)
    {
        $jafung = Jafung::find($id);

        return view('sub.jafung.edit', compact('jafung'));
    }

    public function update(Request $request, Jafung $jafung)
    {
        request()->validate(Jafung::$updateRules);

        $path = $jafung->attachment;
        if ($request->hasFile('attachment')) {
            $name = now()->timestamp . "." . $request->attachment->getClientOriginalName();
            $path = $request->file('attachment')->storeAs('jafung', $name, 'public');
        }

        $form = $request->all();
        $form['attachment'] = $path;

        $jafung->update($form);

        return redirect()->route('jafung.index')
            ->with('success', 'Jafung updated successfully');
    }

    public function destroy($id)
    {
        $jafung = Jafung::find($id)->delete();

        return redirect()->route('jafung.index')
            ->with('success', 'Jafung deleted successfully');
    }

    public function attachment($path)
    {
        return response()->file(storage_path('app/public/' . $path));
    }
}
