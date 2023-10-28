<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbilitiesRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abilities_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')
                    ->constrained('roles')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('ability_id')
                    ->constrained('abilities')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('abilities_roles');
    }
}
