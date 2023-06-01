<?php

namespace App\Traits\Auth\Structures;

use App\Models\Structure;
use App\Traits\Auth\Structures\Recursive;
use Illuminate\Support\Facades\Auth;

trait UtilsStructure
{
    use Recursive;

    public static function getOwnStructure()
    {
        return Auth::user()->structure;
    }

    public static function getOwnStructureIds()
    {
        $structures = self::getOwnStructure();
        return collect($structures)->pluck('id');
    }

    public static function isMySub($sdmId)
    {
        $sdmIds = Structure::getSdmIdOneLevelUnder();
        return in_array($sdmId, $sdmIds);
    }

    public static function getAllStructure($structureIds = false)
    {
        $structures = Structure::query();
        if ($structureIds) {
            $structures->whereIn('id', $structureIds);
        }
        return $structures->with('descendants')->get();
    }

    public static function getIdsOneLevelUnder()
    {
        $structureIds = self::getOwnStructureIds();
        $oneLevelUnder = Structure::whereIn('id', $structureIds)
            ->whereNot('role', 'admin')
            ->with('children')
            ->get();

        $childIds = $oneLevelUnder->pluck('children.*.id')->flatten()->toArray();
        return $childIds;
    }

    public static function getSdmIdOneLevelUnder()
    {
        $structureIds = self::getIdsOneLevelUnder();
        return Structure::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
            ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
            ->whereIn('structures.id', $structureIds)
            ->whereNot('role', 'admin')
            ->select('human_resources.id')
            ->pluck('human_resources.id')
            ->toArray();
    }

    public static function getSdmOneLevelUnder()
    {
        $structureIds = self::getIdsOneLevelUnder();
        return Structure::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
            ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
            ->whereIn('structures.id', $structureIds)
            ->whereNot('role', 'admin')
            ->get();
    }

    public static function getAllIdsLevelUnder($structureId = false)
    {
        if (!$structureId) $structureId = collect(self::getOwnStructureIds())->toArray();
        $structureIds = self::recursiveAll($structureId);
        return collect($structureIds)->reject(function ($item) use ($structureId) {
            return in_array($item, $structureId);
        })->toArray();
    }

    public static function getSdmIdAllLevelUnder()
    {
        $structureIds = self::getOwnStructureIds();
        $structureIds = self::recursiveAll($structureIds, false);
        return Structure::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
            ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
            ->whereIn('structures.id', $structureIds)
            ->whereNot('role', 'admin')
            ->distinct()
            ->whereNot('human_resources.id', Auth::id())
            ->select('human_resources.id')
            ->pluck('human_resources.id')
            ->toArray();
    }

    public static function getSdmAllLevelUnder()
    {
        $structureIds = self::getOwnStructureIds();
        $structureIds = self::recursiveAll($structureIds);
        return Structure::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
            ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
            ->whereIn('structures.id', $structureIds)
            ->whereNot('role', 'admin')
            ->distinct()
            ->whereNot('human_resources.id', Auth::id())
            ->get();
    }

    public static function getSdmIdAllLevel($structureIds = null)
    {
        if (!$structureIds) $structureIds = self::getOwnStructureIds();
        $structureIds = self::recursiveAll($structureIds);
        return Structure::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
            ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
            ->whereIn('structures.id', $structureIds)
            ->whereNot('role', 'admin')
            ->distinct()
            ->select('human_resources.id')
            ->pluck('human_resources.id')
            ->toArray();
    }

    public static function getSdmAllLevel()
    {
        $structureIds = self::getOwnStructureIds();
        $structureIds = self::recursiveAll($structureIds);
        return Structure::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
            ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
            ->whereIn('structures.id', $structureIds)
            ->whereNot('role', 'admin')
            ->get();
    }
}
