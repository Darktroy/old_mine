<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function store()
    {

    }

    /**
     * @param $role
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function checkRolePermission($role)
    {
        if (auth()->user()->type == 0) return true;
        if (!auth()->user()->hasRole($role)) {
            return false;
        }

        return true;
    }
}
