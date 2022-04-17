<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Models\Department;
use Illuminate\Http\Request;
use Encrypt;

class MunicipalityController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $municipalities = Municipality::all();

        foreach ($municipalities as $municipality) {
            $municipality->department_name = $municipality->department->department_name;
        }
        $municipalities->makeHidden(["department"]);

        $municipalities = Encrypt::encryptObject($municipalities, "id");

        return response()->json(["status"=>"success", "message"=>"Registro creado correctamente.", "municipalities"=>$municipalities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except("department_name");
        $department = Department::where("department_name", $request->department_name)->first();
        $data["department_id"] = $department->id;
        Municipality::insert($data);

        return response()->json(["status"=>"success", "message"=>"Registro creado correctamente."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function show(Municipality $municipality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $department = Department::where("department_name", $request->department_name)->first();
        $data = Encrypt::decryptArray($request->except(["department_name"]), "id");

        $data["department_id"] = $department->id;

        Municipality::where("id", $data)->update($data);
        return response()->json(["status"=>"success", "message"=>"Registro creado correctamente."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Encrypt::decryptValue($id);

        Municipality::where("id", $id)->delete();
        return response()->json(["status"=>"success", "message"=>"Registro creado correctamente."]);
    }
}
