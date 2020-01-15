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
                'username' => 'user',
                'name' => 'user',
                'surname' => 'user',
                'email' => 'user@example.com',
                'password' => bcrypt('user1234'),
                'email_verified_at' => '2019-12-01 00:00:00',
                'role' => 'user',
            ],
            [
                'username' => 'admin',
                'name' => 'admin',
                'surname' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin1234'),
                'email_verified_at' => '2019-12-01 00:00:00',
                'role' => 'admin',

            ],

            [
                'username' => 'user1',
                'name' => 'user1',
                'surname' => 'user1',
                'email' => 'user1@example.com',
                'password' => bcrypt('user1234'),
                'email_verified_at' => '2019-12-01 00:00:00',
                'role' => 'user',

            ],

            [
                'username' => 'user2',
                'name' => 'user2',
                'surname' => 'user2',
                'email' => 'user2@example.com',
                'password' => bcrypt('user1234'),
                'email_verified_at' => '2019-12-01 00:00:00',
                'role' => 'user',

            ],

        ]);
    }
}
