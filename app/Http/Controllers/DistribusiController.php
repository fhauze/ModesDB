<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Distribusi;
use Illuminate\Http\Request;

class DistribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selections = null;
        $datas = \App\Models\Distribusi::query();
        if($request->has('jenis')){
            $regex = "/[_\-\/\\\\]/";
            $search = preg_replace($regex,' ',$request->input('jenis'));
            if(!$search){
                $search =0;
            }
            $jenis = Jenis::whereRaw('lower(nama) like ? OR id=?', ['%'. strtolower($search) . '%',$search])->first();
            $datas->where('jenis_id', $jenis->id ?? 0);
            if($jenis){
                $selections['jenis'] = $jenis->toArray();
            }
        }

        if($request->has('kategori')){
            $regex = "/[_\-\/\\\\]/";
            $search = preg_replace($regex,' ',$request->input('kategori'));
            if(!$search){
                $search =0;
            }

            $kategori = Kategori::whereRaw('lower(nama) like ? OR id=?', ['%'. strtolower($search) . '%',$search])->first();
            $datas->where('kategory_id', $kategori->id ?? 0);
            if($kategori){
                $selections['kategori'] = $kategori->toArray();
            }
        }
        
        if($request->has('tahun')){
            $datas->where('tahun', $request->input('tahun') ?? 0);
            $selections['tahun'] = $request->input('tahun');
        }
        $datas = $datas->get();
        return view('admin.distribusi.index', [
            'datas' => $datas,
            'jenis' => Jenis::all(),
            'kategori' => Kategori::all(),
            'tahuns' => (new Distribusi)->tahuns(),
            'selections' => $selections
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function mode(Request $request, string $mode)
    {
        $validModes = ['add', 'ubah', 'view'];
        $data = null;
        $jenis = \App\Models\Jenis::all();
        $usaha = \App\Models\Usaha::all();
        $kategori = \App\Models\Kategori::all();
        if (!in_array($mode, $validModes)) {
            abort(404, 'Mode tidak ditemukan');
        }
        
        if(in_array($mode, ['ubah','view'])){
            if($request->has('id')){
                $data = \App\Models\Distribusi::select('distribusis.*', 'tahun as th')->where('id',$request->input('id'))->first();
            }
        }
        
        return view('admin.distribusi.add', [
            'usaha' => $usaha, 
            'mode' => $mode, 
            'data' => $data, 
            'jenis' => $jenis, 
            'kategoris' => $kategori
        ]);
    }

    /**
     * Store a 
     * newly created 
     * resource in storage.
    */
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'usaha_id' => 'required|string',
                'jenis_id' => 'required|string',
                'kategori_id' => 'required|integer',
                'deskripsi' => 'required|string',
                'negara_id' => 'nullable',
                'provinsi_id' => 'nullable',
                'kabkot_id' => 'nullable',
                'tahun' => 'nullable',
                'jenis_distribusi' => 'nullable',
                'volume' => 'required|integer',
                'satuan' => 'required|string',
            ]);
        }catch(Exception $e){
            dd($e);
        }
        try {
            \App\Models\Distribusi::create($validated);
            return redirect()->route('adm.distribusi.index');
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to create data. Please try again.' . $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Distribusi $distribusi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distribusi $distribusi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distribusi $distribusi)
    {
        try{
            $validated = $request->validate([
                'usaha_id' => 'required|string',
                'jenis_id' => 'required|string',
                'kategori_id' => 'required|integer',
                'deskripsi' => 'required|string',
                'negara_id' => 'nullable',
                'provinsi_id' => 'nullable',
                'kabkot_id' => 'nullable',
                'tahun' => 'nullable',
                'jenis_distribusi' => 'nullable',
                'volume' => 'required|integer',
                'satuan' => 'required|string',
            ]);
        }catch(Exception $e){
            dd($e);
        }
        try {
            $distribusi = Distribusi::findOrFail($distribusi->id);
            $distribusi->update($validated);
            return redirect()->route('adm.distribusi.index');
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to update data. Please try again.'.$e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distribusi $distribusi)
    {
        //
    }
}
