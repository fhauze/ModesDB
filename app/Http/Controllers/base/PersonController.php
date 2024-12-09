<?php

namespace App\Http\Controllers\base;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\base\Person;
use App\Models\Usaha;
use App\Models\Profile;
use App\Models\Profesi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    public function index(){
        return view('admin.base.person.index');
    }
    public function edit($id){
        $data = Person::find($id);
        $usaha = Usaha::all();
        $profesis = Profesi::all();
        
        return view('admin.base.person.edit', compact('data','usaha','profesis'));
    }
    public function update(Request $request, $id){
        
        $person_field =['nama','jenis_kelamin','tanggal_lahir','alamat','email','no_telepon','user_id'];
        $profile_field = ['person_id','usaha_id','sertifikasi','fbid','igid'];
        // dd($request->all());
        $valid = Validator::make($request->all(),[
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'no_telepon' => 'nullable',
            'user_id' => 'required',
            'person_id' => 'required',
            'usaha_id' => 'nullable',
            'sertifikasi' => 'nullable | string',
            'fbid' => 'nullable|string',
            'igid' => 'nullable|string'
        ]);
        
        if($valid->fails()){
            $errors = $valid->errors();
            return back()->withErrors($errors)->withInput();
        }
        
        
        $procPerson = Person::where('id',$id)->update($request->only($person_field));
        $procProfile = Profile::where('person_id', $id)->first();
        if($procPerson){
            $procProfile = Profile::Create($request->only($profile_field));
        }else{
            $procProfile = Profile::where('person_id', $id)->update($request->only($profile_field));
        }

        if($request->has('profesi_id')){
            // data [1,2,3]
            // if user with profesi exists remove from array
            $profesiids = $request->input('profesi_id');
            $profesi = DB::table('person_profesis')->where('person_id',$id)->get();
            if($profesi){
                DB::table('person_profesis')->where('person_id', $id)->delete();
            }
            
            $data = array_map(function ($profesi_id) use ($id){
                return [
                    'person_id' => $id,
                    'profesi_id' => $profesi_id,
                    'start_date' =>null
                ];
            },$profesiids);

            DB::table('person_profesis')->insert($data);
        }
        
        if($profesi){
            return back()->withErrors(['message' => 'Frofesi sudah digunakan.'])->withInput();
        }else{

        }
        $procProfile->update(['iscomplete' => true]);
        
        if($procPerson && $procProfile){
            $user = Auth::user();
            $user->assignRole('contributor');
            return redirect()->route('adm.home');
        }
    }

    public function show($id){
        $data = Person::find($id);
        $usaha = Usaha::all();
        
        return view('admin.base.person.view', compact('data','usaha'));
    }
}
