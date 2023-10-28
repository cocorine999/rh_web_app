<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'montant',
        'motif',
        "poste_user_id",
        "created_at",
        "updated_at",
    ];

    public function graduation_of(){
        return $this->poste_user->user();
    }

    public function poste_user(){
        return $this->belongsTo(PosteUser::class, 'poste_user_id');
    }
}
