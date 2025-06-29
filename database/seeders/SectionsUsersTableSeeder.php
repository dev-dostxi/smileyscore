<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\User;
use App\Models\SectionUser;


class SectionsUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        SectionUser::create([
            'user_id' => User::where('username', 'hr')->value('id'),
            'section_id' => Section::where('slug', 'hr')->value('id'),
        ]);

        SectionUser::create([
            'user_id' => User::where('username', 'kms')->value('id'),
            'section_id' => Section::where('slug', 'kms')->value('id'),
        ]);
        
        SectionUser::create([
            'user_id' => User::where('username', 'kms')->value('id'),
            'section_id' => Section::where('slug', 'hr')->value('id'),
        ]);

         SectionUser::create([
            'user_id' => User::where('username', 'cash')->value('id'),
            'section_id' => Section::where('slug', 'cash')->value('id'),
        ]);
    }
}
