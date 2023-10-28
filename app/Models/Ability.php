<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'slug',
        "created_at",
        "updated_at",
    ];

    public function users(){
        return $this->belongsToMany(User::class,'abilities_users','ability_id','user_id');
    }
    public function roles() {
        return $this->belongsToMany(Role::class,'abilities_roles','ability_id','role_id');
    }
    public function postes() {
        return $this->belongsToMany(Poste::class,'abilities_postes','ability_id','poste_id');
    }
}
