<x-admin-layout title="Dashboard" subtitle="Overview of your photo booth platform">

    <!-- =========================
         STAT CARDS
    ========================== -->
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-5">
        @foreach ([
            ['label' => 'Total Users', 'value' => $stats['total_users'], 'icon' => '◍', 'accent' => 'violet'],
            ['label' => 'Total Sessions', 'value' => $stats['total_sessions'], 'icon' => '◷', 'accent' => 'cyan'],
            ['label' => 'Generated Images', 'value' => $stats['total_generated_images'], 'icon' => '✦', 'accent' => 'violet'],
            ['label' => 'Total Themes', 'value' => $stats['total_themes'], 'icon' => '◆', 'accent' => 'cyan'],
            ['label' => 'Total Events', 'value' => $stats['total_events'], 'icon' => '◎', 'accent' => 'violet'],
        ] as $card)
            <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6">
                <div @class([
                    'flex h-10 w-10 items-center justify-center rounded-xl text-lg',
                    'bg-violet-500/10 text-violet-300' => $card['accent'] === 'violet',
                    'bg-cyan-400/10 text-cyan-300' => $card['accent'] === 'cyan',
                ])>
                    {{ $card['icon'] }}
                </div>
                <p class="mt-5 text-3xl font-bold tracking-tight">{{ number_format($card['value']) }}</p>
                <p class="mt-1 text-sm text-gray-500">{{ $card['label'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-5 lg:grid-cols-3">

        <!-- =========================
             MOST POPULAR THEME
        ========================== -->
        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-7">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-violet-400">Most Popular</p>

            @if ($mostPopularTheme && $mostPopularTheme->generated_images_count > 0)
                <h3 class="mt-4 text-2xl font-bold">{{ $mostPopularTheme->name }}</h3>
                <p class="mt-2 text-sm text-gray-500">
                    Used in {{ number_format($mostPopularTheme->generated_images_count) }}
                    {{ Str::plural('generation', $mostPopularTheme->generated_images_count) }}
                </p>
                <span @class([
                    'mt-4 inline-flex rounded-full border px-3 py-1 text-[10px] font-semibold uppercase tracking-wider',
                    'border-emerald-400/30 bg-emerald-400/10 text-emerald-300' => $mostPopularTheme->is_enabled,
                    'border-white/10 bg-white/5 text-gray-400' => ! $mostPopularTheme->is_enabled,
                ])>
                    {{ $mostPopularTheme->is_enabled ? 'Enabled' : 'Disabled' }}
                </span>
            @else
                <p class="mt-4 text-sm text-gray-500">No generations recorded yet.</p>
            @endif
        </div>

        <!-- =========================
             AI GENERATION STATS
        ========================== -->
        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-7 lg:col-span-2">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-400">AI Generation Stats</p>

            @php
                $total = array_sum($generationStats) ?: 1;
            @endphp

            <div class="mt-5 flex h-3 overflow-hidden rounded-full bg-white/5">
                <div class="bg-emerald-400" style="width: {{ $generationStats['completed'] / $total * 100 }}%"></div>
                <div class="bg-red-400" style="width: {{ $generationStats['failed'] / $total * 100 }}%"></div>
                <div class="bg-amber-400" style="width: {{ $generationStats['pending'] / $total * 100 }}%"></div>
            </div>

            <div class="mt-6 grid grid-cols-3 gap-4 text-center">
                <div>
                    <p class="text-2xl font-bold text-emerald-300">{{ number_format($generationStats['completed']) }}</p>
                    <p class="mt-1 text-xs text-gray-500">Completed</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-red-300">{{ number_format($generationStats['failed']) }}</p>
                    <p class="mt-1 text-xs text-gray-500">Failed</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-amber-300">{{ number_format($generationStats['pending']) }}</p>
                    <p class="mt-1 text-xs text-gray-500">Pending</p>
                </div>
            </div>
        </div>
    </div>

    <!-- =========================
         RECENT EVENTS
    ========================== -->
    <div class="mt-6 rounded-3xl border border-white/10 bg-white/[0.03] p-7">
        <div class="flex items-center justify-between">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-violet-400">Recent Events</p>
            <a href="{{ route('admin.events.index') }}" class="text-sm font-medium text-gray-400 transition hover:text-white">
                View all →
            </a>
        </div>

        @if ($recentEvents->isEmpty())
            <p class="mt-5 text-sm text-gray-500">No events created yet.</p>
        @else
            <div class="mt-5 divide-y divide-white/5">
                @foreach ($recentEvents as $event)
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="text-sm font-medium">{{ $event->name }}</p>
                            <p class="text-xs text-gray-500">{{ $event->start_date->format('M j, Y') }}</p>
                        </div>
                        <span @class([
                            'rounded-full border px-3 py-1 text-[10px] font-semibold uppercase tracking-wider',
                            'border-emerald-400/30 bg-emerald-400/10 text-emerald-300' => $event->status === 'active',
                            'border-amber-400/30 bg-amber-400/10 text-amber-300' => $event->status === 'draft',
                            'border-white/10 bg-white/5 text-gray-400' => ! in_array($event->status, ['active', 'draft']),
                        ])>
                            {{ $event->status }}
                        </span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</x-admin-layout>
