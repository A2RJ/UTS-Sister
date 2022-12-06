<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RolesController extends Controller
{
    private $roles = [];
    private $rolesWithChildren = [];

    public function index()
    {
        return Role::all();
    }

    public function parentNChildren($child_id)
    {
        $current = Role::where("child_id", $child_id)->first();
        return response()->json([
            "current" => $current,
            "parent" => $this->getParent($current->parent_id),
            "child" => $this->getChildren($current->child_id)
        ]);
    }

    public function getRole($child_id)
    {
        return Role::where("child_id", $child_id)->first();
    }

    public function getRoles($child_id)
    {
        return $this->getParent($child_id);
    }

    public function getParent($child_id)
    {
        return Role::where("child_id", $child_id)->get();
    }

    public function getChildren($child_id)
    {
        return Role::where("parent_id", $child_id)->get();
    }

    public function getChildrens($child_id)
    {
        $response = $this->getRole($child_id);
        $this->recursiveChildren([$response]);

        for ($i = 0; $i < count($this->roles); $i++) {
            $parent = $this->roles[$i];
            for ($j = 0; $j < count($this->roles); $j++) {
                $child = $this->roles[$j];
                if ($parent->parent_id === $child->child_id) {
                    for ($h = 0; $h < $j; $h++) {
                        echo "*";
                    }
                    echo $parent->role . "<br>";
                }
            }
        }
    }

    private function recursiveChildren($data)
    {
        foreach ($data as $value) {
            array_push($this->roles, $value);
            $childs = $this->getChildren($value->child_id);
            if (count($childs)) {
                $this->recursiveChildren($childs);
            }
        }

        // for ($i = 0; $i < count($data); $i++) {
        //     // echo $data[$i]->role . " " . $this->count . "<br>";
        //     array_push($this->roles, $data[$i]);
        //     $childs = $this->getChildren($data[$i]->child_id);
        //     if (count($childs)) {
        //         $this->recursiveChildren($childs);
        //     }
        // }
    }
}
