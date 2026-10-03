@extends('layouts.app')

@section('title', "Edit {$plant->name} · Leaf Log")

@section('content')
    <h1 class="text-3xl font-semibold tracking-tight">Edit {{ $plant->name }}</h1>
    <p class="mt-2 text-stone-500">Keep the details up to date.</p>

    <div class="mt-8 rounded-xl border border-stone-200 bg-white p-6">
        @include('plants.form', ['plant' => $plant, 'submitLabel' => $submitLabel])
    </div>
@endsection