<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;
    protected $table = 'rendez_vous';

    protected $fillable = [
        'id',
        'visiteur_name',
        'visiteur_telephone',
        'libelle',
        'description',
        'date',
        'status',
        'user_id',
        "created_at",
        "updated_at",
    ];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
