<?php

return [
    'user' => [
        'name' => env('GOVERNMENT_USER_NAME', 'Hawat Gov'),
        'email' => env('GOVERNMENT_USER_EMAIL', 'gov@hawat.sa'),
        'password' => env('GOVERNMENT_USER_PASSWORD', 'password'),
    ],

    'regions' => [
        'المنطقة الشرقية',
        'منطقة مكة المكرمة',
        'منطقة المدينة المنورة',
        'منطقة تبوك',
        'منطقة جازان',
    ],

    'season_statuses' => [
        'upcoming' => 'قادم',
        'active' => 'نشط',
        'closed' => 'مغلق',
    ],

    'fishing_tool_options' => [
        'شباك الصيد',
        'الخيط والصنارة',
        'القراقير',
        'السنارات الآلية',
    ],

    'navigation' => [
        ['label' => 'لوحة التحكم', 'icon' => 'dashboard', 'route' => 'government.dashboard', 'active' => 'government.dashboard*'],
        ['label' => 'التحليلات المتقدمة', 'icon' => 'chart', 'route' => null, 'active' => null],
        ['label' => 'الإنتاج السمكي', 'icon' => 'production', 'route' => 'government.production', 'active' => 'government.production'],
        ['label' => 'المواسم', 'icon' => 'calendar', 'route' => 'government.seasons.index', 'active' => 'government.seasons.*'],
        ['label' => 'أنواع الأسماك', 'icon' => 'fish', 'route' => 'government.fish-types', 'active' => 'government.fish-types'],
        ['label' => 'القوى العاملة', 'icon' => 'users', 'route' => 'government.workforce', 'active' => 'government.workforce'],
        ['label' => 'أدوات الصيد', 'icon' => 'tools', 'route' => 'government.fishing-tools.index', 'active' => 'government.fishing-tools.*'],
        ['label' => 'التقارير', 'icon' => 'report', 'route' => null, 'active' => null],
        ['label' => 'إدارة المخالفات', 'icon' => 'warning', 'route' => null, 'active' => null],
        ['label' => 'إدارة المرافق', 'icon' => 'port', 'route' => null, 'active' => null],
        ['label' => 'إدارة الموظفين', 'icon' => 'employee', 'route' => null, 'active' => null],
        ['label' => 'إدارة الصلاحيات', 'icon' => 'permissions', 'route' => null, 'active' => null],
    ],
];
