<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $cats = [
            ['name' => 'Maquillaje',   'subtitle' => 'Farmasi & mas',    'order' => 1],
            ['name' => 'Joyeria',      'subtitle' => 'Piezas unicas',    'order' => 2],
            ['name' => 'Tratamientos', 'subtitle' => 'Cuidado personal', 'order' => 3],
        ];

        foreach ($cats as $cat) {
            Category::firstOrCreate(['name' => $cat['name']], $cat);
        }
    }
}