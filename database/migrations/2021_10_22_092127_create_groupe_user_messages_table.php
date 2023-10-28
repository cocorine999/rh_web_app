<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupeUserMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupe_user_messages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('groupe_user_id')
                    ->constrained('groupe_users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('message_id')
                    ->constrained('messages')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->boolean('is_read')->default(0);

            $table->dateTime('read_at', $precision = 0)->nullable();

            $table->softDeletes();

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
        Schema::dropIfExists('groupe_user_messages');
    }
}
