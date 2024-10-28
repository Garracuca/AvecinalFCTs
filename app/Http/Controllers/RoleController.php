<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Mostrar todos los roles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Mostrar formulario para crear un nuevo rol
    public function create()
    {
        return view('roles.create');
    
    }

    /**
     * Store a newly created resource in storage.
     */
     // Guardar un nuevo rol
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'name' => 'required|unique:roles',
         ], [
            'name.required' => 'El campo de nombre es obligatorio.',
            'name.unique' => 'Este nombre ya está en uso.',
        ]);
 
         Role::create($validatedData);
 
         return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
     }

    /**
     * Display the specified resource.
     */
   // Mostrar un rol en particular
   public function show(Role $role)
   {
       return view('roles.show', compact('role'));
   }

    /**
     * Show the form for editing the specified resource.
     */
     // Mostrar formulario para editar un rol
     public function edit(Role $role)
     {
         return view('roles.edit', compact('role'));
     }
 

    /**
     * Update the specified resource in storage.
     */
    // Actualizar un rol
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update($validatedData);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Eliminar un rol
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
    }
}
