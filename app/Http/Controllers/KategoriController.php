<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Kategori::all();
        $jenis = Jenis::all();
        return view('admin.kategori.index', compact('datas','jenis'));
    }

    public function create(){
        $jenis = Jenis::all();
        return view('admin.kategori.add', compact('jenis'));
    }

    // Menampilkan data kategori berdasarkan ID
    public function show($id)
    {
        $kategori = Kategori::find($id);

        if ($kategori) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'data' => $kategori,
                'message' => 'Data kategori berhasil diambil.'
            ]);
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Kategori tidak ditemukan.'
            ]);
        }
    }

    // Menyimpan data kategori baru
    public function store(Request $request)
    {
        $data = $request->all();

        // Aturan validasi
        $rules = [
            'nama' => 'required|min:4',
            'deskripsi' => 'required|min:10',
            'jenis_id' => 'required|exists:jenis,id'  // Misal validasi untuk jenis_id ada di tabel jenis
        ];
        $valid = Validator::make($data, $rules);
        if ($valid->fails()) {
            return back()->withErrors($valid)->withInput();
        }

        // Simpan kategori baru
        $kategori = Kategori::create($data);

        return redirect()->route('adm.kategori.index');
    }

    // Mengupdate data kategori
    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Kategori tidak ditemukan.'
            ]);
        }
        
        // Aturan validasi
        $rules = [
            'nama' => 'required|min:4',
            'deskripsi' => 'required|min:10',
            'jenis_id' => 'required'//|exists:jenis,id'
        ];

        // Validasi data
        $valid = Validator::make($data, $rules);
        
        if ($valid->fails()) {
            return response()->json([
                'code' => 442,
                'status' => 'error',
                'errors' => $valid->errors(),
                'message' => 'Gagal mengupdate data.'
            ]);
        }

        // Update kategori
        $kategori->update($data);
        
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $kategori,
            'message' => 'Kategori berhasil diupdate.'
        ]);
    }

    // Menghapus data kategori
    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Kategori tidak ditemukan.'
            ]);
        }

        // Hapus kategori
        $kategori->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }

    public function getById($id){
        $data = Kategori::find($id);
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
