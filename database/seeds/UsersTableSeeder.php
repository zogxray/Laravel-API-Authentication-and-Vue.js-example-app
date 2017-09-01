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
        \App\User::firstOrCreate([
            'email' => 'zogxray@gmail.com',
            'password' => bcrypt('777777'),
        ]);
    }
}
