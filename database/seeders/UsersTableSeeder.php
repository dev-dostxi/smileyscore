<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Section;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        // User 1: HR Staff
        $user1 = User::create([
            'name' => 'HR Staff',
            'email' => 'hr@dostxi',
            'username' => 'hr',
            'password' => Hash::make('Password1'),
        ]);

        // User 2: KMS Staff
        $user2 = User::create([
            'name' => 'KMS Staff',
            'email' => 'kms@dostxi',
            'username' => 'kms',
            'password' => Hash::make('Password1'),
        ]);

        // User 3: Cash Staff
        $user2 = User::create([
            'name' => 'Cash Staff',
            'email' => 'cash@dostxi',
            'username' => 'cash',
            'password' => Hash::make('Password1'),
        ]);

    }
}
