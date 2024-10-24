<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use App\Models\TypeTurn;
use App\Models\User;
use App\Models\Week;
use Illuminate\Http\Request;

class TurnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Mostrar todos los turnos
    public function index()
    {
        $turns = Turn::with(['typeTurn', 'user', 'week'])->get();
        return view('turns.index', compact('turns'));
    }

    /**
     * Show the form for creating a new resource.
     */
      // Mostrar formulario para crear un nuevo turno
      public function create()
      {
          // Cargar usuarios y tipos de turnos
          $users = User::all();
          $typeTurns = TypeTurn::all();
          $weeks = Week::all();
  
          return view('turns.create', compact('users', 'typeTurns', 'weeks'));
      }

    /**
     * Store a newly created resource in storage.
     */
    // Guardar un nuevo turno
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type_turn_id' => 'required|exists:type_turns,id',
            'date' => 'required|date',
            'hour' => 'required',
            'duration' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'week_id' => 'required|exists:weeks,id',
        ]);

        Turn::create($validatedData);

        return redirect()->route('turns.index')->with('success', 'Turno creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
   // Mostrar un turno en particular
   public function show(Turn $turn)
   {
    $turn->load('typeTurn', 'user', 'week');
    return view('turns.show', compact('turn'));
   }

    /**
     * Show the form for editing the specified resource.
     */
    // Mostrar formulario para editar un turno
    public function edit(Turn $turn)
    {
        $users = User::all();
        $typeTurns = TypeTurn::all();
        $weeks = Week::all();

        return view('turns.edit', compact('turn', 'users', 'typeTurns', 'weeks'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Actualizar un turno
    public function update(Request $request, Turn $turn)
    {
        $validatedData = $request->validate([
            'type_turn_id' => 'required|exists:type_turns,id',
            'date' => 'required|date',
            'hour' => 'required',
            'duration' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'week_id' => 'required|exists:weeks,id',
        ]);

        $turn->update($validatedData);

        return redirect()->route('turns.index')->with('success', 'Turno actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    // Eliminar un turno
    public function destroy(Turn $turn)
    {
        $turn->delete();
        return redirect()->route('turns.index')->with('success', 'Turno eliminado correctamente.');
    }
}
