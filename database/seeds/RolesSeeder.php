<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name' => 'Программист']);
        DB::table('roles')->insert(['name' => 'Генеральный директор']);
        DB::table('roles')->insert(['name' => 'Технический директор']);
        DB::table('roles')->insert(['name' => 'Бухгалтер']);
        DB::table('roles')->insert(['name' => 'Офис менеджер']);
        DB::table('roles')->insert(['name' => 'Инженер']);
    }
}
