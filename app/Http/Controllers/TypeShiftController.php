<?php

namespace App\Http\Controllers;

use App\Models\TypeShift;
use App\Models\TypeTurn;
use Illuminate\Http\Request;

class TypeShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Mostrar todos los tipos de turnos
    public function index()
    {
        $typeTurns = TypeShift::all();
        return view('type_Shift.index', compact('typeShift'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Mostrar formulario para crear un nuevo tipo de turno
    public function create()
    {
        return view('type_Shift.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   // Guardar un nuevo tipo de turno
   public function store(Request $request)
   {
       $validatedData = $request->validate([
           'name' => 'required|unique:type_Shift',
       ]);

       TypeShift::create($validatedData);

       return redirect()->route('type_Shift.index')->with('success', 'Tipo de turno creado correctamente.');
   }

    /**
     * Display the specified resource.
     */
    // Mostrar un tipo de turno en particular
    public function show(TypeShift $type_Shift)
    {
        return view('type_Shift.show', compact('type_Shift'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Mostrar formulario para editar un tipo de turno
    public function edit(TypeShift $type_Shift)
    {
        return view('type_Shift.edit', compact('type_Shift'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Actualizar un tipo de turno
    public function update(Request $request, TypeShift $type_Shift)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:type_Shift,name,' . $type_Shift->id,
        ]);

        $type_Shift->update($validatedData);

        return redirect()->route('type_Shift.index')->with('success', 'Tipo de turno actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    // Eliminar un tipo de turno
    public function destroy(TypeShift $typeTurn)
    {
        $typeTurn->delete();
        return redirect()->route('type_Shift.index')->with('success', 'Tipo de turno eliminado correctamente.');
    }
}
