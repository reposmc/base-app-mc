<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use App\Models\Department;
use Illuminate\Http\Request;

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
        $municipalities->makeHidden(['department']);

        $municipalities = EncryptController::encryptArray($municipalities, ['id']);

        return response()->json(['message' => 'success', 'municipalities'=>$municipalities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->except('department_name');
        $department = Department::where('department_name', $request->department_name)->first();
        $data['department_id'] = $department->id;
        Municipality::insert($data);

        return response()->json(['message'=>'success']);
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
        $department = Department::where('department_name', $request->department_name)->first();
        $data = EncryptController::decryptModel($request->except(['department_name']), 'id');
        // dd($data, $department);

        $data['department_id'] = $department->id;

        Municipality::where('id', $data['id'])->update($data);
        return response()->json(["message"=>"success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = EncryptController::decryptValue($id);

        Municipality::where('id', $id)->delete();
        return response()->json(["message"=>"success"]);
    }
}
