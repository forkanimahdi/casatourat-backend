<?php

namespace App\Http\Controllers;

use App\Models\Clerkey;
use Illuminate\Http\Request;

class ClerckController extends Controller
{
    public function index()
    {
        $clerks = Clerkey::latest()->get();
        return view('clerk.index', compact('clerks'));
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
    public function update(Request $request, Clerkey $clerkey)
    {
        $request->validate([
            'clerk' => 'required'
        ]);
        // dd($clerkey);
        $clerkey->update([
            'clerk' => $request->clerk
        ]);
        return back();
    }
    public function destroy(Clerkey $clerkey) {
        $clerkey->delete();
        return back();
    }
}
