<?php

namespace App\Http\Controllers;

use App\Models\Month;
use App\Models\Week;
use Illuminate\Http\Request;

class WeekController extends Controller
{
    /**
     * Display a listing of the weeks.
     */
    public function index()
    {
        // Cargar las semanas junto con sus turnos asociados
        $weeks = Week::with('shift')->get();
        return view('weeks.index', compact('weeks'));
    }

    /**
     * Show the form for creating a new week.
     */
    public function create()
    {
        return view('weeks.create');
    }

    /**
     * Store a newly created week in storage.
     */
    public function store(Request $request)
    {
        $month = Month::find($request->month_id);
    
        if (!$month) {
            return redirect()->back()->withErrors('El mes seleccionado no existe.');
        }
    
        // Insertar la semana
        Week::create([
            'start_date' => $request->start_date,
            'month_id' => $request->month_id,
        ]);
    
        return redirect()->route('weeks.index')->with('success', 'Semana creada correctamente.');
    }

    
    /**
     * Show the form for editing the specified week.
     */
    public function edit(Week $week)
    {
        return view('weeks.edit', compact('week'));
    }

    /**
     * Update the specified week in storage.
     */
    public function update(Request $request, Week $week)
    {
        $request->validate([
            'start_date' => 'required|date',
            'month_id' => 'required|exists:months,id',
        ]);

        $week->update($request->all());

        return redirect()->route('weeks.index')->with('success', 'Week updated successfully.');
    }

    /**
     * Remove the specified week from storage.
     */
    public function destroy(Week $week)
    {
        $week->delete();

        return redirect()->route('weeks.index')->with('success', 'Week deleted successfully.');
    }
}
