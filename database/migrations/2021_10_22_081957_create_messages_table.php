<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            $table->longText('content')->nullable();

            $table->foreignId('from')
                    ->constrained('users')
                    ->onUpdate('restrict')
                    ->onDelete('restrict');

            $table->foreignId('groupe_id')
                    ->constrained('groupes')
                    ->onUpdate('restrict')
                    ->onDelete('restrict');

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
        Schema::dropIfExists('messages');
    }
}
