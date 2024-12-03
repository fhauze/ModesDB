<?php

namespace App\Http\Controllers;

use App\Models\Usaha;
use Illuminate\Http\Request;

class UsahaController extends Controller
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
        //
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
        return view('admin.usaha.edit', compact('usaha'));
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

        return redirect()->route('usaha.index')->with('success', 'Data usaha berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usaha $usaha)
    {
        //
    }
}
