<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $holiday = Holiday::orderBy('date')->get();
        return view('admin.holiday.index', compact('holiday'));
    }

    public function create()
    {
        return view('admin.holiday.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:holidays,date',
            'reason' => 'nullable|string|max:255',
        ]);

        Holiday::create($request->only(['date', 'reason']));

        return redirect()->route('holiday.index')->with('success', 'Holiday added successfully.');
    }

    public function show(string $id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('admin.holiday.show', compact('holiday'));
    }

    public function edit(string $id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('admin.holiday.edit', compact('holiday'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'date' => 'required|date|unique:holidays,date,' . $id,
            'reason' => 'nullable|string|max:255',
        ]);

        $holiday = Holiday::findOrFail($id);
        $holiday->update($request->only(['date', 'reason']));

        return redirect()->route('holiday.index')->with('success', 'Holiday updated successfully.');
    }

    public function destroy(string $id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->delete();

        return redirect()->route('holiday.index')->with('success', 'Holiday deleted successfully.');
    }
}
