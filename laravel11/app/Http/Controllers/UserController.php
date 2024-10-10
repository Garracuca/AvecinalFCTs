<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
         //Validar datos del formulario
        $validated = $request->validate([
            'numero_socio'=>'string',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        //crear un nuevo usuario

        $user =User::create([
            //numero de socio como sera nulo 
            'numero_socio'=>$validated['numero_socio'],
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password']),
            'role'=>$validated['role'],
        ]);

        // Redirigir o devolver una respuesta
        return response()->json(['message' => 'Usuario registrado con éxito']);

        
    }
   
}
