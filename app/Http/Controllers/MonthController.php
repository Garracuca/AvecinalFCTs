<?php

namespace App\Http\Controllers;

use App\Models\Month;
use Illuminate\Http\Request;
use App\Models\Event;



class MonthController extends Controller
{
    /**
     * Display a listing of the months.
     */
    public function index()
    {
       // $months = Month::all();
        //return view('months.index', compact('months'));
        $all_events = Event::all();

        $events = [];

        foreach ($all_events as $event) {
            $events[] = [
                'title' => $event->event,
                'start' => $event->start_date,
                'end' => $event->end_date,

            ];
        }

        return view('months.index', compact('events'));
    
    }

    /**
     * Show the form for creating a new month.
     */
    public function create()
    {
        return view('months.create');
    }

    /**
     * Store a newly created month in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'weeks' => 'required|integer',
        ]);

        Month::create($request->all());

        return redirect()->route('months.index')->with('success', 'Month created successfully.');
    }

    /**
     * Show the form for editing the specified month.
     */
    public function edit(Month $month)
    {
        return view('months.edit', compact('month'));
    }

    /**
     * Update the specified month in storage.
     */
    public function update(Request $request, Month $month)
    {
        $request->validate([
            'start_date' => 'required|date',
            'weeks' => 'required|integer',
        ]);

        $month->update($request->all());

        return redirect()->route('months.index')->with('success', 'Month updated successfully.');
    }

    /**
     * Remove the specified month from storage.
     */
    public function destroy(Month $month)
    {
        $month->delete();

        return redirect()->route('months.index')->with('success', 'Month deleted successfully.');
    }
 
}