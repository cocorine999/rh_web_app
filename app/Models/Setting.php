<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'enterprise_name',
        'slogan',
        'enterprise_phone_number',
        'enterprise_adress',
        'description',
        'site_web_url',
        'colors',
        'app_name',
        'app_url',
        'social_fb_url',
        'social_insta_url',
        'social_tw_url',
        'social_google_url',
        'enterprise_contact_url',
        'horaire_pause_start',
        'horaire_pause_end',
        'horaire_service_start',
        'horaire_service_end',
    ];

    public function logo(){
        return $this->morphOne(Fichier::class, 'filable')->where('url','like', '%settings/logo/%');
    }
}
