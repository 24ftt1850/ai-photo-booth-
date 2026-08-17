@props(['paginator'])

@if ($paginator->hasPages())
    <div class="flex items-center justify-between text-sm">
        <p class="text-gray-500">
            Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
            <span class="text-gray-600">({{ $paginator->total() }} total)</span>
        </p>

        <div class="flex items-center gap-2">
            @if ($paginator->onFirstPage())
                <span class="rounded-lg border border-white/10 px-3 py-1.5 text-gray-600">← Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="rounded-lg border border-white/10 px-3 py-1.5 text-gray-300 transition hover:bg-white/5">
                    ← Previous
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="rounded-lg border border-white/10 px-3 py-1.5 text-gray-300 transition hover:bg-white/5">
                    Next →
                </a>
            @else
                <span class="rounded-lg border border-white/10 px-3 py-1.5 text-gray-600">Next →</span>
            @endif
        </div>
    </div>
@endif
