<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'almassar@mail.ru',
            'password' => bcrypt('derparol'),
            'name' => 'Алмас',
            'role_id' => 1,
            'organization_id' => 8,
            'mobile_phone' => '8(701)518-92-70']);
    }
}
