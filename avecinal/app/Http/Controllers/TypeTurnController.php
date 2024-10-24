<?php

namespace App\Http\Controllers;

use App\Models\TypeTurn;
use Illuminate\Http\Request;

class TypeTurnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Mostrar todos los tipos de turnos
    public function index()
    {
        $typeTurns = TypeTurn::all();
        return view('type_turns.index', compact('typeTurns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Mostrar formulario para crear un nuevo tipo de turno
    public function create()
    {
        return view('type_turns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   // Guardar un nuevo tipo de turno
   public function store(Request $request)
   {
       $validatedData = $request->validate([
           'name' => 'required|unique:type_turns',
       ]);

       TypeTurn::create($validatedData);

       return redirect()->route('type_turns.index')->with('success', 'Tipo de turno creado correctamente.');
   }

    /**
     * Display the specified resource.
     */
    // Mostrar un tipo de turno en particular
    public function show(TypeTurn $typeTurn)
    {
        return view('type_turns.show', compact('typeTurn'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Mostrar formulario para editar un tipo de turno
    public function edit(TypeTurn $typeTurn)
    {
        return view('type_turns.edit', compact('typeTurn'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Actualizar un tipo de turno
    public function update(Request $request, TypeTurn $typeTurn)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:type_turns,name,' . $typeTurn->id,
        ]);

        $typeTurn->update($validatedData);

        return redirect()->route('type_turns.index')->with('success', 'Tipo de turno actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    // Eliminar un tipo de turno
    public function destroy(TypeTurn $typeTurn)
    {
        $typeTurn->delete();
        return redirect()->route('type_turns.index')->with('success', 'Tipo de turno eliminado correctamente.');
    }
}
