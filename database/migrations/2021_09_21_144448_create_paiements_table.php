<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->text("is_pay");
            $table->foreignId('poste_user_id')
                    ->constrained('poste_users')
                    ->onUpdate('restrict')
                    ->onDelete('restrict');
            $table->foreignId('user_id')
                            ->constrained('users')
                            ->onUpdate('restrict')
                            ->onDelete('restrict');

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
        Schema::dropIfExists('paiements');
    }
}
