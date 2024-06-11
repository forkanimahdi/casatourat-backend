<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Visitor;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){
        $comments =Comment::all();
        $commentCount =Comment::count();
        $visitorCount = Visitor::count();

        $femaleCount = Visitor::where('gender', 'female')->count();
        $maleCount = Visitor::where('gender', 'male')->count();
        $childCount = Visitor::where('gender', 'child')->count();
        return view ('dashboard' , compact('comments','visitorCount','femaleCount', 'maleCount', 'childCount','commentCount'));
    }
}
