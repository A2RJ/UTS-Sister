<?php

namespace App\Http\Controllers\Sub;

use App\Http\Controllers\Controller;
use App\Models\Bkd;
use App\Models\HumanResource;
use App\Models\Jafung;
use App\Models\Presence;
use App\Models\User;
use App\Traits\Utils\CustomPaginate;
use Auth;
use Illuminate\Database\Eloquent\Builder;

class SubController extends Controller
{
    use CustomPaginate;

    public function sdm($sdm)
    {
        $sdm = User::query()
            ->where('sdm_id', $sdm)
            ->first();
        $structureIds = $sdm->structureBySdmId($sdm->sdm_id);
        $sdm_under = $this->paginate($sdm->getSdmAllLevelUnder($structureIds), 10);

        return view('sub.detail', compact('sdm', 'sdm_under'));
    }

    public function sub()
    {
        $role = request('role', null);
        $bkd = request('bkd', null);
        $sdm = User::query()
            ->where('id', Auth::id())
            ->first();
        $structureIds = $sdm->structureBySdmId($sdm->sdm_id);
        $sdm_under = $sdm->getSdmAllLevelUnder($structureIds);
        $sdmIds = $sdm_under->pluck('id');
        $sdm_under = collect($sdm_under)->filter(function ($item) use ($role) {
            return false !== stripos($item->role, $role) || false !== stripos($item->sdm_name, $role);
        });
        $sdm_under = $this->paginate($sdm_under, 10);
        $bkds = Bkd::query()
            ->whereIn('human_resource_id', $sdmIds)
            ->when($bkd, function ($query) use ($bkd) {
                $query
                    ->whereAny([
                        'period', 'status', 'jafung', 'ab', 'c', 'd', 'e', 'total', 'summary'
                    ], "LIKE", "%$bkd%")
                    ->orWhereHas('sdm', function ($query) use ($bkd) {
                        $query->where('sdm_name', 'LIKE', "%$bkd%");
                    });
            })
            ->paginate(10);

        return view('sub.sub', compact('sdm', 'sdm_under', 'bkds'));
    }

    public function profile(HumanResource $sdm)
    {
        $bkd = request('bkd', null);
        $bkds = Bkd::query()
            ->where('human_resource_id', $sdm->id)
            ->when($bkd, function ($query) use ($bkd, $sdm) {
                $query
                    ->whereAny([
                        'period', 'status', 'jafung', 'ab', 'c', 'd', 'e', 'total', 'summary'
                    ], "LIKE", "%$bkd%")
                    ->orWhereHas('sdm', function ($query) use ($bkd, $sdm) {
                        $query->where('sdm_name', 'LIKE', "%$bkd%")
                            ->where('id', $sdm->id);
                    });
            })
            ->paginate(10, ['*'], 'bkd');

        $jafung = request('jafung', null);
        $jafungs = Jafung::query()
            ->where('human_resource_id', $sdm->id)
            ->when($jafung, function ($query) use ($jafung, $sdm) {
                $query
                    ->whereAny([
                        'jafung', 'sk_number', 'start_from'
                    ], "LIKE", "%$jafung%")
                    ->orWhereHas('sdm', function ($query) use ($jafung, $sdm) {
                        $query->where('sdm_name', 'LIKE', "%$jafung%")
                            ->where('id', $sdm->id);
                    });
            })
            ->paginate(10, ['*'], 'jafung');

        $presences = $this->paginate(Presence::getAllPresences([$sdm->id], false), 10);

        return view('sub.profile', compact('sdm', 'bkds', 'jafungs', 'presences'))
            ->with('withDate', true);
    }
}
