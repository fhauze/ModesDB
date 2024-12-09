<?php

namespace App\Http\Controllers;

use App\Models\Profesi;
use Illuminate\Http\Request;
use Illumnate\Support\Facades\Exception;

class ProfesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.profesi.index', [
            'datas' =>Profesi::all(),
        ]);
    }

    /**
     * @param mode
     * mode untuk crate add dan view
     */
    public function mode(Request $request, string $mode){
        $data = null;
        $modes = ['tambah','ubah', 'lihat'];

        if(!in_array($mode, $modes)){
            abort(404, 'Mode tidak diketahui');
        }

        if(in_array($mode,['ubah','lihat']) && $request->input('id')){
            $data = Profesi::find($request->input('id'))->first();
        }

        return view('admin.profesi.add',[
            'data' => $data,
            'mode' => $mode,

        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'nama' => 'required|min:4'
            ]);
            unset($request['_token']);
            $process = Profesi::create($request->all());
            return redirect()->route('adm.profesi.index');
        }catch(Exception $e){
            return response()->jsno([
                'message' => $e,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profesi $profesi)
    {
        try{
            $request->validate([
                'nama' => 'required|min:4'
            ]);
            unset($request['_token']);
            $profesi->update($request->all());
            return redirect()->route('adm.profesi.index');
        }catch(Exception $e){
            return response()->jsno([
                'message' => $e,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesi $profesi)
    {
        //
    }
}
