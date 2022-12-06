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
        return Role::getAllChildren($child_id);
    }
}
