<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DentistController extends Controller
{
    public function index()
    {
        $dentists = DB::table('dentists')->get();
        return view('dentists.index', ['dentists' => $dentists]);
    }
}