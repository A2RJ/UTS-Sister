<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function role($child_id)
    {
        return Role::role($child_id);
    }

    public function parent($child_id)
    {
        return Role::parent($child_id);
    }

    public function parents($child_id)
    {
        return Role::parents($child_id);
    }

    public function parentWFlow($child_id)
    {
        return Role::parentWFlow($child_id);
    }

    public function children($child_id)
    {
        return Role::children($child_id);
    }

    public function childrens($child_id)
    {
        return Role::childrens($child_id);
    }

    public function childrenWFlow($child_id)
    {
        return Role::childrenWFlow($child_id);
    }

    public function parentNChildren($child_id)
    {
        return Role::parentNChildren($child_id);
    }
}
