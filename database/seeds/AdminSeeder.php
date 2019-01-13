<?php

use Illuminate\Database\Seeder;
use \App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(array(
            'first_name' => 'Nur',
            'last_name' => 'Wahid',
            'email' => 'nurwahid@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'Mountain View, California',
            'photo' => NULL,
            'api_token' => str_random(60),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL,
        ));
    }
}
