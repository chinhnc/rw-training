<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id')->comment('コンタクトのID');
            $table->integer('user_id')->nullable()->unsigned()->default(null)->index()->comment('ユーザのID');
            $table->string('email')->default('0')->comment('問い合せを送ったメール')->index();
            $table->string('tel', 15)->default('0')->comment('電話番号');
            $table->string('subject')->default('0')->comment('件名');
            $table->text('content')->comment('内容');
            $table->boolean('checked')->default(0)->comment('管理者が確認したかどうか');
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
        Schema::dropIfExists('contacts');
    }
}
