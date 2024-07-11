<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
                'id' => 1,
                'name' => 'naoki',
                'profile_text' => '私はナオキです。',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'image' => 'default.png',
                'role' => 1,
                'del_flg' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'reset_token' => null,
            ],
        ]);
    }
}
