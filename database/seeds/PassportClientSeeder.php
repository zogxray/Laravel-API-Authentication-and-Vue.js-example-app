<?php

use Illuminate\Database\Seeder;

class PassportClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('oauth_clients')->insert([
            'id' => 1,
            'user_id' => null,
            'name' => 'Laravel Password Grant Client',
            'secret' => 'RUARuS0q7Jwd5kYOiCJgnPXCRgjkaXzkYSB9kfj2',
            'redirect' => 'http://test.dev/auth/callback',
            'personal_access_client' => false,
            'password_client' => true,
            'revoked' => false,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' =>  \Carbon\Carbon::now(),
        ]);
    }
}
