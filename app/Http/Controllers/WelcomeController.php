<?php

namespace App\Http\Controllers;

use App\Models\Dentist;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $dentists = Dentist::all();
        return view('welcome', compact('dentists'));
    }
}
