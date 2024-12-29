<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    public function getMateri()
    {
        $materis = DB::select('SELECT * FROM materi');
        return view('page.home', compact('materis'));
    }
}