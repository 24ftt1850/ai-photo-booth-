<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\GeneratedImage;
use App\Models\PhotoSession;
use App\Models\Theme;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'total_users' => User::count(),
            'total_sessions' => PhotoSession::count(),
            'total_generated_images' => GeneratedImage::count(),
            'total_themes' => Theme::count(),
            'total_events' => Event::count(),
        ];

        $mostPopularTheme = Theme::withCount('generatedImages')
            ->orderByDesc('generated_images_count')
            ->first();

        $generationStats = [
            'completed' => GeneratedImage::where('status', 'completed')->count(),
            'failed' => GeneratedImage::where('status', 'failed')->count(),
            'pending' => GeneratedImage::where('status', 'pending')->count(),
        ];

        $recentEvents = Event::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'mostPopularTheme',
            'generationStats',
            'recentEvents',
        ));
    }
}
