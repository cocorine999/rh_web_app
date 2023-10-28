<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosteUser extends Model
{
    use HasFactory;

    protected $table = 'poste_users';

    protected $fillable = [
        'id',
        'user_id',
        'poste_id',
        "start_at",
        "in_function",
        "end_at",
        "created_at",
        "updated_at",
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function poste(){
        return $this->belongsTo(Poste::class);
    }

    public function paiements(){
        return $this->hasMany(Paiement::class);
    }

    public function salaires(){
        return $this->hasMany(Salaire::class);
    }
}
