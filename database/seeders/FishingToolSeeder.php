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
        $fishingTools = [
            ['name' => config('government.fishing_tool_options.0'), 'status' => 'active'],
            ['name' => config('government.fishing_tool_options.1'), 'status' => 'active'],
            ['name' => config('government.fishing_tool_options.2'), 'status' => 'active'],
            ['name' => config('government.fishing_tool_options.3'), 'status' => 'inactive'],
        ];

        foreach ($fishingTools as $fishingTool) {
            FishingTool::query()->updateOrCreate(
                ['name' => $fishingTool['name']],
                ['status' => $fishingTool['status']],
            );
        }
    }
}
