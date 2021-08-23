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
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            /**
             * https://yamaback.hatenadiary.org/entry/20110819/1313735667
             * https://qiita.com/cszunwr291/items/f5fba3fc6ac428f7fabb
             * 最大文字数（STR_LENGTH）を暗号化後の文字数の計算式
             * 16 * (trunc(STR_LENGTH / 16) + 1) * 2 + 16 * 2
             * [name]  max: 100 => 256
             * [email] max: 254 => 544
             */
            $table->string('name', 300);
            $table->string('email', 600);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedTinyInteger('role');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
