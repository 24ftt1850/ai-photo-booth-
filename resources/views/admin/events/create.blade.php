<x-admin-layout title="Add Event" subtitle="Create a new event for guests to create portraits at">

    <form method="POST" action="{{ route('admin.events.store') }}" class="max-w-2xl space-y-6">
        @csrf

        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-7 space-y-6">
            <x-form.input name="name" label="Event name" required placeholder="e.g. Neon Nights Gala" />

            <x-form.textarea name="description" label="Description" placeholder="What's this event about?" />

            <div class="grid gap-6 sm:grid-cols-2">
                <x-form.input name="location" label="Location" placeholder="e.g. Kuala Lumpur" />
                <x-form.input name="cover_image" label="Cover image URL" placeholder="https://..." />
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <x-form.input name="start_date" label="Start date" type="datetime-local" required />
                <x-form.input name="end_date" label="End date" type="datetime-local" />
            </div>

            <x-form.select
                name="status"
                label="Status"
                required
                value="active"
                :options="['active' => 'Active', 'draft' => 'Draft', 'completed' => 'Completed', 'archived' => 'Archived']"
            />
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-gray-950 transition hover:bg-gray-100">
                Create Event
            </button>
            <a href="{{ route('admin.events.index') }}" class="rounded-xl border border-white/10 px-5 py-2.5 text-sm font-medium text-gray-400 transition hover:bg-white/5 hover:text-white">
                Cancel
            </a>
        </div>
    </form>

</x-admin-layout>
