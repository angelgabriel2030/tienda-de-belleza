<?php

namespace Database\Seeders;

use App\Models\SiteText;
use Illuminate\Database\Seeder;

class SiteTextSeeder extends Seeder
{
    public function run(): void
    {
        $texts = [
            'hero_line_1'    => 'Belleza que',
            'hero_line_2'    => 'se siente',
            'hero_line_3'    => 'en ti.',
            'hero_desc'      => 'Maquillaje, joyeria y tratamientos de belleza seleccionados para realzar tu esencia.',
            'quote'          => 'Usa todos tus accesorios bonitos todos los dias. La ocasion especial es estar con vida.',
            'quote_author'   => 'VM Beauty — by Karla',
            'about_p1'       => 'VM Beauty nacio de la pasion por la belleza y el deseo de poner en las manos de cada persona los mejores productos.',
            'about_p2'       => 'Cada pieza que ofrecemos es seleccionada con criterio. Porque tu mereces solo lo que realmente vale la pena.',
            'contact_desc'   => 'Visitanos en Instagram o envianos un mensaje directo.',
            'instagram_url'  => 'https://www.instagram.com/vm_bea.uty13',
        ];

        foreach ($texts as $key => $value) {
            SiteText::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}