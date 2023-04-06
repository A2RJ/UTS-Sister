<?php

namespace App\Traits\Auth\Structures;

use App\Models\Structure;

trait Recursive
{
    public static function recursiveAll($structureIds)
    {
        $structures = Structure::whereIn('id', $structureIds)->with('descendants')->get();
        if (!$structures->count()) return [];
        $result = [];

        foreach ($structures as $structure) {
            self::descendantIdsRecursive($structure, $result);
        }

        return array_unique($result);
    }

    public static function descendantIdsRecursive($structure, &$result)
    {
        $result[] = $structure->id;

        if ($structure->descendants) {
            foreach ($structure->descendants as $descendant) {
                self::descendantIdsRecursive($descendant, $result);
            }
        }
    }
}
