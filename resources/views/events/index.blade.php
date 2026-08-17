<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RupaVue - Events</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#080A10] text-white">

    <!-- =========================
         NAVIGATION
    ========================== -->
    <nav class="border-b border-white/10 bg-[#080A10]/95">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">

            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-cyan-400 text-lg font-bold shadow-lg shadow-violet-500/20">
                    ✦
                </div>
                <div>
                    <h1 class="text-lg font-bold tracking-tight">RupaVue</h1>
                    <p class="text-[10px] uppercase tracking-[0.25em] text-gray-500">AI Photo Booth</p>
                </div>
            </a>

            <div class="hidden items-center gap-8 md:flex">
                <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-500 transition hover:text-white">
                    Studio
                </a>
                <a href="{{ route('events.index') }}" class="text-sm font-medium text-white">
                    Events
                </a>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden text-right sm:block">
                    <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">Creator</p>
                </div>

                <div class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 text-sm font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Logout" class="rounded-lg p-2 text-gray-500 transition hover:bg-white/10 hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </nav>

    <!-- =========================
         HEADER
    ========================== -->
    <main class="relative overflow-hidden">
        <div class="pointer-events-none absolute -left-40 top-0 h-96 w-96 rounded-full bg-violet-600/20 blur-[120px]"></div>
        <div class="pointer-events-none absolute -right-40 top-20 h-96 w-96 rounded-full bg-cyan-500/10 blur-[120px]"></div>

        <div class="relative mx-auto max-w-7xl px-6 py-16 md:py-20">

            <div class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
                <div>
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-px w-10 bg-violet-500"></span>
                        <span class="text-xs font-semibold uppercase tracking-[0.3em] text-violet-400">
                            Step 1
                        </span>
                    </div>

                    <h2 class="text-4xl font-bold tracking-tight md:text-5xl">
                        Choose an event
                    </h2>

                    <p class="mt-4 max-w-xl leading-7 text-gray-400">
                        Pick the event you're creating portraits for. Each event
                        keeps its own scenes, captures and gallery.
                    </p>
                </div>

                <span class="whitespace-nowrap rounded-full border border-white/10 px-4 py-2 text-xs text-gray-500">
                    {{ $events->count() }} {{ Str::plural('event', $events->count()) }}
                </span>
            </div>

            <!-- =========================
                 EVENT GRID
            ========================== -->
            @if ($events->isEmpty())
                <div class="mt-12 flex min-h-[280px] items-center justify-center rounded-3xl border border-dashed border-white/10 bg-white/[0.02]">
                    <div class="text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-white/10 bg-white/[0.03] text-2xl text-gray-500">
                            ✦
                        </div>
                        <h3 class="mt-5 font-semibold">No events yet</h3>
                        <p class="mt-2 text-sm text-gray-600">
                            Active events will appear here once they're created.
                        </p>
                        <a href="{{ url('/dashboard') }}"
                           class="mt-6 inline-flex rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-medium transition hover:bg-white/10">
                            ← Back to Studio
                        </a>
                    </div>
                </div>
            @else
                <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($events as $event)
                        <div class="group relative flex flex-col overflow-hidden rounded-3xl border border-white/10 bg-white/[0.03] transition hover:-translate-y-1 hover:border-violet-500/30">

                            <div class="relative flex h-40 items-center justify-center overflow-hidden bg-gradient-to-br from-[#171322] via-[#10131E] to-[#0D1A21]">
                                <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full border border-violet-400/10"></div>
                                <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_30%,rgba(139,92,246,0.16),transparent_40%)]"></div>

                                @if ($event->cover_image)
                                    <img src="{{ $event->cover_image }}" alt="{{ $event->name }}" class="relative h-full w-full object-cover">
                                @else
                                    <span class="relative flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-br from-violet-500/20 to-cyan-400/20 text-3xl">
                                        ✦
                                    </span>
                                @endif

                                <span @class([
                                    'absolute right-4 top-4 rounded-full border px-3 py-1 text-[10px] font-semibold uppercase tracking-wider',
                                    'border-emerald-400/30 bg-emerald-400/10 text-emerald-300' => $event->status === 'active',
                                    'border-amber-400/30 bg-amber-400/10 text-amber-300' => $event->status === 'draft',
                                    'border-white/10 bg-white/5 text-gray-400' => ! in_array($event->status, ['active', 'draft']),
                                ])>
                                    {{ $event->status }}
                                </span>
                            </div>

                            <div class="flex flex-1 flex-col p-6">
                                <h3 class="text-lg font-bold leading-snug">
                                    {{ $event->name }}
                                </h3>

                                <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500">
                                    <span class="flex items-center gap-1.5">
                                        <span class="text-violet-400">◷</span>
                                        {{ $event->start_date->format('M j, Y · g:ia') }}
                                    </span>

                                    @if ($event->location)
                                        <span class="flex items-center gap-1.5">
                                            <span class="text-cyan-400">◎</span>
                                            {{ $event->location }}
                                        </span>
                                    @endif
                                </div>

                                @if ($event->description)
                                    <p class="mt-4 line-clamp-2 text-sm leading-6 text-gray-500">
                                        {{ $event->description }}
                                    </p>
                                @endif

                                <div class="mt-6 flex items-center gap-2 text-sm font-medium text-white/90">
                                    <span>Open Photo Booth</span>
                                    <span class="transition-transform group-hover:translate-x-1">→</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </main>

    <!-- =========================
         FOOTER
    ========================== -->
    <footer class="border-t border-white/10 bg-[#080A10]">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-3 px-6 py-8 text-sm text-gray-600 md:flex-row">
            <p>© {{ date('Y') }} AI Studio</p>
            <p>AI-powered event photography</p>
        </div>
    </footer>

</body>

</html>
