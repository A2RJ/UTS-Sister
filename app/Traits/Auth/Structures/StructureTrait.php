<?php

namespace App\Traits\Auth\Structures;

use App\Models\Structure as StructureModel;
use Illuminate\Support\Facades\Auth;

trait StructureTrait
{
    public static function getStructureIdsRecursive($structureIds, $justChild = false)
    {
        $sessionKey = 'ids';
        // if (Session::has($sessionKey)) return Session::get($sessionKey);

        $structures = StructureModel::whereIn('id', $structureIds)->with('descendants')->get();
        if (!$structures->count()) return [];
        $result = [];
        foreach ($structures as $structure) {
            $structure->childIdsRecursive($result, $justChild);
        }

        // Session::put($sessionKey, $result);

        return $result;
    }

    public function childIdsRecursive(&$result, $justChild)
    {
        if ($justChild) {
            if ($this->ancestors) {
                $result[] = $this->ancestors->id;
                $this->ancestors->childIdsRecursive($result, $justChild);
            }
        } else {
            $result[] = $this->id;
            if ($this->ancestors) {
                $this->ancestors->childIdsRecursive($result, $justChild);
            }
        }
    }


    public static function getSdmIdsRecursiveByStructure($structureIds, $justChild = false)
    {
        $allIds = self::getStructureIdsRecursive($structureIds, $justChild);

        $sdmIds = StructureModel::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
            ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
            ->whereIn('structures.id', $allIds)
            ->select('human_resources.id')
            ->pluck('human_resources.id')
            ->toArray();

        return $sdmIds;
    }

    public static function getSdmRecursiveByStructure($structureIds, $justChild = false, $table = false)
    {
        $allIds = self::getStructureIdsRecursive($structureIds, $justChild);

        if ($table) {
            $structure = StructureModel::whereIn('id', $allIds)
                ->with('humanResource')
                ->get();
        } else {
            $structure = StructureModel::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
                ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
                ->whereIn('structures.id', $allIds)
                ->get();
        }
        return $structure;
    }

    public static function getStructureWithSdmBySdmIds($sdmIds, $table = false)
    {
        if ($table) {
            $structure = StructureModel::whereIn('id', $sdmIds)
                ->whereNot('role', 'admin')
                ->whereHas('humanResource', function ($q) use ($sdmIds) {
                    $q->whereIn('human_resources.id', $sdmIds);
                })
                ->with('humanResource')
                ->orderBy('role')
                ->get();
        } else {
            $structure = StructureModel::join('structural_positions', 'structures.id', '=', 'structural_positions.structure_id')
                ->join('human_resources', 'structural_positions.sdm_id', '=', 'human_resources.id')
                ->whereIn('human_resources.id', $sdmIds)
                ->whereNot('role', 'admin')
                ->orderBy('role')
                ->get();
        }
        return $structure;
    }
}
