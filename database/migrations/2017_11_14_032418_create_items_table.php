<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id')->index()->comment('案件のID');
            $table->string('title')->default('0')->comment('案件のタイトル');
            $table->text('description')->comment('案件の説明');
            $table->integer('point_num')->default(0)->comment('案件をアクティブして獲得するポイント');
            $table->string('url')->default('0')->comment('案件サイトへのURL');
            $table->string('image')->nullable()->default(null)->comment('案件のイメージ');
            $table->boolean('is_active')->default(1)->comment('案件の有力かどうか');
            $table->dateTime('start_time')->comment('案件表示を始める時間');
            $table->dateTime('end_time')->comment('案件表示を終了する時間');
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
        Schema::dropIfExists('items');
    }
}
