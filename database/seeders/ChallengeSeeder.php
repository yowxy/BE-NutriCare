<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Challenge::create([
            'id' => 1,
            'title' => 'masak nasi',
            'description' => 'aku suka masak nasi',
            'duration_days' => 7,
            'criteria'  => [
                'min_protein_daily' => 50,
                'min_days_completed' => 5,
                'max_days_completed' => 10,
                'max_protein_daily' => 100,
            ],
        ]);

        Challenge::create([
            'id' => 2,
            'title' => 'masak ayam',
            'description' => 'aku suka masak ayam',
            'duration_days' => 7,
            'criteria'  => [
                'min_protein_daily' => 5,
                'min_days_completed' => 51,
                'max_days_completed' => 110,
                'max_protein_daily' => 1001,
            ],
        ]);

        Challenge::create([
            'id' => 3,
            'title' => 'masak mie goreng',
            'description' => 'aku suka masak mie goreng',
            'duration_days' => 7,
            'criteria'  => [
                'min_protein_daily' => 5,
                'min_days_completed' => 51,
                'max_days_completed' => 110,
                'max_protein_daily' => 1001,
            ],
        ]);
    }
}
