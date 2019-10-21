<?php

use Illuminate\Database\Seeder;

class OrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert(['name' => 'ТОО "Промбезтехнологии"', 'address' => 'г. Кокшетау, м-н.Юбилейный 2а']);
        DB::table('organizations')->insert(['name' => 'Комплекс "Жаркын"', 'address' => '']);
        DB::table('organizations')->insert(['name' => 'ТОО "Раисовское"', 'address' => '']);
        DB::table('organizations')->insert(['name' => 'АО "Нац инф технологии"']);
        DB::table('organizations')->insert(['name' => 'Детсад "Родничок" г.Атбасар']);
        DB::table('organizations')->insert(['name' => 'Каздрамтеатр']);
        DB::table('organizations')->insert(['name' => 'Акимат Зерендинского района']);
        DB::table('organizations')->insert(['name' => 'Казахтелеком']);
        DB::table('organizations')->insert(['name' => 'Детсад "Балапан"']);
        DB::table('organizations')->insert(['name' => 'Магазин "Жаксы"']);
        DB::table('organizations')->insert(['name' => 'Детсад "Алтын Бала"']);
        DB::table('organizations')->insert(['name' => 'Школа №5']);
        DB::table('organizations')->insert(['name' => 'ТОО "Журавлёвка-1"']);
        DB::table('organizations')->insert(['name' => 'Центр крови г. Астана']);
        DB::table('organizations')->insert(['name' => 'ГНПП "Бурабай"']);
        DB::table('organizations')->insert(['name' => 'Кокшетау Энерго']);
        DB::table('organizations')->insert(['name' => 'ТОО "АГРОФИРМА "ПРИИШИМСКИЙ"']);
    }
}
