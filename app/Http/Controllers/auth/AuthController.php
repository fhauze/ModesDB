<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $request['name'] = $request->first . ' ' . $request->last;
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        try{
            $this->login($request);
        }catch(Exception $e){
            dd($e);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return redirect()->intended('/adm')->with([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    
    public function logview(){
        return view('auth.login');
    }

    public function reg(){
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        // $credentials['password'] = Hash::make($request->get('password'));
        
        if (!Auth::attempt($credentials)) {
            return back()->with(['message' => 'Unauthorized'], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->intended('/adm')->with([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
    
    public function logout(Request $request)
    {
        if($request->user() && null != $request->user()->tokens()){
            $request->user()->tokens()->delete();
            return redirect()->route('/')->with(['message' => 'Successfully logged out']);
        }

    }
    
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
