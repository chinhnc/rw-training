<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_histories', function (Blueprint $table) {
            $table->string('result_id')->unique()->comment('アクションのユニークID : userId_itemId_actionDateの型');
            $table->integer('user_id')->unsigned()->comment('ユーザのID');
            $table->integer('item_id')->unsigned()->comment('案件のID - アイテムのID');
            $table->integer('point_num')->default(0)->comment('案件をアクションして獲得するポイント');
            $table->enum('status', ['pending','approval','reject'])->default('pending')->comment('案件のアクションの状態');
            $table->index(['user_id', 'item_id']);
            $table->index('result_id');
            $table->foreign('item_id')
                ->references('id')->on('items');
            $table->foreign('user_id')
                ->references('id')->on('users');
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
        Schema::dropIfExists('action_histories');
    }
}
