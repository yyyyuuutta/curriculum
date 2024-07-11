<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id'); // いいねID, PK, AUTO_INCREMENT, NotNull
            $table->integer('post_id')->nullable(false); // ポストID, INT, NotNull
            $table->integer('user_id')->nullable(false); // ユーザーID, INT, NotNull
            $table->dateTime('created_at')->nullable(); // 登録日時, DATETIME
            $table->dateTime('updated_at')->nullable(); // 更新日時, DATETIME
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
