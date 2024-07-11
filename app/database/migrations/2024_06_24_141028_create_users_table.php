<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); // ユーザーID, PK, AUTO_INCREMENT
            $table->string('name', 10); // ユーザー名, VARCHAR(10), NotNull
            $table->string('email', 30)->unique(); // メールアドレス, VARCHAR(30), NotNull, UK
            $table->string('password', 100); // パスワード, VARCHAR(100), NotNull, ハッシュ化
            $table->string('image', 100)->nullable(); // ユーザーアイコン, VARCHAR(100)
            $table->integer('role')->default(1); // ユーザー区分, INT, NotNull, デフォルト値=1 (管理=0/一般=1)
            $table->boolean('del_flg')->default(false); // ユーザー論理削除, BOOLEAN, NotNull, デフォルト値=FALSE
            $table->dateTime('created_at')->nullable(); // 登録日時, DATETIME
            $table->dateTime('updated_at')->nullable(); // 更新日時, DATETIME
            $table->string('reset_token', 100)->nullable(); // リセットトークン, VARCHAR(100), パスワードリセット用
        });

        Schema::table('users', function (Blueprint $table) {
            // profile_text カラムを追加する
            $table->string('profile_text', 30)->nullable(); // プロフィール文, VARCHAR(30), NULL許容
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        
        Schema::table('users', function (Blueprint $table) {
            // profile_text カラムを削除する
            $table->dropColumn('profile_text');
        });
    }
}
	