<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'spam_id' => 1,
                'title' => 'Sample Title 1',
                'amount' => 1000,
                'memo' => 'サンプル1',
                'image' => 'sample1.jpg',
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'id' => 2,
                'user_id' => 2,
                'spam_id' => 2,
                'title' => 'Sample Title 2',
                'amount' => 10000,
                'memo' => 'サンプル2',
                'image' => 'sample2.jpg',
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
