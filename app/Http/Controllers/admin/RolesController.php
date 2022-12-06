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

    private function test_odd($var)
    {
        return ($var & 1);
    }

    public function getChildrens($child_id)
    {
        $response = $this->getRole($child_id);
        $this->recursiveChildren([$response]);

        $result = [];
        $current = 0;
        // for ($i = 0; $i < count($this->roles); $i++) {
        //     $parent = $this->roles[$i];
        //     if ($i === 0) {
        //         $parent->tab = 0;
        //         array_push($result, $parent);
        //     }
        //     for ($j = 0; $j < count($this->roles); $j++) {
        //         $child = $this->roles[$j];
        //         if ($parent->parent_id === $child->child_id) {
        //             $parent->tab = $j + 1;
        //             array_push($result, $parent);
        //         }
        //     }
        // }

        $newArray = [];
        for ($i = 0; $i < count($this->roles); $i++) {
            $current = $this->roles[$i];
            if ($i !== 0) {
                $prev = $this->roles[$i - 1];
                if ($prev->child_id === $current->parent_id) {
                    array_push($newArray, [
                        $i => $current
                    ]);
                }
            } else {
                array_push($newArray, [
                    $i => $current
                ]);
            }
        }

        return $newArray;
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
    }
}
