<?php

namespace App\Traits\Auth\Structures;

use App\Models\Structure;

trait OneLevelunder
{
    public static function getOneLevelUnder()
    {
        $structureIds = Structure::getOwnStructureIds();
        $oneLevelStructures = Structure::whereIn('id', $structureIds)
            ->whereNot('role', 'admin')
            ->with('children')
            ->get();

        $childIds = $oneLevelStructures->pluck('children.*.id')->flatten()->toArray();
        return $childIds;
    }

    public static function getSdmIdOneLevelUnder()
    {
        $allIds = Structure::getOneLevelUnder();
        return Structure::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
            ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
            ->whereIn('structures.id', $allIds)
            ->whereNot('role', 'admin')
            ->select('human_resources.id')
            ->pluck('human_resources.id')
            ->toArray();
    }
}
