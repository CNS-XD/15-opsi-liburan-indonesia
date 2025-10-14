<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Theme;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (env('APP_ENV') == 'local') {
            Theme::truncate();
        }

        $data = [];
        $data = array_merge($data, [
            [
                'color_1' => '#008FD3',
                'created_at' => now()
            ]
        ]);

        if (!empty($data)) {
            Theme::insert($data);
        }
    }
}
