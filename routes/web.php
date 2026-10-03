<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlantController;
use App\Models\Plant;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/tips', function () {
    $thirstyCount = Plant::all()->filter->isThirsty()->count();

    return view('tips', [
        'thirstyCount' => $thirstyCount,
    ]);
})->name('tips');

Route::resource('plants', PlantController::class)->only([
    'index',
    'create',
    'store',
    'show',
    'edit',
    'update',
    'destroy',
]);

Route::post('plants/{plant}/water', [PlantController::class, 'water'])->name('plants.water');
