<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id')->comment('ユーザID');
            $table->string('nickname', 50)->unique()
                ->nullable(false)->default('0')
                ->index()->comment('ユーザのニックネーム');
            $table->string('name', 100)->nullable(false)->default('0')->comment('ユーザの名前');
            $table->string('email')->unique()->nullable(false)->default('0')->index()->comment('ユーザメール');
            $table->string('tel', 15)->nullable(false)->default('0')->comment('ユーザの電話番号');
            $table->string('password')->nullable(false)->default('0')->comment('パスワードのエンコード');
            $table->date('birthday')->nullable(false)->comment('ユーザの生年月日');
            $table->enum('gender', ['Male','Female'])->nullable(false)->comment('ユーザのジェンダー');
            $table->boolean('is_active')->nullable(false)->default(1)->comment('1: 会員中, 0: 退会');
            $table->rememberToken()->comment("リメンバートークン");
            $table->timestamps();
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
    }
}
