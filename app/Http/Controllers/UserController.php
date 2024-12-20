<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Mostrar todos los usuarios
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Mostrar formulario para crear un nuevo usuario
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     // Guardar un nuevo usuario
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'numero_socio' => 'nullable|unique:users',
             'name' => 'required',
             'email' => 'required|email|unique:users',
             'password' => 'required',
             'rol' => 'nullable|string|in:socio,tienda,admin',

         ]);
 
         $validatedData['password'] = bcrypt($validatedData['password']);
         User::create($validatedData);
 
         return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
     }

    /**
     * Display the specified resource.
     */
    // Mostrar un usuario en particular
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Mostrar formulario para editar un usuario
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
  
   // Actualizar un usuario
        public function update(Request $request, User $user)
        {
            // Validar los datos ingresados
            $validatedData = $request->validate([
                'numero_socio' => 'nullable|unique:users,numero_socio,' . $user->id,
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8', // La contraseña es opcional pero debe tener al menos 8 caracteres
                'rol' => 'required|string|in:socio,tienda,admin',

            ]);

            // Si se proporciona una contraseña, encriptarla
            if ($request->filled('password')) {
                $validatedData['password'] = bcrypt($request->password);
            } else {
                unset($validatedData['password']); // Elimina la clave si no se actualiza la contraseña
            }
              // Si el rol no está presente en el request, mantener el rol actual
            if (!$request->has('rol')) {
                $validatedData['rol'] = $user->rol; // Mantener el rol existente
            }

            

            // Actualizar el usuario con los datos validados
            $user->update($validatedData);

            // Redirigir con un mensaje de éxito
            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
        }


    /**
     * Remove the specified resource from storage.
     */
    // Eliminar un usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
