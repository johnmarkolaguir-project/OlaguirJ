@php
    $editing = $plant->exists;
@endphp

<form method="POST" action="{{ $editing ? route('plants.update', $plant) : route('plants.store') }}" class="space-y-5">
    @csrf
    @if ($editing)
        @method('PATCH')
    @endif

    <div class="grid gap-5 sm:grid-cols-2">
        <label class="block">
            <span class="text-sm font-medium">Name</span>
            <input type="text" name="name" value="{{ old('name', $plant->name) }}"
                   class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none">
        </label>

        <label class="block">
            <span class="text-sm font-medium">Species</span>
            <input type="text" name="species" value="{{ old('species', $plant->species) }}" placeholder="Monstera deliciosa"
                   class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none">
        </label>

        <label class="block">
            <span class="text-sm font-medium">Room</span>
            <input type="text" name="room" value="{{ old('room', $plant->room) }}" placeholder="Living room"
                   class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none">
        </label>

        <label class="block">
            <span class="text-sm font-medium">Water every (days)</span>
            <input type="number" name="water_every_days" min="1" max="90" value="{{ old('water_every_days', $plant->water_every_days) }}"
                   class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none">
        </label>

        <label class="block">
            <span class="text-sm font-medium">Last watered</span>
            <input type="date" name="last_watered_at" value="{{ old('last_watered_at', $plant->last_watered_at?->format('Y-m-d')) }}"
                   class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none">
        </label>
    </div>

    <label class="block">
        <span class="text-sm font-medium">Notes</span>
        <textarea name="notes" rows="3"
                  class="mt-1 w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:border-emerald-500 focus:outline-none">{{ old('notes', $plant->notes) }}</textarea>
    </label>

    <div class="flex items-center gap-3">
        <button type="submit" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
            {{ $submitLabel }}
        </button>

        <a href="{{ route('plants.index') }}" class="text-sm text-stone-500 hover:underline">Cancel</a>
    </div>
</form>