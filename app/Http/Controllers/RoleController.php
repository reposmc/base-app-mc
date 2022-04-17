<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Encrypt;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $roles = Encrypt::encryptObject($roles, "id");

        return response()->json([
            "status"=>"success",
            "message"=>"Registro creado correctamente.",
            "roles" => $roles
        ]);
    }
}
