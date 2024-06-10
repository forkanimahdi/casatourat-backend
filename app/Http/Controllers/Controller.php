<?php

namespace App\Http\Controllers;

use App\Models\Visitor;

abstract class Controller
{
    public function index()
    {
        $visitors = Visitor::all();
        return view('dashboard', compact('visitors'));
    }
}
