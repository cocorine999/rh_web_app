<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'is_pay',
        'user_id',
        'date',
        'salaire',
        'poste_user_id',
        "created_at",
        "updated_at",
    ];

    public function poste_user(){
        return $this->belongsTo(PosteUser::class, 'poste_user_id');
    }

    public function responsable(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
