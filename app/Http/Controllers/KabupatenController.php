<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Negara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.kabkota.index', ['data' => Kabupaten::all(), 'provinsi' => Provinsi::all(), 'negara' => Negara::all()]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'kode' => 'required|unique',
            'provinsi_d' => 'required'
        ]);

        $save = Kabupaten::create($request->all());
        if(!$save){
            return response()->json([
                'code' =>  422,
                'status' => 'error',
                'message' => 'Gagal menyimpan data.'
            ]);
        }
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Data tersimpan.',
            'data' => $save
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kabupatens $kabupatens)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $valid = Validator::make($request->all(),[
            'nama' => 'required',
            'kode' => 'required',
            'provinsi_id' => 'required'
        ]);
        
        if($valid->fails()){
            return response()->json([
                'code' => 422,
                'status' => 'error',
                'errors' => $valid->errors(),
                'message' => 'Gagal menyimppan data.'
            ]);
        }
        try{
            $kabupatens = Kabupaten::find($id)->first();
            $process = $kabupatens->update($request->all());
            
            if (!$process) {
                return response()->json([
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'Gagal menyimpan data.'
                ]);
            }
            if($process){
                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'data' => $kabupatens,
                    'message' => 'Success menyimpan data.'
                ]);
            }
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
    public function destroy($id)
    {
        $process = Kabupaten::findOrFail($id)->delete();
        if(!$process){
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ]);
        }
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $kabupatens,
            'message' => 'Success menyimpan data.'
        ]);
    }
}
