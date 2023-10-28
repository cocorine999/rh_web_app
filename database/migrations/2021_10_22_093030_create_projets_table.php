<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();

            $table->mediumText('description')->nullable();

            $table->foreignId('creator')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->boolean('is_complete')->default(0);

            $table->string('delay')->nullable();

            $table->dateTime('end_at', $precision = 0)->nullable();

            $table->dateTime('start_at', $precision = 0)->nullable();

            $table->dateTime('begin_at', $precision = 0)->nullable();

            $table->dateTime('finish_at', $precision = 0)->nullable();

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
        Schema::dropIfExists('projects');
    }
}
