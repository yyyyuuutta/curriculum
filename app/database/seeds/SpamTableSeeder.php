<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class SpamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spam')->insert([
            [
                'id' => 1,
                'post_id' => 1,
                'user_id' => 1,
                'report' => '違反',
            ],
        ]);
    }
}
