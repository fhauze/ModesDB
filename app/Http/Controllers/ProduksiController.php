<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usaha;
use App\Models\Produksi;
use App\Models\Jenis;
use App\Models\Kategori;
use Exception;

class ProduksiController extends Controller
{
    public function index()
    {
        return view('admin.produksi.index', ['datas' => Produksi::all()]);
    }

    public function mode(Request $request, string $mode)
    {
        $validModes = ['create', 'ubah', 'view'];
        $data = null;
        $jenis = Jenis::all();
        $usaha = Usaha::all();
        $kategori = Kategori::all();
        if (!in_array($mode, $validModes)) {
            abort(404, 'Mode tidak ditemukan');
        }
        // dd([$request->all(), $mode, in_array($mode, $validModes)]);
        if(in_array($mode, ['ubah','view'])){
            if($request->has('id')){
                $data = \App\Models\Produksi::select('produksi.*', 'tahun as th')->where('id',$request->input('id'))->first();
            }
        }
        
        $viewName = match($mode) {
            'create' => 'admin.produksi.add',
            'ubah' => 'admin.produksi.edit',
            'view' => 'admin.produksi.show',
            default => abort(404, 'View tidak ditemukan'),
        };
        return view('admin.produksi.add', [
            'usaha' => $usaha, 
            'mode' => $mode, 
            'data' => $data, 
            'jenis' => $jenis, 
            'kategoris' => $kategori
        ]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        try{
            $validated = $request->validate([
                'usaha_id' => 'required|string',
                'jenis_id' => 'required|string',
                'kategori_id' => 'required|integer',
                'tahun' => 'nullable|string',
                'pekerja' => 'nullable|integer',
                'vol_produksi' => 'required|integer',
                'bahan_baku' => 'required|string',
                'persentase_bahan_lokal' => 'nullable|integer',
                'persentase_bahan_impor' => 'nullable|integer'
            ]);
        }catch(Exception $e){
            dd($e);
        }
        try {
            $org = Produksi::create($validated);
            return redirect()->route('adm.produksi.index');
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to create data. Please try again.' . $e], 500);
        }
    }

    public function show($id)
    {
        try {
            $usaha = Usaha::findOrFail($id);
            return response()->json($usaha);
        } catch (Exception $e) {
            return response()->json(['message' => 'Data not found. Please check the ID and try again.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'usaha_id' => 'required|string',
            'jenis_id' => 'required|string',
            'kategori_id' => 'required|integer',
            'tahun' => 'nullable|string',
            'pekerja' => 'nullable|integer',
            'vol_produksi' => 'required|integer',
            'bahan_baku' => 'required|string',
            'persentase_bahan_lokal' => 'nullable|integer',
            'persentase_bahan_impor' => 'nullable|integer'
        ]);

        try {
            $produksi = Produksi::findOrFail($id);
            $produksi->update($validated);
            return redirect()->route('adm.produksi.index');
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to update data. Please try again.'.$e], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $usaha = Usaha::findOrFail($id);
            $usaha->orang->delete(); 
            $usaha->delete();

            return response()->json(['message' => 'Data successfully deleted.']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete data. Please try again.'], 500);
        }
    }

}

