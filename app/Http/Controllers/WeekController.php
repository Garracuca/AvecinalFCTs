<?php

namespace App\Http\Controllers;

use App\Models\Week;
use Illuminate\Http\Request;

class WeekController extends Controller
{
    /**
     * Display a listing of the weeks.
     */
    public function index()
    {
        $weeks = Week::all();
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
        $request->validate([
            'start_date' => 'required|date',
            'month_id' => 'required|exists:months,id',
        ]);

        Week::create($request->all());

        return redirect()->route('weeks.index')->with('success', 'Week created successfully.');
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
