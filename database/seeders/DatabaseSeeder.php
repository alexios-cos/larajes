<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(10000)
            ->create()
            ->each(function ($user) {
                UserImage::factory()
                    ->count(rand(1, 15))
                    ->create(['user_id' => $user->id]);
            });
    }
}
