<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models as models;


class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $guided = models\GuidedVisit::all();
        $pending = models\GuidedVisit::where('pending', true)->get();
        return view('layouts.app', compact('guided', 'pending'));
    }
}
