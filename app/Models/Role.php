<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $roles;

    protected $fillable = ["role", "parent_id", "child_id"];

    public $timestamps = false;

    // Visualize json to flowcart https://vanya.jp.net/vtree/
    public static function getAllChildren($child_id)
    {
        $response = self::getRole($child_id);
        self::recursiveChildren([$response]);

        $collection = collect(self::$roles);

        return $collection->filter(function ($value, $key) use ($child_id) {
            return $value['child_id'] === $child_id;
        });
    }

    public function getRole($child_id)
    {
        return self::where("child_id", $child_id)->first();
    }

    private function recursiveChildren($data)
    {
        foreach ($data as $value) {
            $childs = self::getChildren($value->child_id);
            if (count($childs)) {
                $value->children = $childs;
                self::recursiveChildren($childs);
            }
            array_push(self::$roles, $value);
        }
    }
}
