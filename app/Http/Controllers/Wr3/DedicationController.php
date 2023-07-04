<?php

namespace App\Http\Controllers\Wr3;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Wr3\DedicationsRequest;
use App\Http\Requests\Wr3\DedicationsUpdateRequest;
use App\Models\Wr3\Dedication;
use Illuminate\Support\Facades\Auth;

class DedicationController extends Controller
{
    public function index()
    {
        $search = request('search');
        $dedications = Dedication::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('funding_source', 'like', '%' . $search . '%')
                        ->orWhere('activity_schedule', 'like', '%' . $search . '%')
                        ->orWhere('location', 'like', '%' . $search . '%')
                        ->orWhere('participants', 'like', '%' . $search . '%')
                        ->orWhere('target_activity_outputs', 'like', '%' . $search . '%')
                        ->orWhere('public_media_publications', 'like', '%' . $search . '%')
                        ->orWhere('scientific_publications', 'like', '%' . $search . '%')
                        ->orWhere('members', 'like', '%' . $search . '%')
                        ->orWhereHas('humanResource', function ($query) use ($search) {
                            $query->where('sdm_name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->paginate(10);
        return view('wr3.dedication.index', compact('dedications', 'search'));
    }

    public function byUser()
    {
        $dedications = Dedication::where('sdm_id', Auth::id())->paginate();
        return view('wr3.dedication.index', compact('dedications'));
    }

    public function create()
    {
        return view('wr3.dedication.create');
    }

    public function store(DedicationsRequest $request)
    {
        $proposal_file = FileHelper::upload($request, 'proposal_file', 'proposal_file');
        $request = $request->validated();
        $request['sdm_id'] = Auth::id();
        $request['proposal_file'] = $proposal_file;
        Dedication::create($request);

        return redirect()->route('dedication.index')
            ->with('success', 'Dedication created successfully.');
    }

    public function edit(Dedication $dedication)
    {
        return view('wr3.dedication.edit', compact('dedication'));
    }

    public function update(DedicationsUpdateRequest $request, Dedication $dedication)
    {
        $updateForm = $request->validated();
        if ($request->hasFile('proposal_file')) {
            $proposal_file = FileHelper::upload($request, 'proposal_file', 'proposal_file');
            $updateForm['proposal_file'] = $proposal_file;
        } else {
            unset($updateForm['proposal_file']);
        }
        $dedication->update($updateForm);

        return redirect()->route('dedication.index')
            ->with('success', 'Dedication updated successfully.');
    }

    public function destroy(Dedication $dedication)
    {
        $dedication->delete();

        return redirect()->route('dedication.index')
            ->with('success', 'Dedication deleted successfully.');
    }
}
