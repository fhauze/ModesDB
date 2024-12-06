<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function index(){

        return view('admin.module.index',['modules' => \App\Models\Module::all()]);
    }

    public function store(Request $request)
    {

        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:modules,slug',
            'model' => 'nullable'
        ]);
        unset($request->_token);
        if(!$valid->fails()){
            $proc = \App\Models\Module::create($request->all());
            if($proc){
                return redirect()->route('adm.modules.index');
            }

            return back()->withErrors($valid->errors())->withInput();
        }
    }

    public function update(Request $request, \App\Models\Module $module)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:modules,slug,' . $module->id,
            'model' => 'nullable'
        ]);
        unset($request->_token);
        
        if(!$valid->fails()){
            $proc = $module->update($request->all());
            if($proc){
                return redirect()->route('adm.modules.index');
            }

            return back()->withErrors($valid->errors())->withInput();
        }
        dd($valid->errors());
    }

    public function destroy($id)
    {
       $module = \App\Models\Module::where('id',$id)->get();
       
       if ($module) {
            // Hapus data terkait di module_permission
            DB::table('module_permission')->where('module_id', $module->id)->delete();
            $module->delete();
        
            return redirect()->route('adm.modules.index')->with('success', 'Module and related permissions deleted successfully.');
        }
        
        return redirect()->route('adm.modules.index')->with('error', 'Module not found.');
    }
}
