<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Jenis::all();
        return view('admin.jenis.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jenis.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        unset($request['_token']);

        $valid = Validator::make($request->all(), [
            'nama' => 'required|min:4',
        ]);
        if($valid->fails()){
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'errors' => $valid->errors(),
                'message' => 'data tidak valid'
            ]);
        }

        $proc = Jenis::create($request->all());
        if(!$proc){
            return back()->With([
                'code' => 422,
                'status' => 'error',
                'data' => $proc,
                'message' => 'Data tidak sesuai'
            ]);
        }
        return redirect()->route('adm.jenis.index')->with([
            'code' => 200,
            'status' => 'ok',
            'data' => $proc,
            'message' => 'Data berhasil disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis $jenis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $valid = Validator::make($request->all(), [
            'nama' => 'required|unique:jenis'
        ]);

        if($valid->fails()){
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'errors' => $valid->errors(),
                'message' => 'gagal vaidasi data..'
            ]);
        }

        try{
            Jenis::where('id',$id)->update($request->all());
            
            return response()->json([
                'code' => 200,
                'status' => 'ok',
                'message' => 'data berhasil disimpan..!'
            ]);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($jenis)
    {
        $st = Jenis::where('id',$jenis)->delete();
        if(!$st){
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => 'gagal mendapatkan data'
            ]);
        }
        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => $st,
            'message' => 'fetch data success'
        ]);
    }

    public function getById($id){
        $data = Jenis::find($id);
        if(!$data){
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => 'gagal mendapatkan data'
            ]);
        }

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => $data,
            'message' => 'fetch data success'
        ]);
    }

    public function all(){
        $data = Jenis::all();
        if(!$data){
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => 'gagal mendapatkan data'
            ]);
        }

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => $data,
            'message' => 'fetch data success'
        ]);
    }
}
