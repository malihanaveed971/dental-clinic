<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Handles the form submission from your homepage
    public function requestAppointment(Request $request)
    {
        $validated = $request->validate([
            'patient_name' => 'required|string',
            'dentist_id' => 'required|exists:dentists,id',
            'appointment_time' => 'required|date',
        ]);

        // Your DB column is `appointment_date`, but the form submits `appointment_time`.
        $validated['appointment_date'] = $validated['appointment_time'];
        unset($validated['appointment_time']);

        Appointment::create($validated);


        return back()->with('success', 'Appointment request submitted successfully!');
    }

    // Handles the "My Appointments" page
    public function index()
    {
        $appointments = Appointment::with('dentist')
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('appointments.index', compact('appointments'));
    }
}