<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpInfomationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_infomations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('ip_address');
//            $table->string('user', 100);
//            $table->string('password', 100);
//            $table->string('country', 100);
            $table->string('locale', 20);
//            $table->string('note', 100);
//            $table->integer('code');
//            $table->string('city', 100);
            $table->tinyInteger('status')->comment('1: active, 0: deactivate');
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
        Schema::dropIfExists('ip_infomations');
    }
}
