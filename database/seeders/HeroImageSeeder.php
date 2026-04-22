<?php

namespace Database\Seeders;

use App\Models\HeroImage;
use Illuminate\Database\Seeder;

class HeroImageSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['main', 'secondary', 'third'] as $slot) {
            HeroImage::firstOrCreate(['slot' => $slot]);
        }
    }
}