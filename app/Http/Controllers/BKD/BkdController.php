<?php

namespace App\Http\Controllers\BKD;

use App\Http\Controllers\Controller;
use App\Models\Bkd;
use App\Models\HumanResource;
use App\Traits\Utils\CustomPaginate;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

/**
 * Class BkdController
 * @package App\Http\Controllers
 */
class BkdController extends Controller
{
    use CustomPaginate;
    public function index()
    {
        $bkd = request('bkd', false);
        $bkds = Bkd::query()
            ->when($bkd, function ($query) use ($bkd) {
                $query
                    ->whereAny([
                        'period', 'status', 'jafung', 'ab', 'c', 'd', 'e', 'total', 'summary'
                    ], "LIKE", "%$bkd%")
                    ->orWhereHas('sdm', function (Builder $query) use ($bkd) {
                        $query->where('sdm_name', 'LIKE', "%$bkd%")
                            ->orWhere('nidn', 'LIKE', "%$bkd%");
                    });
            })
            ->paginate(10);

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

    public function import()
    {
        $data = session('bkd_data', []);
        $data = $this->paginate($data);
        return view('BKD.import', compact('data'));
    }

    public function importPost(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx',
        ]);

        $file = (new FastExcel)->import($request->file);
        if ($file->count() == 0) return redirect()
            ->route('bkd.import')
            ->with('failed', 'Minimal ada 1 data BKD');

        $requiredKeys = ['NIDN', 'PRODI', 'PERIODE', 'STATUS', 'JABATAN FUNGSIONAL', 'A/B', 'C', 'D', 'E', 'JUMLAH', 'KESIMPULAN', 'KET'];
        foreach ($file as $item) {
            foreach ($requiredKeys as $key) {
                if (!array_key_exists($key, $item)) {
                    return redirect()->route('bkd.import')->with('failed', "Kunci $key tidak ditemukan dalam data");
                }
            }
        }

        $data = $file->map(function ($item) use ($requiredKeys) {
            $sdm = HumanResource::query()
                ->where('nidn', $item['NIDN'])
                ->first();
            return [
                'sdm' => $sdm->toArray(),
                'human_resource_id' => $sdm->id,
                'nidn' => $item['NIDN'],
                'period' => $item['PERIODE'],
                'nama_dosen' => $sdm->sdm_name,
                'prodi' => $item['PRODI'],
                'status' => $item['STATUS'],
                'jafung' => $item['JABATAN FUNGSIONAL'],
                'ab' => $item['A/B'],
                'c' => $item['C'],
                'd' => $item['D'],
                'e' => $item['E'],
                'total' => $item['JUMLAH'],
                'summary' => $item['KESIMPULAN'],
                'description' => $item['KET'],
            ];
        })
            ->filter(fn ($item) => $item['sdm'] != null)
            ->toArray();
        session(['bkd_data' => $data]);

        return redirect()->route('bkd.import')->with('success', 'Data berhasil diimport');
    }

    public function flushSession()
    {
        session()->forget('bkd_data');
        return redirect()->route('bkd.import')->with('success', 'Data berhasil dihapus');
    }

    public function storeBkd()
    {
        DB::transaction(function () {
            $data = collect(session('bkd_data'))->map(function ($item) {
                unset($item['sdm']);
                unset($item['nidn']);
                unset($item['nama_dosen']);
                unset($item['prodi']);
                return $item;
            })->toArray();
            Bkd::query()
                ->insert($data);
        });
        return redirect()->route('bkd.index')->with('success', 'Data berhasil dihapus');
    }
}
