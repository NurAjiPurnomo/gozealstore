<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            [
                'name' => 'Default Theme',
                'description' => 'This is the default theme.',
                'folder' => 'theme.default',
                'status' => 'active',
            ],
            [
                'name' => 'Hexashop Theme',
                'description' => 'A modern e-commerce theme.',
                'folder' => 'theme.hexashop',
                'status' => 'inactive',
            ],
        ];

        foreach ($themes as $theme) {
            Theme::updateOrCreate(
                ['folder' => $theme['folder']],
                $theme
            );
        }
    }
}
