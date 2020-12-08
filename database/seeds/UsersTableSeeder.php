<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Aqib Javed',
            'email' => 'aqibjavedadmin@gmail.com',
            'type' => 'A',
            'password' => bcrypt('aqibjaved'),
        ]);
    }
}
