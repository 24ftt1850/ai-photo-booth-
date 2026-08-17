<x-admin-layout title="Analytics" subtitle="How guests are using the photo booth">

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-violet-400">Generated Images</p>
            <p class="mt-4 text-3xl font-bold">{{ number_format($totalGeneratedImages) }}</p>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-400">Sessions</p>
            <p class="mt-4 text-3xl font-bold">{{ number_format($totalSessions) }}</p>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-red-400">Failed Generations</p>
            <p class="mt-4 text-3xl font-bold">{{ number_format($failedGenerations) }}</p>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-emerald-400">Success Rate</p>
            <p class="mt-4 text-3xl font-bold">{{ $successRate !== null ? $successRate.'%' : '—' }}</p>
        </div>
    </div>

    <div class="mt-6 grid gap-5 lg:grid-cols-2">

        <!-- =========================
             POPULAR THEMES
        ========================== -->
        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-7">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-violet-400">Most Popular Themes</p>

            @if ($popularThemes->isEmpty())
                <p class="mt-5 text-sm text-gray-500">No generations recorded yet.</p>
            @else
                @php $max = $popularThemes->max('generated_images_count') ?: 1; @endphp
                <div class="mt-6 space-y-4">
                    @foreach ($popularThemes as $theme)
                        <div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-medium">{{ $theme->name }}</span>
                                <span class="text-gray-500">{{ $theme->generated_images_count }}</span>
                            </div>
                            <div class="mt-2 h-2 overflow-hidden rounded-full bg-white/5">
                                <div class="h-full rounded-full bg-gradient-to-r from-violet-500 to-cyan-400"
                                     style="width: {{ $theme->generated_images_count / $max * 100 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- =========================
             FEEDBACK
        ========================== -->
        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-7">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-400">User Feedback</p>
                @if ($averageRating)
                    <span class="text-sm font-semibold text-amber-300">★ {{ number_format($averageRating, 1) }} <span class="font-normal text-gray-500">({{ $ratedCount }})</span></span>
                @endif
            </div>

            @if ($feedback->isEmpty())
                <p class="mt-5 text-sm text-gray-500">No feedback comments yet.</p>
            @else
                <div class="mt-5 space-y-4">
                    @foreach ($feedback as $image)
                        <div class="rounded-2xl border border-white/5 bg-white/[0.02] p-4">
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $image->theme?->name ?? 'Unknown theme' }} · {{ $image->event?->name }}</span>
                                @if ($image->rating)
                                    <span class="text-amber-300">{{ str_repeat('★', $image->rating).str_repeat('☆', 5 - $image->rating) }}</span>
                                @endif
                            </div>
                            <p class="mt-2 text-sm text-gray-300">{{ $image->feedback_comment }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</x-admin-layout>
