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
            [
                'username' => 'rosalia',
                'name' => 'La Rosalía',
                'surname' => 'Vila',
                'email' => 'user@example.com',
                'password' => bcrypt('user1234'),
                'email_verified_at' => '2019-10-18 00:00:00',
                'avatar' => 'https://i.imgur.com/AJpN5jO.png',
                'role' => 'user',
                'api_token' => Str::random(60),
            ],
            [
                'username' => 'admin',
                'name' => 'admin',
                'surname' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin1234'),
                'email_verified_at' => '2019-12-18 00:00:00',
                'role' => 'admin',
                'api_token' => Str::random(60),

            ],

            [
                'username' => 'user1',
                'name' => 'user1',
                'surname' => 'user1',
                'email' => 'user1@example.com',
                'password' => bcrypt('user1234'),
                'email_verified_at' => '2019-12-18 00:00:00',
                'role' => 'user',
                'api_token' => Str::random(60),

            ],

            [
                'username' => 'user2',
                'name' => 'user2',
                'surname' => 'user2',
                'email' => 'user2@example.com',
                'password' => bcrypt('user1234'),
                'email_verified_at' => '2019-12-18 00:00:00',
                'role' => 'user',
                'api_token' => Str::random(60),

            ],

            [
                'username' => 'xartola',
                'name' => 'xartola',
                'surname' => 'xartola',
                'email' => 'xartola@example.com',
                'password' => bcrypt('xartola'),
                'email_verified_at' => '2020-01-14 00:00:00',
                'role' => 'user',
                'api_token' => Str::random(60),

            ],

            [
                'username' => 'kintxausti',
                'name' => 'kintxausti',
                'surname' => 'kintxausti',
                'email' => 'kintxausti@example.com',
                'password' => bcrypt('kintxausti'),
                'email_verified_at' => '2020-01-14 00:00:00',
                'role' => 'user',
                'api_token' => Str::random(60),

            ],

            [
                'username' => 'nlabandera',
                'name' => 'nlabandera',
                'surname' => 'nlabandera',
                'email' => 'nlabandera@example.com',
                'password' => bcrypt('nlabandera'),
                'email_verified_at' => '2020-02-05 00:00:00',
                'role' => 'user',
                'api_token' => Str::random(60),
            ],

        ]);
    }
}
