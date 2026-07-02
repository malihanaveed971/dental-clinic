<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function dashboard(Request $request)
    {
        // For now, the dashboard is a static view.
        // Later you can pass patient-specific data.
        return view('patients.index');
    }
}


