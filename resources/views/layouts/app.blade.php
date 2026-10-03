<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Leaf Log')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-100 text-stone-800 antialiased">
    <header class="border-b border-stone-200 bg-white">
        <div class="mx-auto flex max-w-4xl flex-wrap items-center justify-between gap-4 px-6 py-4">
            <a href="{{ route('dashboard') }}" class="text-xl font-semibold tracking-tight text-emerald-700">
                Leaf Log
            </a>

            <nav class="flex items-center gap-1 text-sm">
                @php
                    $links = [
                        ['Dashboard', route('dashboard'), 'dashboard'],
                        ['All plants', route('plants.index'), 'plants.index'],
                        ['Tips', route('tips'), 'tips'],
                    ];
                @endphp

                @foreach ($links as [$label, $url, $routeName])
                    <a href="{{ $url }}"
                       class="rounded-full px-3 py-1.5 font-medium transition {{ request()->routeIs($routeName) ? 'bg-emerald-100 text-emerald-800' : 'text-stone-600 hover:bg-stone-100' }}">
                        {{ $label }}
                    </a>
                @endforeach

                <a href="{{ route('plants.create') }}"
                   class="ml-2 rounded-full bg-emerald-600 px-3 py-1.5 font-medium text-white hover:bg-emerald-700">
                    + Add plant
                </a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-4xl px-6 py-10">
        @include('partials.flash')

        @yield('content')
    </main>

    <footer class="mx-auto max-w-4xl px-6 pb-10 text-sm text-stone-400">
        Built with GC KA SOHO and a lot of love for leaves.
    </footer>
</body>
</html>