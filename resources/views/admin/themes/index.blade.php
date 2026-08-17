<x-admin-layout title="Themes" subtitle="AI scenes guests can transform their portraits into">

    <x-slot:actions>
        <a href="{{ route('admin.themes.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-gray-950 transition hover:bg-gray-100">
            + Add Theme
        </a>
    </x-slot:actions>

    @if ($themes->isEmpty())
        <div class="flex min-h-[220px] items-center justify-center rounded-3xl border border-dashed border-white/10 bg-white/[0.02] p-10 text-center">
            <div>
                <p class="font-semibold">No themes yet</p>
                <p class="mt-2 text-sm text-gray-500">Add a theme so guests have a scene to choose from.</p>
            </div>
        </div>
    @else
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($themes as $theme)
                <div class="flex flex-col overflow-hidden rounded-3xl border border-white/10 bg-white/[0.03]">
                    <div class="relative flex h-32 items-center justify-center overflow-hidden bg-gradient-to-br from-[#171322] via-[#10131E] to-[#0D1A21]">
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_30%,rgba(139,92,246,0.16),transparent_40%)]"></div>
                        @if ($theme->thumbnail)
                            <img src="{{ $theme->thumbnail }}" alt="{{ $theme->name }}" class="relative h-full w-full object-cover">
                        @else
                            <span class="relative text-3xl">✦</span>
                        @endif

                        <span @class([
                            'absolute right-4 top-4 rounded-full border px-3 py-1 text-[10px] font-semibold uppercase tracking-wider',
                            'border-emerald-400/30 bg-emerald-400/10 text-emerald-300' => $theme->is_enabled,
                            'border-white/10 bg-white/5 text-gray-400' => ! $theme->is_enabled,
                        ])>
                            {{ $theme->is_enabled ? 'Enabled' : 'Disabled' }}
                        </span>
                    </div>

                    <div class="flex flex-1 flex-col p-6">
                        <h3 class="text-lg font-bold">{{ $theme->name }}</h3>
                        @if ($theme->description)
                            <p class="mt-2 line-clamp-2 text-sm leading-6 text-gray-500">{{ $theme->description }}</p>
                        @endif

                        <p class="mt-3 text-xs text-gray-600">{{ $theme->generated_images_count }} generations</p>

                        <div class="mt-5 flex items-center justify-between border-t border-white/5 pt-4 text-xs font-medium">
                            <form method="POST" action="{{ route('admin.themes.toggle', $theme) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-gray-400 hover:text-white">
                                    {{ $theme->is_enabled ? 'Disable' : 'Enable' }}
                                </button>
                            </form>

                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.themes.edit', $theme) }}" class="text-violet-400 hover:text-violet-300">Edit</a>
                                <form method="POST" action="{{ route('admin.themes.destroy', $theme) }}" onsubmit="return confirm('Delete this theme? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            <x-pagination :paginator="$themes" />
        </div>
    @endif

</x-admin-layout>
