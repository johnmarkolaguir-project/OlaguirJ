<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantRequest;
use App\Models\Plant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlantController extends Controller
{
    public function index(Request $request): View
    {
        $search = (string) $request->query('q', '');
        $room = (string) $request->query('room', '');

        $plants = Plant::query()
            ->when($search !== '', fn ($query) => $query->where(
                fn ($builder) => $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('species', 'like', "%{$search}%")
            ))
            ->when($room !== '', fn ($query) => $query->where('room', $room))
            ->orderBy('name')
            ->get();

        return view('plants.index', [
            'plants' => $plants,
            'search' => $search,
            'selectedRoom' => $room,
            'rooms' => Plant::query()->distinct()->orderBy('room')->pluck('room'),
        ]);
    }

    public function create(): View
    {
        return view('plants.create', [
            'plant' => new Plant(['water_every_days' => 7]),
            'submitLabel' => 'Add plant',
        ]);
    }

    public function store(PlantRequest $request): RedirectResponse
    {
        $plant = Plant::create($request->validated());

        return redirect()
            ->route('plants.show', $plant)
            ->with('success', "{$plant->name} joined the garden.");
    }

    public function show(Plant $plant): View
    {
        return view('plants.show', [
            'plant' => $plant,
        ]);
    }

    public function edit(Plant $plant): View
    {
        return view('plants.edit', [
            'plant' => $plant,
            'submitLabel' => 'Save changes',
        ]);
    }

    public function update(PlantRequest $request, Plant $plant): RedirectResponse
    {
        $plant->update($request->validated());

        return redirect()
            ->route('plants.show', $plant)
            ->with('success', "{$plant->name} was updated.");
    }

    public function destroy(Plant $plant): RedirectResponse
    {
        $name = $plant->name;
        $plant->delete();

        return redirect()
            ->route('plants.index')
            ->with('success', "{$name} was removed from the garden.");
    }

    public function water(Plant $plant): RedirectResponse
    {
        $plant->water();

        return redirect()
            ->route('plants.show', $plant)
            ->with('success', "{$plant->name} has been watered.");
    }
}
