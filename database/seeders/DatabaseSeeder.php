<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\GeneratedImage;
use App\Models\PhotoSession;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => Hash::make('password')],
        );

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'role' => 'admin', 'password' => Hash::make('password')],
        );

        if (Event::count() === 0) {
            Event::factory()->count(6)->create(['user_id' => $user->id]);
        }

        if (Theme::count() === 0) {
            Theme::factory()->count(8)->create();
        }

        if (PhotoSession::count() === 0) {
            $events = Event::all();
            $themes = Theme::all();

            PhotoSession::factory()
                ->count(40)
                ->create(['event_id' => fn () => $events->random()->id])
                ->each(function (PhotoSession $session) use ($themes) {
                    GeneratedImage::factory()
                        ->count(random_int(1, 3))
                        ->create([
                            'photo_session_id' => $session->id,
                            'event_id' => $session->event_id,
                            'theme_id' => fn () => $themes->random()->id,
                        ]);
                });
        }
    }
}
