<x-admin-layout title="{{ $event->name }}" subtitle="Event details">

    <x-slot:actions>
        <a href="{{ route('admin.events.edit', $event) }}"
           class="inline-flex items-center gap-2 rounded-xl border border-white/10 px-4 py-2.5 text-sm font-medium text-gray-300 transition hover:bg-white/5 hover:text-white">
            Edit
        </a>
        <a href="{{ route('admin.events.index') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-gray-950 transition hover:bg-gray-100">
            ← All Events
        </a>
    </x-slot:actions>

    <div class="grid gap-5 lg:grid-cols-3">
        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-7 lg:col-span-2">
            <div class="flex items-start justify-between">
                <div>
                    <span @class([
                        'rounded-full border px-3 py-1 text-[10px] font-semibold uppercase tracking-wider',
                        'border-emerald-400/30 bg-emerald-400/10 text-emerald-300' => $event->status === 'active',
                        'border-amber-400/30 bg-amber-400/10 text-amber-300' => $event->status === 'draft',
                        'border-white/10 bg-white/5 text-gray-400' => ! in_array($event->status, ['active', 'draft']),
                    ])>
                        {{ $event->status }}
                    </span>
                    <h2 class="mt-4 text-2xl font-bold">{{ $event->name }}</h2>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap gap-x-6 gap-y-2 text-sm text-gray-400">
                <span class="flex items-center gap-1.5"><span class="text-violet-400">◷</span> {{ $event->start_date->format('M j, Y · g:ia') }}</span>
                @if ($event->location)
                    <span class="flex items-center gap-1.5"><span class="text-cyan-400">◎</span> {{ $event->location }}</span>
                @endif
            </div>

            @if ($event->description)
                <p class="mt-5 leading-7 text-gray-400">{{ $event->description }}</p>
            @endif
        </div>

        <div class="space-y-5">
            <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 text-center">
                <p class="text-3xl font-bold">{{ $event->photoSessions->count() }}</p>
                <p class="mt-1 text-sm text-gray-500">Photo Sessions</p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6 text-center">
                <p class="text-3xl font-bold">{{ $event->generatedImages->count() }}</p>
                <p class="mt-1 text-sm text-gray-500">Generated Images</p>
            </div>
        </div>
    </div>

    <div class="mt-6 rounded-3xl border border-white/10 bg-white/[0.03] p-7">
        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-violet-400">Recent Generations</p>

        @if ($event->generatedImages->isEmpty())
            <p class="mt-5 text-sm text-gray-500">No images generated for this event yet.</p>
        @else
            <div class="mt-5 divide-y divide-white/5">
                @foreach ($event->generatedImages->take(10) as $image)
                    <div class="flex items-center justify-between py-3 text-sm">
                        <span>{{ $image->theme?->name ?? 'Unknown theme' }}</span>
                        <span @class([
                            'rounded-full border px-3 py-1 text-[10px] font-semibold uppercase tracking-wider',
                            'border-emerald-400/30 bg-emerald-400/10 text-emerald-300' => $image->status === 'completed',
                            'border-red-400/30 bg-red-400/10 text-red-300' => $image->status === 'failed',
                            'border-amber-400/30 bg-amber-400/10 text-amber-300' => $image->status === 'pending',
                        ])>
                            {{ $image->status }}
                        </span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</x-admin-layout>
