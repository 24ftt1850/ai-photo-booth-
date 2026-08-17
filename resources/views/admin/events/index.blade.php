<x-admin-layout title="Events" subtitle="Manage the events guests can create portraits for">

    <x-slot:actions>
        <a href="{{ route('admin.events.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-gray-950 transition hover:bg-gray-100">
            + Add Event
        </a>
    </x-slot:actions>

    <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/[0.03]">
        @if ($events->isEmpty())
            <div class="flex min-h-[220px] items-center justify-center p-10 text-center">
                <div>
                    <p class="font-semibold">No events yet</p>
                    <p class="mt-2 text-sm text-gray-500">Create your first event to get started.</p>
                </div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-white/10 text-xs uppercase tracking-wider text-gray-500">
                            <th class="px-6 py-4 font-medium">Event</th>
                            <th class="px-6 py-4 font-medium">Date</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium">Sessions</th>
                            <th class="px-6 py-4 font-medium">Images</th>
                            <th class="px-6 py-4 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach ($events as $event)
                            <tr class="transition hover:bg-white/[0.02]">
                                <td class="px-6 py-4">
                                    <p class="font-medium">{{ $event->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $event->location ?? '—' }}</p>
                                </td>
                                <td class="px-6 py-4 text-gray-400">{{ $event->start_date->format('M j, Y') }}</td>
                                <td class="px-6 py-4">
                                    <span @class([
                                        'rounded-full border px-3 py-1 text-[10px] font-semibold uppercase tracking-wider',
                                        'border-emerald-400/30 bg-emerald-400/10 text-emerald-300' => $event->status === 'active',
                                        'border-amber-400/30 bg-amber-400/10 text-amber-300' => $event->status === 'draft',
                                        'border-white/10 bg-white/5 text-gray-400' => ! in_array($event->status, ['active', 'draft']),
                                    ])>
                                        {{ $event->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-400">{{ $event->photo_sessions_count }}</td>
                                <td class="px-6 py-4 text-gray-400">{{ $event->generated_images_count }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-3 text-xs font-medium">
                                        <a href="{{ route('admin.events.show', $event) }}" class="text-gray-400 hover:text-white">View</a>
                                        <a href="{{ route('admin.events.edit', $event) }}" class="text-violet-400 hover:text-violet-300">Edit</a>
                                        <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Delete this event? This cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-white/10 px-6 py-4">
                <x-pagination :paginator="$events" />
            </div>
        @endif
    </div>

</x-admin-layout>
