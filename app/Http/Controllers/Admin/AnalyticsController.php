<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneratedImage;
use App\Models\PhotoSession;
use App\Models\Theme;

class AnalyticsController extends Controller
{
    public function __invoke()
    {
        $totalGeneratedImages = GeneratedImage::count();
        $totalSessions = PhotoSession::count();
        $failedGenerations = GeneratedImage::where('status', 'failed')->count();

        $popularThemes = Theme::withCount('generatedImages')
            ->having('generated_images_count', '>', 0)
            ->orderByDesc('generated_images_count')
            ->take(5)
            ->get();

        $averageRating = GeneratedImage::whereNotNull('rating')->avg('rating');
        $ratedCount = GeneratedImage::whereNotNull('rating')->count();

        $feedback = GeneratedImage::whereNotNull('feedback_comment')
            ->with(['theme', 'event'])
            ->latest()
            ->take(10)
            ->get();

        $successRate = $totalGeneratedImages > 0
            ? round((($totalGeneratedImages - $failedGenerations) / $totalGeneratedImages) * 100, 1)
            : null;

        return view('admin.analytics.index', compact(
            'totalGeneratedImages',
            'totalSessions',
            'failedGenerations',
            'popularThemes',
            'averageRating',
            'ratedCount',
            'feedback',
            'successRate',
        ));
    }
}
