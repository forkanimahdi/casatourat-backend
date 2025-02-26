<?php

namespace App\Http\Controllers;

use App\Models\Clerkey;
use Illuminate\Http\Request;

class ClerckController extends Controller
{
    public function index()
    {
        return view('clerk.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'clerk' => 'required'
        ]);
        Clerkey::create([
            'clerk' => $request->clerk
        ]);
        return back();
    }
}
