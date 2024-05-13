<?php

namespace App\Http\Controllers\Sub;

use App\Http\Controllers\Controller;
use App\Models\HumanResource;
use App\Models\User;
use Auth;

class SubController extends Controller
{
    public function sdm($sdm)
    {
        $sdm = User::query()
            ->where('sdm_id', $sdm)
            ->first();
        $structureIds = $sdm->structureBySdmId($sdm->sdm_id);
        $sdm_under = $sdm->getSdmAllLevelUnder($structureIds);

        return view('sub.detail', compact('sdm', 'sdm_under'));
    }

    public function sub()
    {
        $sdm = User::query()
            ->where('id', Auth::id())
            ->first();
        $structureIds = $sdm->structureBySdmId($sdm->sdm_id);
        $sdm_under = $sdm->getSdmAllLevelUnder($structureIds);

        return view('sub.sub', compact('sdm', 'sdm_under'));
    }

    public function profile(HumanResource $sdm)
    {
        return view('sub.profile', compact('sdm'));
    }
}
