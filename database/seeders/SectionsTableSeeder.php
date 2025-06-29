<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;
use Illuminate\Support\Str;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            'hr',
            'kms',
            'cash',
        ];

        foreach ($sections as $name) {
            Section::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
