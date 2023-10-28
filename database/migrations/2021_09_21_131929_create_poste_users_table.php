<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosteUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poste_users', function (Blueprint $table) {
            $table->id();
            $table->string('start_at')->nullable();
            $table->string('end_at')->nullable();
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('restrict')
                    ->onDelete('restrict');
            $table->foreignId('poste_id')
                    ->constrained('postes')
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
        Schema::dropIfExists('poste_users');
    }
}
