<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spam', function (Blueprint $table) {
            $table->bigIncrements('id'); // 違反ID, PK, AUTO_INCREMENT
            $table->integer('post_id')->nullable(false); // ポストID, INT, NotNull
            $table->integer('user_id')->nullable(false); // ユーザーID, INT, NotNull
            $table->string('report', 300)->nullable(); // 違反報告理由, VARCHAR(300)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spam');
    }
}
