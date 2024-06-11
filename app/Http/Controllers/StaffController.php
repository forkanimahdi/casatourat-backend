<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    //
    public function index()
    {
        $staffs = Visitor::where('role','admin')->get();
        foreach ($staffs as $staff) {
            $firstLetter_firstNames[$staff->id] = Str::charAt($staff->first_name, 0);
            $firstLetter_lastNames[$staff->id] = Str::charAt($staff->last_name, 0);
        }
        // $first_fn = Str::charAt($,0)
        return view('staff.staff', compact('staffs', 'firstLetter_firstNames', 'firstLetter_lastNames'));
    }
}
