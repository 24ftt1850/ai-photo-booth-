<x-admin-layout title="Edit Theme" :subtitle="$theme->name">

    <form method="POST" action="{{ route('admin.themes.update', $theme) }}" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-7 space-y-6">
            <x-form.input name="name" label="Theme name" required :value="$theme->name" />

            <x-form.textarea name="description" label="Description" :value="$theme->description" />

            <x-form.textarea name="prompt" label="AI prompt" rows="3" :value="$theme->prompt" />

            <x-form.input name="thumbnail" label="Thumbnail URL" :value="$theme->thumbnail" />

            <label class="flex items-center gap-3 text-sm text-gray-300">
                <input type="checkbox" name="is_enabled" value="1" @checked(old('is_enabled', $theme->is_enabled))
                       class="h-4 w-4 rounded border-white/20 bg-white/5 text-violet-500 focus:ring-violet-500">
                Enabled — visible to guests
            </label>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-gray-950 transition hover:bg-gray-100">
                Save Changes
            </button>
            <a href="{{ route('admin.themes.index') }}" class="rounded-xl border border-white/10 px-5 py-2.5 text-sm font-medium text-gray-400 transition hover:bg-white/5 hover:text-white">
                Cancel
            </a>
        </div>
    </form>

</x-admin-layout>
