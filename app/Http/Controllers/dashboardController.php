<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Comment;
use App\Models\Visitor;

class dashboardController extends Controller
{
    public function index()
    {
        $comments = Comment::all();

        $visitorsCount = Visitor::where('role', 'user')->count();
        $adminsCount = Visitor::where('role', 'admin')->count();

        $buildings = Building::all();
        $destinationLabeles = $buildings->map(fn($building) => $building->name->en);
        $destinationDataSet = $buildings->map(fn($building) => $building->visitors->count());

        $femaleCount = Visitor::where('gender', 'female')->count();

        $femaleCount = Visitor::where('gender', 'female')->count();
        $maleCount = Visitor::where('gender', 'male')->count();

        $states = [
            [
                'name' => 'total visitors',
                'stats' => $visitorsCount,
                'amount' => '17.2',
                'op' => '+',
                'bgColor' => 'bg-blue-400',
                'svgPath' => 'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z',
            ],
            [
                'name' => 'total visites',
                'stats' => $adminsCount,
                'amount' => '5',
                'op' => '-',
                'bgColor' => 'bg-cyan-400',
                'svgPath' => 'M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z',
            ],
            [
                'name' => 'reviews',
                'stats' => '128',
                'amount' => '18',
                'op' => '+',
                'bgColor' => 'bg-green-400',
                'svgPath' => 'M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155',
            ],
            [
                'name' => 'liked destinations',
                'stats' => '10.2k',
                'amount' => '3',
                'op' => '+',
                'bgColor' => 'bg-amber-400',
                'svgPath' => 'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z',
            ],
        ];

        return view('dashboard', compact('states', 'comments', 'femaleCount', 'maleCount', 'destinationLabeles', 'destinationDataSet'));
    }
}
