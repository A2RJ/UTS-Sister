<?php

namespace App\Http\Controllers\Sub;

use App\Http\Controllers\Controller;
use App\Models\Bkd;
use App\Models\HumanResource;
use App\Models\User;
use App\Traits\Utils\CustomPaginate;
use Auth;

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
        $sdm = User::query()
            ->where('id', Auth::id())
            ->first();
        $structureIds = $sdm->structureBySdmId($sdm->sdm_id);
        $sdm_under = $sdm->getSdmAllLevelUnder($structureIds);
        $sdmIds = $sdm_under->pluck('id');
        $sdm_under = $this->paginate($sdm_under, 10);
        $bkds = Bkd::query()
            ->whereIn('lecture_name', $sdmIds)
            ->paginate(10);

        return view('sub.sub', compact('sdm', 'sdm_under', 'bkds'));
    }

    public function profile(HumanResource $sdm)
    {
        $bkds = Bkd::query()
            ->where('lecture_name', $sdm->id)
            ->paginate();
        return view('sub.profile', compact('sdm', 'bkds'));
    }
}
