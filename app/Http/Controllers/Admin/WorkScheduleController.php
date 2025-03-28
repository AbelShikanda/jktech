<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkingHour;
use Illuminate\Http\Request;

class WorkScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $work = WorkingHour::latest()->get();
        return view('admin.workSchedule.index', with([
            'work' => $work,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.workSchedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'is_off_day' => 'required|boolean',
        ]);

        WorkingHour::create([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'day_of_week' => $request->day_of_week,
            'is_off_day' => $request->is_off_day,
        ]);

        return redirect()->route('work.index')->with('success', 'working hour added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $work = WorkingHour::find($id);
        return view('admin.workSchedule.edit', with([
            'work' => $work,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'is_off_day' => 'required|boolean',
        ]);

        $workingHour = WorkingHour::findOrFail($id);

        $workingHour->update([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'day_of_week' => $request->day_of_week,
            'is_off_day' => $request->is_off_day,
        ]);

        return redirect()->route('work.index')->with('success', 'working hour updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workingHour = WorkingHour::findOrFail($id);
        $workingHour->delete();
        return redirect()->route('work.index')->with('success', 'working hour deleted successfully!');
    }
}
