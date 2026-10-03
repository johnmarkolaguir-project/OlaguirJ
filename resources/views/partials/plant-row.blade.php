<div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-stone-200 bg-white p-4">
    <div>
        <a href="{{ route('plants.show', $plant) }}" class="font-medium hover:text-emerald-700">{{ $plant->name }}</a>
        <p class="text-sm text-stone-500">{{ $plant->species }} · {{ $plant->room }}</p>
    </div>

    <div class="flex items-center gap-3">
        <span class="rounded-full px-2.5 py-1 text-xs font-medium {{ $plant->statusColor() }}">
            {{ $plant->status() }}
        </span>

        <form method="POST" action="{{ route('plants.water', $plant) }}">
            @csrf
            <button type="submit"
                    class="rounded-full bg-stone-900 px-3 py-1.5 text-xs font-medium text-white hover:bg-stone-700">
                Water now
            </button>
        </form>
    </div>
</div>