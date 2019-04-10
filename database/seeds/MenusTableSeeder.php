<?php

use Illuminate\Database\Seeder;
use IVSales\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'title' => 'Техника',
            'alias' => 'tehnika'
        ]);
        Menu::create([
            'title' => 'ЗОЖ',
            'alias' => 'zoj'
        ]);
        Menu::create([
            'title' => 'Автотовары',
            'alias' => 'avtotovari'
        ]);
        Menu::create([
            'title' => 'Развлечения и отдых',
            'alias' => 'razvletcheniya-otdix'
        ]);
        Menu::create([
            'title' => 'Одежда и обувь',
            'alias' => 'odejda-obuv'
        ]);
        Menu::create([
            'title' => 'Услуги',
            'alias' => 'uslugi'
        ]);
        Menu::create([
            'title' => 'Блог',
            'alias' => 'blog'
        ]);
    }
}
