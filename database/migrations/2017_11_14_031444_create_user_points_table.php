<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false)->unique()->unsigned()->index()->comment('ユーザID');
            $table->integer('pending_point')->nullable(false)->default(0)->comment('発生ポイント数');
            $table->integer('approval_point')->nullable(false)->default(0)->comment('承認ポイント数');
            $table->integer('reject_point')->nullable(false)->default(0)->comment('却下ポイント数');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_points');
    }
}
