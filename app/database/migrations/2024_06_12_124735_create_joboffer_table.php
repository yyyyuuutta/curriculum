<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobofferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joboffer', function (Blueprint $table) {
            $table->bigIncrements('id'); // 依頼ID, PK, AUTO_INCREMENT
            $table->integer('user_id')->nullable(false); // ユーザーID, INT, NotNull
            $table->integer('post_id')->nullable(false); // ポストID, INT, NotNull
            $table->string('tel', 30)->unique(); // 電話番号, VARCHAR(30), UK
            $table->string('email', 30)->unique()->nullable(false); // メールアドレス, VARCHAR(30), NotNull, UK
            $table->string('title', 30); // タイトル, VARCHAR(30)
            $table->date('deadline'); // 希望納期, DATE
            $table->integer('amount'); // 金額, INT
            $table->string('memo', 300); // 内容, VARCHAR(300)
            $table->dateTime('created_at'); // 登録日時, DATETIME
            $table->dateTime('updated_at'); // 更新日時, DATETIME
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joboffer');
    }
}
