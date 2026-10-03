@extends('layouts.app')

@section('title', 'Add plant · Leaf Log')

@section('content')
    <h1 class="text-3xl font-semibold tracking-tight">Add a plant</h1>
    <p class="mt-2 text-stone-500">Tell us about your new green friend.</p>

    <div class="mt-8 rounded-xl border border-stone-200 bg-white p-6">
        @include('plants.form', ['plant' => $plant, 'submitLabel' => $submitLabel])
    </div>
@endsection