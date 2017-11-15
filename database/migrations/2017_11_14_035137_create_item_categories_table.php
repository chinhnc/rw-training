<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_categories', function (Blueprint $table) {
            $table->integer('item_id')->unsigned()->comment('案件のID - アイテムのID');
            $table->integer('category_id')->unsigned()->comment('カテゴリのID');
            $table->primary(['item_id', 'category_id']);
            $table->foreign('item_id')
                ->references('id')->on('items');
            $table->foreign('category_id')
                ->references('id')->on('categories');
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
        Schema::dropIfExists('item_categories');
    }
}
