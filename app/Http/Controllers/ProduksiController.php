<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usaha;
use App\Models\Produksi;
use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Distribusi;
use Exception;

class ProduksiController extends Controller
{
    public function index(Request $request)
    {
        $selections = null;
        $datas = \App\Models\Produksi::query();
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
            $datas->where('kategori_id', $kategori->id ?? 0);
            if($kategori){
                $selections['kategori'] = $kategori->toArray();
            }
        }
        
        if($request->has('tahun')){
            $datas->where('tahun', $request->input('tahun') ?? 0);
            $selections['tahun'] = $request->input('tahun');
        }

        $datas = $datas->get();
        $jenis = Jenis::all();
        $kategori = Kategori::all();
        $tahuns = (new Produksi)->tahuns();
        
        return view('admin.produksi.index', [
            'datas' => $datas, 
            'tahuns' => $tahuns,
            'kategori' => $kategori,
            'jenis' => $jenis,
            'selections' => $selections
        ]);
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

    public function getProduksiOptions()
    {
        $kategoriProduksi = Produksi::with('kategori')
            ->select('kategori_id')
            ->distinct()
            ->get()
            ->map(function ($item) {
                return $item->kategori->nama ?? 'Unknown';
            });

        $produksiByKategori = Produksi::select('kategori_id', \DB::raw('SUM(vol_produksi) as total_produksi'))
            ->groupBy('kategori_id')
            ->with('kategori')
            ->get()
            ->map(function ($item) {
                return [
                    'kategori' => $item->kategori->nama ?? 'Unknown',
                    'total_produksi' => $item->total_produksi,
                ];
            });

        $produksiByWilayah = Produksi::select('usaha.provinsi_id', \DB::raw('SUM(produksi.vol_produksi) as total_produksi'))
            ->join('usaha', 'produksi.usaha_id', '=', 'usaha.id')
            ->groupBy('usaha.provinsi_id')
            ->with('usaha.provinsi')
            ->get()
            ->map(function ($item) {
                return [
                    'provinsi' => $item->usaha->provinsi->nama ?? 'Unknown',
                    'total_produksi' => $item->total_produksi,
                ];
            });

        $produksiByYear = Produksi::select('tahun', \DB::raw('SUM(vol_produksi) as total_produksi'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        $statistikProduksiByKategori = Produksi::select('kategori_id', \DB::raw('SUM(vol_produksi) as total_produksi'))
            ->groupBy('kategori_id')
            ->with('kategori')
            ->get()
            ->map(function ($item) {
                return [
                    'kategori' => $item->kategori->nama ?? 'Unknown',
                    'total_produksi' => $item->total_produksi,
                ];
            }); 
        $datas = (object)[
            'kategori_produksi' => $kategoriProduksi,
            'produksi_by_kategori' => $produksiByKategori,
            'produksi_by_wilayah' => $produksiByWilayah,
            'produksi_by_year' => $produksiByYear,
            'statistik_produksi_by_kategori' => $statistikProduksiByKategori,
        ];
        return $datas;
    }

}

