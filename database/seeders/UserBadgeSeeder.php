<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserBadge;

class UserBadgeSeeder extends Seeder
{
    public function run(): void
    {
        UserBadge::create([
            'id' => 1,
            'user_id' => 1,
            'badge_id' => 1,
            'earned_at' => now(),
        ]);

        UserBadge::create([
            'id' => 2,
            'user_id' => 1,
            'badge_id' => 2,
            'earned_at' => now(),
        ]);

        UserBadge::create([
            'id' => 3,
            'user_id' => 2,
            'badge_id' => 1,
            'earned_at' => now(),
        ]);
    }
}
