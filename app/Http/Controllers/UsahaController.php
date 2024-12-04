<?php

namespace App\Http\Controllers;

use App\Models\Usaha;
use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Negara;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.usaha.index', [
            'datas' => Usaha::all(),
            'jenis' => Jenis::all()->toArray(),
            'tahuns' => (new Usaha)->tahuns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usaha.add',[
            'negara' => Negara::all(),
            'provinsi' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
            'jenis' => Jenis::all()->toArray(),
            'kategori' => Kategori::all(),
            'socials' => [
                ['id' => 'Facebook', 'name' => 'Facebook'],
                ['id' => 'Instagram', 'name' => 'Instagram'],
                ['id' => 'TokTok', 'name' => 'TikTok']
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->merge(['person_id' => Auth::user()->person->id]);
        
        $valid = Validator::make($request->all(),[
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_id' => 'required',
            'teknologi' => 'nullable',
            'pekerja' => 'required',
            'sertifikasi' => 'nullable',
            'tahun_berdiri' => 'required',
            'deskripsi' => 'nullable',
            'social_media' => 'nullable',
            'sosmed_accoutn' => 'nullable',
            'website' => 'nullable',
            'provinsi_id' => 'required',
            'kabkot_id' => 'required',
            'org_id' =>'nullable',
            'person_id' => 'nullable',
            'kategori_id' => 'nullable'
        ]);
        
        if($valid->fails()){
            return back()->withErrors($valid->errors())->withInput();
        }

        try{
            unset($request->_token);
            $process = Usaha::create($request->all());
            if($process){
                return redirect()->route('adm.usaha.index');
            }
        }catch(Exception $e){
            dd('Error : ' .$e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Usaha $usaha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usaha $usaha)
    {
        return view('admin.usaha.edit', [
            'usaha' => $usaha,
            'jenis' => Jenis::all()->toArray(),
            'tahuns' => (new Usaha)->tahuns(),
            'provinsi' => Provinsi::all(),
            'kabupatens' => Kabupaten::all(),
            'jenis' => Jenis::all()->toArray(),
            'kategori' => Kategori::all(),
            'socials' => [
                ['id' => 'Facebook', 'name' => 'Facebook'],
                ['id' => 'Instagram', 'name' => 'Instagram'],
                ['id' => 'TokTok', 'name' => 'TikTok']
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usaha $usaha)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'provinsi_id' => 'required|integer',
            'kabkot_id' => 'required|integer',
            'teknologi' => 'nullable|string|max:255',
            'pekerja' => 'nullable|integer',
            'sertifikasi' => 'nullable|string|max:255',
            'tahun_berdiri' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
            'social_media' => 'nullable|string|max:255',
            'sosmed_accoutn' => 'nullable|string|max:255',
            'website' => 'nullable|url',
        ]);
        
        $usaha->update($request->all());

        return redirect()->route('adm.usaha.index')->with('success', 'Data usaha berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usaha $usaha)
    {
        $process = $usaha->delete();
        return redirect()->route('adm.usaha.index');
    }

    public function getLastTenYears()
    {
        $currentYear = date('Y');
        $lastTenYears = range($currentYear, $currentYear - 9);
        return $lastTenYears;
    }
}
