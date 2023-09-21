<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Priority::factory()->create([
            'name' => 'Faible',
        ]);
        \App\Models\Priority::factory()->create([
            'name' => 'Moyenne',
        ]);
        \App\Models\Priority::factory()->create([
            'name' => 'Élevée',
        ]);
    }
}
