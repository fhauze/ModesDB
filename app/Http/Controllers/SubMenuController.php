<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SubMenu;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response =[];
        $data = ['name' => $request->get('subiname')];
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:sub_menus',
            'display_name' => 'required',
            'type' => 'required',
            // 'menu_id' =>'required',
            'route_name' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422,['Content-Type' => 'application/json']);
        }

        $save = SubMenu::create($request->all());
        if($save){
            return $response = [
                'code' => 200,
                'status' => 'ok',
                'messages' => 'Data berhasil disimpan.!'
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'display_name' =>'required',
            'type' => 'required',
            // 'menu_id' =>'required',
            'route_name' => 'required'
        ]);
        
        if($validator->fails()){
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422,['Content-Type' => 'application/json']);
        }
        
        $sub = SubMenu::where('id',$id)->update($request->all());
        if($sub){
            return $response = [
                'code' => 200,
                'status' => 'ok',
                'messages' => 'Data berhasil disimpan.!'
            ];
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $process = SubMenu::find($id)->delete();
        if(!$process){
            return response()->json([
                'code' => 422,
                'status' => 'ok',
                'message' => 'success delete sub menu'
            ],422);
        }
        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'message' => 'success delete sub menu'
        ]);
    }
}
