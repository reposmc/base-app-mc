<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;
use Spatie\Permission\Models\Role;
use Encrypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skip = $request->skip;
        $limit = $request->take - $skip; // the limit

        $users = User::skip($skip)->take($limit)
        ->get();

        $users->makeVisible(["password"]);

        foreach ($users as $user) {
            $user->rol = $user->getRoleNames()[0];
        }

        $users = Encrypt::encryptObject($users, "id");

        $total = User::count();

        return response()->json([
            "status" => "success",
            "message"=>"Registros obtenidos correctamente.",
            "users" => $users,
            "total" => $total,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = count(User::where(["email"=>$request->email])->get());

        if ($user > 0) {
            return response()->json([
                "status"=>"fail",
                "message"=>"Este email ya existe."
            ]);
        }

        $password = Hash::make($request->password);

        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->dui = $request->dui;
        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->password = $password;

        $user->save();

        $role = Role::where("name", $request->rol)->first();
        $user->assignRole($role);

        return response()->json([
            "status"=>"success",
            "message"=>"Registro creado correctamente."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Encrypt::decryptValue($request->id);
        $user = User::find($id);

        $password = Hash::make($request->password);

        $data = [
            "name" => $request->name,
            "lastName" => $request->lastName,
            "email" => $request->email,
            "password" => $password,
        ];

        if (isset($request->rol)) {
            $oldRole = DB::table("model_has_roles")->where("model_id", $user->id)->delete();

            $role = Role::where("name", $request->rol)->first();
            $user->assignRole($role);
        }

        $user->update($data);

        return response()->json([
            "status"=>"success",
            "message"=>"Registro creado correctamente."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user->delete();
        return response()->json([
            "status"=>"success",
            "message"=>"Registro creado correctamente."
        ]);
    }

    /**
     * Gets the specified user resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualUser(Request $request)
    {
        $user = User::find(auth()->user()->id);

        return response()->json([
            "status"=>"success",
            "message"=>"Registro creado correctamente.",
            "user"=> $user
        ]);
    }
}
