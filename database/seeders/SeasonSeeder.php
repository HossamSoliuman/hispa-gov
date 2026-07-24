<?php

namespace Database\Seeders;

use App\Models\Season;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = now('Asia/Riyadh')->startOfDay();

        $seasons = [
            [
                'name' => 'موسم صيد الروبيان في الخليج العربي',
                'status' => 'active',
                'region' => config('government.regions.0'),
                'start_date' => $today->copy()->subDays(20),
                'end_date' => $today->copy()->addDays(55),
                'fishing_tools' => [config('government.fishing_tool_options.0'), config('government.fishing_tool_options.2')],
                'licenses_count' => 186,
                'minimum_size' => 10,
                'maximum_size' => 25,
                'restrictions' => 'الالتزام بمناطق الإنزال المعتمدة ومنع صيد صغار الروبيان أو استخدام الشباك المخالفة للمواصفات.',
            ],
            [
                'name' => 'موسم صيد الأسماك السطحية',
                'status' => 'active',
                'region' => config('government.regions.1'),
                'start_date' => $today->copy()->subDays(45),
                'end_date' => $today->copy()->addDays(30),
                'fishing_tools' => [config('government.fishing_tool_options.0'), config('government.fishing_tool_options.1')],
                'licenses_count' => 142,
                'minimum_size' => 20,
                'maximum_size' => 60,
                'restrictions' => 'يسمح بالصيد لحاملي الرخص السارية فقط، مع تسجيل كميات الإنزال يومياً في المرافئ المحددة.',
            ],
            [
                'name' => 'موسم صيد الكنعد',
                'status' => 'active',
                'region' => config('government.regions.4'),
                'start_date' => $today->copy()->subDays(10),
                'end_date' => $today->copy()->addDays(50),
                'fishing_tools' => [config('government.fishing_tool_options.1'), config('government.fishing_tool_options.3')],
                'licenses_count' => 96,
                'minimum_size' => 45,
                'maximum_size' => 120,
                'restrictions' => 'يمنع الاحتفاظ بالأسماك دون الحد الأدنى، ويلزم تركيب أجهزة التتبع على القوارب التجارية.',
            ],
            [
                'name' => 'موسم صيد الحريد',
                'status' => 'upcoming',
                'region' => config('government.regions.4'),
                'start_date' => $today->copy()->addDays(20),
                'end_date' => $today->copy()->addDays(65),
                'fishing_tools' => [config('government.fishing_tool_options.1'), config('government.fishing_tool_options.0')],
                'licenses_count' => 58,
                'minimum_size' => 25,
                'maximum_size' => 50,
                'restrictions' => 'تحدد ساعات الصيد من شروق الشمس حتى غروبها، ويمنع الصيد داخل مناطق الشعاب المرجانية المحمية.',
            ],
            [
                'name' => 'موسم صيد الناجل',
                'status' => 'upcoming',
                'region' => config('government.regions.3'),
                'start_date' => $today->copy()->addDays(45),
                'end_date' => $today->copy()->addDays(135),
                'fishing_tools' => [config('government.fishing_tool_options.1')],
                'licenses_count' => 72,
                'minimum_size' => 35,
                'maximum_size' => 90,
                'restrictions' => 'يسمح باستخدام الخيط والصنارة فقط، ويمنع الصيد في مناطق التكاثر المعلنة.',
            ],
            [
                'name' => 'موسم صيد الشعري',
                'status' => 'upcoming',
                'region' => config('government.regions.2'),
                'start_date' => $today->copy()->addDays(75),
                'end_date' => $today->copy()->addDays(165),
                'fishing_tools' => [config('government.fishing_tool_options.1'), config('government.fishing_tool_options.2')],
                'licenses_count' => 84,
                'minimum_size' => 25,
                'maximum_size' => 70,
                'restrictions' => 'يجب إعادة الأسماك الصغيرة إلى البحر فوراً، ولا يسمح بأكثر من خمسين كيلوغراماً للقارب يومياً.',
            ],
            [
                'name' => 'موسم صيد السردين',
                'status' => 'upcoming',
                'region' => config('government.regions.1'),
                'start_date' => $today->copy()->addDays(100),
                'end_date' => $today->copy()->addDays(190),
                'fishing_tools' => [config('government.fishing_tool_options.0')],
                'licenses_count' => 210,
                'minimum_size' => 12,
                'maximum_size' => 30,
                'restrictions' => 'استخدام الشباك ذات فتحات العيون المعتمدة فقط، مع الابتعاد عن الشاطئ ومسارات الملاحة.',
            ],
            [
                'name' => 'موسم صيد الروبيان في البحر الأحمر',
                'status' => 'closed',
                'region' => config('government.regions.4'),
                'start_date' => $today->copy()->subDays(220),
                'end_date' => $today->copy()->subDays(150),
                'fishing_tools' => [config('government.fishing_tool_options.0'), config('government.fishing_tool_options.2')],
                'licenses_count' => 134,
                'minimum_size' => 10,
                'maximum_size' => 25,
                'restrictions' => 'انتهى الموسم، ويمنع تداول المصيد غير المسجل أو الصيد خلال فترة الإغلاق.',
            ],
            [
                'name' => 'موسم صيد الهامور',
                'status' => 'closed',
                'region' => config('government.regions.0'),
                'start_date' => $today->copy()->subDays(190),
                'end_date' => $today->copy()->subDays(110),
                'fishing_tools' => [config('government.fishing_tool_options.1'), config('government.fishing_tool_options.2')],
                'licenses_count' => 88,
                'minimum_size' => 40,
                'maximum_size' => 100,
                'restrictions' => 'حظر الصيد في مناطق الحضانة، مع الالتزام بالحد اليومي المسموح لكل رخصة.',
            ],
            [
                'name' => 'موسم صيد السلطان إبراهيم',
                'status' => 'closed',
                'region' => config('government.regions.3'),
                'start_date' => $today->copy()->subDays(150),
                'end_date' => $today->copy()->subDays(80),
                'fishing_tools' => [config('government.fishing_tool_options.0'), config('government.fishing_tool_options.1')],
                'licenses_count' => 64,
                'minimum_size' => 18,
                'maximum_size' => 45,
                'restrictions' => 'يمنع جر الشباك قرب الموائل الحساسة، ويلزم فرز المصيد قبل مغادرة موقع الإنزال.',
            ],
            [
                'name' => 'موسم صيد الصافي',
                'status' => 'closed',
                'region' => config('government.regions.0'),
                'start_date' => $today->copy()->subDays(120),
                'end_date' => $today->copy()->subDays(50),
                'fishing_tools' => [config('government.fishing_tool_options.0'), config('government.fishing_tool_options.2')],
                'licenses_count' => 105,
                'minimum_size' => 20,
                'maximum_size' => 55,
                'restrictions' => 'الالتزام بمقاسات الشباك المعتمدة وعدم الصيد في الخلجان ومناطق الأعشاب البحرية المحمية.',
            ],
            [
                'name' => 'موسم صيد الشعور',
                'status' => 'closed',
                'region' => config('government.regions.2'),
                'start_date' => $today->copy()->subDays(260),
                'end_date' => $today->copy()->subDays(200),
                'fishing_tools' => [config('government.fishing_tool_options.1')],
                'licenses_count' => 76,
                'minimum_size' => 25,
                'maximum_size' => 65,
                'restrictions' => 'يقتصر الصيد على المواقع المرخصة ويلزم الإبلاغ عن المصيد وإعادته عند مخالفة المقاسات.',
            ],
        ];

        foreach ($seasons as $season) {
            Season::query()->updateOrCreate(
                ['name' => $season['name']],
                $season,
            );
        }
    }
}
