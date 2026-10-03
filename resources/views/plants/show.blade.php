@extends('layouts.app')

@section('title', "{$plant->name} · Leaf Log")

@section('content')
    <a href="{{ route('plants.index') }}" class="text-sm text-stone-500 hover:underline">&larr; All plants</a>

    <div class="mt-4 flex flex-wrap items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl font-semibold tracking-tight">{{ $plant->name }}</h1>
            <p class="mt-1 text-stone-500">{{ $plant->species }}</p>
            <span class="mt-3 inline-block rounded-full px-2.5 py-1 text-xs font-medium {{ $plant->statusColor() }}">
                {{ $plant->status() }}
            </span>
        </div>

        <div class="flex items-center gap-2">
            <form method="POST" action="{{ route('plants.water', $plant) }}">
                @csrf
                <button type="submit" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                    Water now
                </button>
            </form>

            <a href="{{ route('plants.edit', $plant) }}"
               class="rounded-lg border border-stone-300 px-4 py-2 text-sm font-medium hover:bg-stone-100">
                Edit
            </a>

            <form method="POST" action="{{ route('plants.destroy', $plant) }}"
                  onsubmit="return confirm('Remove this plant?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-lg border border-rose-200 px-4 py-2 text-sm font-medium text-rose-700 hover:bg-rose-50">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="mt-8 grid gap-4 sm:grid-cols-3">
        <div class="rounded-xl border border-stone-200 bg-white p-5">
            <p class="text-sm text-stone-500">Room</p>
            <p class="mt-1 font-medium">{{ $plant->room }}</p>
        </div>
        <div class="rounded-xl border border-stone-200 bg-white p-5">
            <p class="text-sm text-stone-500">Watering interval</p>
            <p class="mt-1 font-medium">Every {{ $plant->water_every_days }} days</p>
        </div>
        <div class="rounded-xl border border-stone-200 bg-white p-5">
            <p class="text-sm text-stone-500">Last watered</p>
            <p class="mt-1 font-medium">
                @if ($plant->last_watered_at)
                    {{ $plant->last_watered_at->format('M j, Y') }}
                    <span class="text-stone-400">({{ $plant->daysSinceWatering() }} days ago)</span>
                @else
                    Never
                @endif
            </p>
        </div>
    </div>

    <div class="mt-6 rounded-xl border border-stone-200 bg-white p-6">
        <h2 class="text-lg font-semibold">Notes</h2>
        @if ($plant->notes)
            <p class="mt-2 text-stone-600">{{ $plant->notes }}</p>
        @else
            <p class="mt-2 text-stone-400">No notes yet.</p>
        @endif
    </div>
@endsection