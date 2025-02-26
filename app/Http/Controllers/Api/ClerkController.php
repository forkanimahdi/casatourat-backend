<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clerkey;
use Illuminate\Http\Request;

class ClerkController extends Controller
{
    public function index()
    {
        $key = Clerkey::latest()->first();
        return response()->json( ['keyClerk' => $key->clerk]);
    }
}
