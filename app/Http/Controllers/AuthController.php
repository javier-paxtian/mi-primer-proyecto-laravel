<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    function login(Request $request) {
        $credentials = $request->only('email', 'password');        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'message' => 'Inicio de sesión exitoso, Bienvenido ' . $user->name,
                'user' => $user,
            ]);
        }else {
            echo "no existe el usuario";
        }
    }
    function register(Request $request){
        $validator = Validator::make($request->all(), [            
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'name' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user = new User;
        $user->email = $request->get("email");
        $user->password = Hash::make($request->get("password"));
        $user->name = $request->get("name");
        $user->save();
        return response()->json(['message' => 'Registro exitoso', 'user' => $user], 201);
    }
    function logout(){
        Auth::logout();
        return response()->json(['message' => 'Cerrar sesión exitoso']);
    }    
}
