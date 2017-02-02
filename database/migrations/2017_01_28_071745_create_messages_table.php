<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('sender')->unsigned();
            $table->integer('recipient')->unsigned();
            $table->string('subject');
            $table->enum('label', ['Importante', 'Advertencia', 'Informacion']);
            $table->text('message');
            $table->dateTime('datetime');
            $table->enum('state', ['inbox', 'drafts', 'trash']);
            $table->boolean('opened');
            $table->foreign('sender')->references('id')->on('users');
            $table->foreign('recipient')->references('id')->on('users');
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
        Schema::dropIfExists('messages');
    }
}
