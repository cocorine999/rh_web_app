<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraficsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trafics', function (Blueprint $table) {
            $table->id();

            $table->string('motif')->default(' à quitter le groupe');

            $table->foreignId('groupe_user_id')
                    ->constrained('groupe_users')
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
        Schema::dropIfExists('trafics');
    }
}
