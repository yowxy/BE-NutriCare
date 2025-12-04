<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Badge::create([
            'id' => 1,
            'name' => 'Badge 1',
            'description' => 'Description 1',
            'icon' => 'icon-1',
        ]);
    }
}
