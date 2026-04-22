<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@vmbeauty.com'],
            [
                'name'     => 'Karla Admin',
                'email'    => 'admin@vmbeauty.com',
                'password' => Hash::make('vmbeauty2025'),
            ]
        );
    }
}