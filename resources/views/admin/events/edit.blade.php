<x-admin-layout title="Edit Event" :subtitle="$event->name">

    <form method="POST" action="{{ route('admin.events.update', $event) }}" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-7 space-y-6">
            <x-form.input name="name" label="Event name" required :value="$event->name" />

            <x-form.textarea name="description" label="Description" :value="$event->description" />

            <div class="grid gap-6 sm:grid-cols-2">
                <x-form.input name="location" label="Location" :value="$event->location" />
                <x-form.input name="cover_image" label="Cover image URL" :value="$event->cover_image" />
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <x-form.input name="start_date" label="Start date" type="datetime-local" required :value="$event->start_date->format('Y-m-d\TH:i')" />
                <x-form.input name="end_date" label="End date" type="datetime-local" :value="$event->end_date?->format('Y-m-d\TH:i')" />
            </div>

            <x-form.select
                name="status"
                label="Status"
                required
                :value="$event->status"
                :options="['active' => 'Active', 'draft' => 'Draft', 'completed' => 'Completed', 'archived' => 'Archived']"
            />
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-gray-950 transition hover:bg-gray-100">
                Save Changes
            </button>
            <a href="{{ route('admin.events.index') }}" class="rounded-xl border border-white/10 px-5 py-2.5 text-sm font-medium text-gray-400 transition hover:bg-white/5 hover:text-white">
                Cancel
            </a>
        </div>
    </form>

</x-admin-layout>
