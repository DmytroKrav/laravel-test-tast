<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_messages', function (Blueprint $table) {
            $table->integer('sender_id')->unsigned()->index('sender_id');
            $table->integer('receiver_id')->unsigned();
            $table->string('message');
            $table->integer('created_at')->nullable();

            $table->foreign('sender_id')->references('id')->on('users');
            $table->foreign('receiver_id')->references('id')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_messages', function (Blueprint $table) {
            $table->dropForeign('users_messages_sender_id_foreign');
            $table->dropIndex('sender_id');
            $table->dropForeign('users_messages_receiver_id_foreign');

            $table->drop();
        });
    }
}
