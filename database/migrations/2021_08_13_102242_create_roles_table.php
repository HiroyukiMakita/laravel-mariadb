<?php

use App\Enums\Roles;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            /**
             * @link Roles
             * 権限の定数名を小文字にしたものをカラム名にする
             */
            foreach (Roles::getLowerKeys() as $label) {
                $table->boolean($label)->nullable()->default(null);
            }
            $table->timestamps();
            $table->primary('id');
            $table->foreign('id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
}
