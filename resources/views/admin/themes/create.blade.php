<x-admin-layout title="Add Theme" subtitle="Define a new AI scene guests can transform into">

    <form method="POST" action="{{ route('admin.themes.store') }}" class="max-w-2xl space-y-6">
        @csrf

        <div class="rounded-3xl border border-white/10 bg-white/[0.03] p-7 space-y-6">
            <x-form.input name="name" label="Theme name" required placeholder="e.g. Cyberpunk City" />

            <x-form.textarea name="description" label="Description" placeholder="Short description shown to guests" />

            <x-form.textarea name="prompt" label="AI prompt" rows="3" placeholder="Prompt used to guide the AI generation" />

            <x-form.input name="thumbnail" label="Thumbnail URL" placeholder="https://..." />

            <label class="flex items-center gap-3 text-sm text-gray-300">
                <input type="checkbox" name="is_enabled" value="1" checked
                       class="h-4 w-4 rounded border-white/20 bg-white/5 text-violet-500 focus:ring-violet-500">
                Enabled — visible to guests immediately
            </label>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-gray-950 transition hover:bg-gray-100">
                Create Theme
            </button>
            <a href="{{ route('admin.themes.index') }}" class="rounded-xl border border-white/10 px-5 py-2.5 text-sm font-medium text-gray-400 transition hover:bg-white/5 hover:text-white">
                Cancel
            </a>
        </div>
    </form>

</x-admin-layout>
