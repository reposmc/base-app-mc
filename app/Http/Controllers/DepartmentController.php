<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Encrypt;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        $departments = Encrypt::encryptObject($departments, 'id');

        return response()->json([
            "status"=>"success",
            "message"=>"Registros obtenidos correctamente.",
            'departments'=>$departments
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
        Department::insert($request->all());

        return response()->json([
            "status"=>"success",
            "message"=>"Registro creado correctamente."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        Department::where('id', $data)->update($data);
        return response()->json([
            "status"=>"success",
            "message"=>"Registro modificado correctamente."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Encrypt::decryptValue($id);

        Department::where('id', $id)->delete();
        return response()->json([
            "status"=>"success",
            "message"=>"Registro eliminado correctamente."
        ]);
    }
}
