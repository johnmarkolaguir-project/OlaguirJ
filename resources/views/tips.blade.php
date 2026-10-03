@extends('layouts.app')

@section('title', 'Plant tips · Leaf Log')

@section('content')
    <h1 class="text-3xl font-semibold tracking-tight">Plant tips</h1>
    <p class="mt-2 text-stone-500">Small habits that keep leaves happy.</p>

    @php
        $tips = [
            ['Check the soil, not the calendar', 'If the top two centimetres are dry, it is time. Otherwise wait.'],
            ['Water slowly and deeply', 'Pour until it drains, then empty the saucer. Small sips only wet the roots.'],
            ['Rotate weekly', 'Turn your pot a quarter turn so every side gets some light.'],
            ['Dust is a sunscreen', 'Wipe broad leaves with a damp cloth so they can absorb more light.'],
            ['Repot when crowded', 'Roots circling the bottom mean it is time for a slightly bigger pot.'],
        ];
    @endphp

    <div class="mt-8 grid gap-4 sm:grid-cols-2">
        @foreach ($tips as $index => [$title, $body])
            <div class="rounded-xl border border-stone-200 bg-white p-5">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-sm font-semibold text-emerald-700">
                    {{ $index + 1 }}
                </span>
                <h2 class="mt-3 font-semibold">{{ $title }}</h2>
                <p class="mt-1 text-sm text-stone-600">{{ $body }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-10 rounded-xl bg-emerald-600 p-8 text-center text-white">
        @if ($thirstyCount > 0)
            <p class="text-lg font-semibold">You have {{ Str::plural('plant', $thirstyCount) }} waiting for water.</p>
        @else
            <p class="text-lg font-semibold">Everything is watered. Nice work.</p>
        @endif

        <a href="{{ route('plants.index') }}" class="mt-4 inline-block rounded-full bg-white px-4 py-2 text-sm font-medium text-emerald-700">
            Check my plants
        </a>
    </div>
@endsection