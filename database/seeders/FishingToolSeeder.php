<?php

namespace Database\Seeders;

use App\Models\FishingTool;
use Illuminate\Database\Seeder;

class FishingToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FishingTool::factory()->count(3)->create();
    }
}
