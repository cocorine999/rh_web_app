<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('enterprise_name')->nullable();
            $table->text('slogan')->nullable();
            $table->longText('description')->nullable();
            $table->string('site_web_url')->nullable();
            $table->string('enterprise_phone_number')->nullable();
            $table->string('enterprise_adress')->nullable();
            $table->string('colors')->nullable();
            $table->string('app_name')->nullable();
            $table->string('app_url')->nullable();
            $table->string('horaire_service_start')->nullable();
            $table->string('horaire_service_end')->nullable();
            $table->string('horaire_pause_start')->nullable();
            $table->string('horaire_pause_end')->nullable();
            $table->string('social_fb_url')->nullable();
            $table->string('social_tw_url')->nullable();
            $table->string('social_insta_url')->nullable();
            $table->string('social_google_url')->nullable();
            $table->string('enterprise_contact_url')->nullable();

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
        Schema::dropIfExists('settings');
    }
}
