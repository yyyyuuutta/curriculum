<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;


class JobofferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('joboffer')->insert([
            'id'=> 1,
            'user_id' => 1,
            'post_id' => 1,
            'tel' => '08012345678',
            'email' => 'test@example.co.jp',
            'title' => 'タイトル1',
           'deadline' => '2024-12-31',
            'amount' => '1000',
            'memo' => 'サンプル1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
