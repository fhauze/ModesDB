<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usaha;
use Exception;

class ProduksiController extends Controller
{
    public function index()
    {
        try {
            $usaha = Usaha::all();
            return response()->json($usaha);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to retrieve data. Please try again.'], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha' => 'required|string',
            'nomor_telepon' => 'required|string',
            'email' => 'required|email',
            'ig_fb' => 'nullable|string',
            'alamat' => 'required|string',
            'tahun_memulai_usaha' => 'required|date',
            'nib' => 'required|string|unique:organization,nib',
            'pekerja' => 'required|integer'
        ]);

        try {
            $org = Organization::create($validated);
            return response()->redirect()->with(['message' => 'Data successfully created.', 'data' => $org], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to create data. Please try again.'], 500);
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
            'nama_usaha' => 'sometimes|required|string',
            'nomor_telepon' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'ig_fb' => 'sometimes|nullable|string',
            'alamat' => 'sometimes|required|string',
            'tahun_memulai_usaha' => 'sometimes|required|date',
            'nib' => 'sometimes|required|string|unique:usaha,nib,' . $id,
            'pekerja' => 'sometimes|required|integer'
        ]);

        try {
            $usaha = Usaha::findOrFail($id);
            $usaha->update($validated);
            return response()->json(['message' => 'Data successfully updated.', 'data' => $usaha]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to update data. Please try again.'], 500);
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

