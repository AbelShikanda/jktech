<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Booking::with('user')->latest()->get();
        return view('admin.appointments.index', with([
            'appointments' => $appointments,
        ]));
    }

    public function show($id)
    {
        $appointment = Booking::with('user')->findOrFail($id);
        return view('admin.appointments.show', with([
            'appointment' => $appointment,
        ]));
    }

    public function edit($id)
    {
        $appointment = Booking::findOrFail($id);
        return view('admin.appointments.edit', with([
            'appointment' => $appointment,
        ]));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'message' => 'nullable|string',
        ]);

        $appointment = Booking::findOrFail($id);

        $appointment->update([
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'message' => $request->message,
            'confirmed' => $request->has('confirmed'),  // Safely handle checkbox
        ]);

        return redirect()->route('appointment.index')->with('success', 'appointment updated successfully.');
    }
}
