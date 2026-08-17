<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::withCount('generatedImages')->latest()->paginate(12);

        return view('admin.themes.index', compact('themes'));
    }

    public function create()
    {
        return view('admin.themes.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateTheme($request);

        $data['slug'] = $this->uniqueSlug($data['name']);
        $data['is_enabled'] = $request->boolean('is_enabled');

        Theme::create($data);

        return redirect()->route('admin.themes.index')->with('status', 'Theme created.');
    }

    public function edit(Theme $theme)
    {
        return view('admin.themes.edit', compact('theme'));
    }

    public function update(Request $request, Theme $theme)
    {
        $data = $this->validateTheme($request, $theme->id);

        if ($data['name'] !== $theme->name) {
            $data['slug'] = $this->uniqueSlug($data['name'], $theme->id);
        }

        $data['is_enabled'] = $request->boolean('is_enabled');

        $theme->update($data);

        return redirect()->route('admin.themes.index')->with('status', 'Theme updated.');
    }

    public function destroy(Theme $theme)
    {
        $theme->delete();

        return redirect()->route('admin.themes.index')->with('status', 'Theme deleted.');
    }

    public function toggle(Theme $theme)
    {
        $theme->update(['is_enabled' => ! $theme->is_enabled]);

        return back()->with('status', $theme->is_enabled ? 'Theme enabled.' : 'Theme disabled.');
    }

    private function validateTheme(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'prompt' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'string', 'max:2048'],
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;

        while (Theme::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
