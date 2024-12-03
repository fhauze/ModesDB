<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Negara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Provinsi::all();
        $negara= Negara::all();
        return view('admin.provinsi.index', compact('data','negara'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules =[
            'nama' => 'required|min:4',
            'kode' => 'required|min:2',
            'negara_id' => 'required'
        ];
        
        $valid = Validator::make($data,$rules);
        if(!$valid->fails()){
            $proc = Provinsi::create($request->all());
            if($proc){
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'data' => $data,
                    'message' => 'Success menyimpan data.'
                ]);
            }
        }

        return response()->json([
            'code' => 442,
            'status' => 'error',
            'errors' => $valid->errors(),
            'message' => 'Gagal menyimpan data.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Provinsi $provinsi)
    {
        return response()->json($provinsi);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provinsi $provinsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provinsi $provinsi)
    {
        $data = $request->all();
        $rules =[
            'nama' => 'required|min:4',
            'kode' => 'required|min:2',
            'negara_id' => 'required'
        ];
        
        $valid = Validator::make($data,$rules);
        
        if($valid->fails()){
            return response()->json([
                'code' => 442,
                'status' => 'error',
                'errors' => $valid->errors(),
                'message' => 'Gagal menyimpan data.'
            ]);
        }

        try{
            $provinsi->update($data);
        
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'data' => $provinsi,
                'message' => 'Success menyimpan data.'
            ]);
        } catch (\Exception $e) {
            // Menangani error jika update gagal
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provinsi $provinsi)
    {
        //
    }
}
