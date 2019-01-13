<?php

use Illuminate\Database\Seeder;
use \App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'first_name' => 'Yoona',
            'last_name' => 'Im',
            'email' => 'yoona.im@gmail.com',
            'password' => Hash::make('password'),
            'birth_date' => '1993-04-15 00:00:00',
            'address' => 'Seoul, South Korea',
            'pregnancy_start_at' => '2018-04-01 10:43:42',
            'height' => '156',
            'weight' => '56'
        ));
    }
}
