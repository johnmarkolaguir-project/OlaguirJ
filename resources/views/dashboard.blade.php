@extends('layouts.app')

@section('title', 'Dashboard · Leaf Log')

@section('content')
    <h1 class="text-3xl font-semibold tracking-tight">Dashboard</h1>
    <p class="mt-2 text-stone-500">A quick look at how your little jungle is doing today.</p>

    <div class="mt-8 grid gap-4 sm:grid-cols-3">
        <div class="rounded-xl border border-stone-200 bg-white p-5">
            <p class="text-sm text-stone-500">Plants</p>
            <p class="mt-1 text-3xl font-semibold">{{ $totalPlants }}</p>
        </div>
        <div class="rounded-xl border border-stone-200 bg-white p-5">
            <p class="text-sm text-stone-500">Thirsty</p>
            <p class="mt-1 text-3xl font-semibold text-amber-600">{{ $thirstyCount }}</p>
        </div>
        <div class="rounded-xl border border-stone-200 bg-white p-5">
            <p class="text-sm text-stone-500">Watered today</p>
            <p class="mt-1 text-3xl font-semibold text-emerald-600">{{ $wateredToday }}</p>
        </div>
    </div>

    <section class="mt-10">
        <div class="flex items-baseline justify-between">
            <h2 class="text-xl font-semibold">Needs water</h2>
            <a href="{{ route('plants.index') }}" class="text-sm font-medium text-emerald-700 hover:underline">See all plants</a>
        </div>

        @forelse ($thirstyPlants as $plant)
            @include('partials.plant-row', ['plant' => $plant])
        @empty
            <div class="mt-4 rounded-xl border border-dashed border-stone-300 bg-white p-8 text-center">
                <p class="text-lg font-medium">Nothing is thirsty right now.</p>
                <p class="mt-1 text-stone-500">Time to go outside instead.</p>
            </div>
        @endforelse
    </section>

    @if ($roomCounts->isNotEmpty())
        <section class="mt-10">
            <h2 class="text-xl font-semibold">Rooms</h2>
            <div class="mt-3 flex flex-wrap gap-2">
                @foreach ($roomCounts as $room => $count)
                    <a href="{{ route('plants.index', ['room' => $room]) }}"
                       class="rounded-full border border-stone-200 bg-white px-3 py-1.5 text-sm hover:border-emerald-300">
                        {{ $room }} <span class="text-stone-400">({{ $count }})</span>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
@endsection