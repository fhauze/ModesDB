<?php

namespace App\Http\Controllers\base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\base\Organization;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class OrganizationController extends Controller
{
    public function index(){
        return view('admin.base.organization.index');
    }
    public function create(){
        return view('admin.base.organization.add');
    }

    public function store(Request $request){
        $fields = [
            'nama_usaha',
            'nomor_telepon',
            'email',
            'ig_fb',
            'alamat',
            'tahun_memulai_usaha',
            'nib'
        ];
        $rules = [
            $fields[0] => 'required|string',
            $fields[1] => 'required|string',
            $fields[2] => 'required|string',
            $fields[3] => 'nullable|string',
            $fields[4] => 'required|string',
            $fields[5] => 'required',
            $fields[6] => 'string|unique:organization,nib'
        ];
        $validator = Validator::make($request->all(),$rules);
        $requiredFields = array_keys(array_filter($rules, function($rule) {
            return str_contains($rule, 'required');
        }));
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('requiredFields', $requiredFields);;
        }
        try {
            $org = Organization::create($request->only($fields));
            return redirect()->route('adm.org.index')->with(['message' => 'Data successfully created.', 'data' => $org], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to create data. Please try again.'], 500);
        }
    }

    public function edit(Request $request, $id){
        try {
            
            $data = Organization::findOrFail($id);
            
            return view('admin.base.organization.edit', compact('data'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('organizations.index')->with('error', 'Organization not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $fields = [
            'nama_usaha',
            'nomor_telepon',
            'email',
            'ig_fb',
            'alamat',
            'tahun_memulai_usaha',
            'nib'
        ];
        $rules = [
            $fields[0] => 'required|string',
            $fields[1] => 'required|string',
            $fields[2] => 'required|string|email',
            $fields[3] => 'nullable|string',
            $fields[4] => 'required|string',
            $fields[5] => 'required',
            $fields[6] => 'string'
        ];
        
        $validator = Validator::make($request->all(),$rules);
        $requiredFields = array_keys(array_filter($rules, function($rule) {
            return str_contains($rule, 'required');
        }));
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('requiredFields', $requiredFields);;
        }

        try {
            $data = Organization::findOrFail($id);
            $data->update($request->only($fields));
            return redirect()->route('adm.org.index')->with(['message' => 'Data successfully updated.', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to update data. Please try again.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $data = Organization::findOrFail($id);
            return view('admin.base.organization.show', compact('data'));
        } catch (Exception $e) {
            return response()->json(['message' => 'Data not found. Please check the ID and try again.'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $usaha = Organization::findOrFail($id);
            $usaha->orang->delete(); 
            $usaha->delete();

            return response()->json(['message' => 'Data successfully deleted.']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete data. Please try again.'], 500);
        }
    }

    public function getData()
    {
        try {
            $data = Organization::all();
            return response()->json(['data' => $data]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to retrieve data. Please try again.'], 500);
        }
    }
}
