<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id'); // 投稿ID, PK, AUTO_INCREMENT
            $table->integer('user_id')->nullable(false); // ユーザーID, INT, NotNull
            $table->integer('spam_id')->nullable(false); // スパムID, INT, NotNull
            $table->string('title', 30)->nullable(false); // タイトル, VARCHAR(30), NotNull
            $table->integer('amount')->nullable(false); // 金額, INT, NotNull
            $table->string('memo', 300)->nullable(false); // 内容, VARCHAR(300), NotNull
            $table->string('image', 100)->nullable(); // 投稿画像, VARCHAR(100)
            $table->boolean('status')->nullable(); // ステータス, BOOLEAN, 掲載中/進行中/完了
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
        Schema::dropIfExists('posts');
    }
}
