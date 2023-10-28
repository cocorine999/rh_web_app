<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groupe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'groupes';
    protected $softDelete = true;

    protected $fillable = [
        'id',
        'name',
        'description',
        'type',
        'owner',
        'created_at',
        'updated_at',
    ];

    public function funder(){
        return $this->belongsTo(User::class,"owner");
    }

    public function illustration(){
        return $this->morphOne(Fichier::class, 'filable');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function last_message(){
        return $this->messages()->latest()->with('attached_files') ?? $this->messages()->latest();
    }

    public function latest_messages(){
        return $this->messages()->latest()->take('50');
    }

    public function users(){
        return $this->belongsToMany(User::class,'groupe_users','groupe_id','user_id')->withPivot('id','in_groupe','is_read','is_admin','user_id','groupe_id')->orderByDesc('created_at');
    }

    public function actif_users(){
        return $this->users()->wherePivot('in_groupe',true)->with('profile');
    }

    public function actif_groupe_members(){
        return $this->actif_users()->wherePivot('user_id','!=',auth()->id());
    }

    public function groupe_users(){
        return $this->hasMany(GroupeUsers::class);
    }

    public function groupe_members(){
        return $this->users()->wherePivot('user_id','!=',auth()->id())->wherePivot('in_groupe',true)->with('profile');
    }

    public function interlocuteur(){
        return $this->users()->wherePivot('user_id','!=',auth()->id())->with('profile');
    }


}
