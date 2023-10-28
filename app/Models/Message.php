<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $softDelete = true;
    protected $fillable = [
        'id',
        'content',
        'from',
        'parent_message_id',
        'groupe_id',
        "created_at",
        "updated_at",
    ];

    public function conversation(){
        return $this->belongsTo(Groupe::class, 'groupe_id');
    }

    public function parent(){
        return $this->belongsTo(Message::class, 'parent_message_id');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'parent_message_id');
    }

    public function author(){
        return $this->belongsTo(User::class, 'from');
    }

    public function attached_files(){
        return $this->morphMany(Fichier::class, 'filable');
    }

    public function groupe_users(){
        return $this->belongsToMany(GroupeUsers::class,'groupe_user_messages','message_id','groupe_user_id')->withPivot('id','is_read','read_at','groupe_user_id','message_id');
    }

    public function messages_read_by_group_users(){
        return $this->hasMany(GroupeUserMessages::class,'message_id');
    }

}
