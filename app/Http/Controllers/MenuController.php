<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = array();
        $types =[['name' => 'Dropdown', 'value' => 'dropdown'], ['name' => 'Link', 'value' => 'link']];
        $parents = Menu::all();
        return view('admin.menu.add',compact('types','parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = [
            'code' => 404,
            'status' => 'error',
            'message' => 'Something went wrong'
        ];
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:menus',
            'type' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors() // Daftar kesalahan validasi
            ], 422,['Content-Type' => 'application/json']);
        }
        
        $process = Menu::create($request->all());
        if($process){
            $response = [
                'code' => 200,
                'status' => 'ok',
                'message' => 'Data completly save..!'
            ];
        }
        return response()->json($response,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $types = array();
        $types =[['name' => 'Dropdown', 'value' => 'dropdown'], ['name' => 'Link', 'value' => 'link']];
        $data = Menu::find($id);
        $parents = Menu::all();

        return view ('admin.menu.show', compact('data','types','parents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $valid = Validator::make($request->all(),[
            'name' => 'unique:menus',
            'type' => 'required'
        ]);

        if($valid->fails()){
            return response()->json([
                    'code' => 422,
                    'status' => 'ok',
                    'errors' => $valid->errors(),
                    'messages' => 'Data berhasil disimpan.!'
                ]
            );
        }
        $data = Menu::where('id',$id)->update($request->all());
        if($data){
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
        $menu = Menu::find($id);
        if($menu){
            $sub = SubMenu::where('menu_id', $menu->id)->delete();
            if($sub){
                $menu->delete();
            }
        }
    }

    public function getMenuByID($id){
        if (!is_numeric($id)) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'ID tidak valid'
            ], 400);
        }
        $data = Menu::find($id);
        if(!$data){
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => 'Gagala mendapatkan data'
            ],422);
        }else{
            return response()->json([
                'code' => 200,
                'status' => 'ok',
                'message' => 'fetching data successfull..',
                'data' => $data
            ],200, ['Content-Type' => 'application/json']);
        }
    }

    public function getSub($id){
        if (!is_numeric($id)) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'ID tidak valid'
            ], 400);
        }
        $data = SubMenu::find($id);
        if(!$data){
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => 'Gagala mendapatkan data'
            ],422);
        }else{
            return response()->json([
                'code' => 200,
                'status' => 'ok',
                'message' => 'fetching data successfull..',
                'data' => $data
            ],200, ['Content-Type' => 'application/json']);
        }
    }
}
