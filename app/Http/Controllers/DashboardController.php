<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $plants = Plant::orderBy('name')->get();
        $thirsty = $plants->filter(fn (Plant $plant): bool => $plant->isThirsty())->values();

        return view('dashboard', [
            'totalPlants' => $plants->count(),
            'thirstyCount' => $thirsty->count(),
            'thirstyPlants' => $thirsty->take(5),
            'wateredToday' => $plants->filter(fn (Plant $plant): bool => $plant->last_watered_at?->isToday() ?? false)->count(),
            'roomCounts' => $plants->countBy('room')->sortKeys(),
        ]);
    }
}
