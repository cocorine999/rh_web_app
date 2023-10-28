<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAbilitiesTrait;

class Poste extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'salaire',
        "created_at",
        "updated_at",
    ];

    public function users(){
        return $this->belongsToMany(User::class,'poste_users','poste_id','user_id')->withPivot("id",'in_function',"end_at",'id','start_at');
    }


    public function abilities() {

        return $this->belongsToMany(Ability::class,'abilities_postes','poste_id','ability_id');

    }

    public function users_on_function(){
        return $this->belongsToMany(User::class,'poste_users','poste_id','user_id')->wherePivot('in_function',true);
    }

    public function poste_users(){
        return $this->hasMany(PosteUser::class);
    }
}
