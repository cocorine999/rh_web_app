<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'libelle',
        'description',
        'user_id',
        "date",
        "created_at",
        "updated_at",
    ];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function files(){
        return $this->morphMany(Fichier::class,'filable');
    }

}
