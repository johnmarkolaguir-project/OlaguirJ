@extends('layouts.app')

@section('title', 'All plants · Leaf Log')

@section('content')
    <h1 class="text-3xl font-semibold tracking-tight">All plants</h1>
    <p class="mt-2 text-stone-500">{{ $plants->count() }} {{ Str::plural('plant', $plants->count()) }} in your collection.</p>

    <form method="GET" action="{{ route('plants.index') }}" class="mt-6 flex flex-wrap gap-3">
        <input type="search"
               name="q"
               value="{{ $search }}"
               placeholder="Search name or species"
               class="w-full max-w-xs rounded-lg border border-stone-300 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none">

        <select name="room" class="rounded-lg border border-stone-300 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none">
            <option value="">All rooms</option>
            @foreach ($rooms as $room)
                <option value="{{ $room }}" @selected($selectedRoom === $room)>{{ $room }}</option>
            @endforeach
        </select>

        <button type="submit" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
            Filter
        </button>

        @if ($search !== '' || $selectedRoom !== '')
            <a href="{{ route('plants.index') }}" class="self-center text-sm text-stone-500 hover:underline">Clear</a>
        @endif
    </form>

    <div class="mt-6 space-y-3">
        @forelse ($plants as $plant)
            @include('partials.plant-row', ['plant' => $plant])
        @empty
            <div class="rounded-xl border border-dashed border-stone-300 bg-white p-8 text-center">
                <p class="text-lg font-medium">No plants found.</p>
                <p class="mt-1 text-stone-500">Try another search, or add a new plant.</p>
            </div>
        @endforelse
    </div>
@endsection