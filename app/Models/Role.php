<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Visualize json to flowcart https://vanya.jp.net/vtree/
    public static $roles = [];

    protected $fillable = ["role", "parent_id", "child_id"];

    public $timestamps = false;

    public static function role($child_id)
    {
        return self::where("child_id", $child_id)->first();
    }

    public static function parent($child_id)
    {
        $child = self::role($child_id);
        return self::where("child_id", $child->parent_id)->get();
    }

    public static function children($child_id)
    {
        return self::where("parent_id", $child_id)->get();
    }

    public static function parentNChildren($child_id)
    {
        $role = self::role($child_id);
        return response()->json([
            "role" => $role,
            "parent" => self::parent($role->child_id),
            "child" => self::children($role->child_id)
        ]);
    }

    // public static function allParentNChildren($child_id)
    // {
    //     $role = self::role($child_id);
    //     return response()->json([
    //         "role" => $role,
    //         "parent" => self::parent($role->child_id),
    //         "child" => self::children($role->child_id)
    //     ]);
    // }

    public static function childrenWFlow($child_id)
    {
        $response = self::role($child_id);
        self::recursiveChildren([$response]);
        $collection = collect(self::$roles);
        return $collection->filter(function ($value, $key) use ($child_id) {
            return $value['child_id'] === $child_id;
        })->shift();
    }

    public static function childrens($child_id)
    {
        $response = self::role($child_id);
        self::recursiveChildren([$response], false);
        return array_reverse(self::$roles);
    }

    private static function recursiveChildren($data, $withChildren = true)
    {
        foreach ($data as $value) {
            $childs = self::children($value->child_id);
            if (count($childs)) {
                if ($withChildren) $value->children = $childs;
                self::recursiveChildren($childs, $withChildren);
            }
            array_push(self::$roles, $value);
        }
    }

    public static function parents($child_id)
    {
        $response = self::role($child_id);
        self::recursiveParent([$response], false);
        return self::$roles;
    }

    public static function parentWFlow($child_id)
    {
        $response = self::role($child_id);
        self::recursiveParent([$response]);
        $collection = collect(self::$roles);
        return  $collection->filter(function ($value, $key) use ($child_id) {
            return $value['child_id'] === $child_id;
        })->shift();
    }

    private static function recursiveParent($data, $withParent = true)
    {
        foreach ($data as $value) {
            $childs = self::parent($value->child_id);
            if (count($childs)) {
                if ($withParent) $value->parent = $childs;
                self::recursiveParent($childs, $withParent);
            }
            array_push(self::$roles, $value);
        }
    }
}
