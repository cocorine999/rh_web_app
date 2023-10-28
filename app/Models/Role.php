<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasAbilitiesTrait;

class Role extends Model
{
    use HasFactory;
    use HasAbilitiesTrait;

    protected $fillable = [
        'id',
        'name',
        'slug',
        "created_at",
        "updated_at",
    ];

    public function users(){
        return $this->belongsToMany(User::class,'role_users','role_id','user_id');
    }

    public function abilities() {
        return $this->belongsToMany(Ability::class,'abilities_roles','role_id','ability_id');
    }
}
