<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupeUsers extends Pivot
{
    use SoftDeletes;

    protected $table = 'groupe_users';
    protected $softDelete = true;


    protected $fillable = [
        'id',
        'in_groupe',
        'is_admin',
        'is_read',
        'groupe_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function groupe(){
        return $this->belongsTo(Groupe::class);
    }

    public function messages(){
        return $this->belongsToMany(Message::class,'groupe_user_messages','groupe_user_id','message_id')->withPivot('id','is_read','read_at','groupe_user_id','message_id');
    }

    public function latest_messages(){
        return $this->messages()->latest();
    }

    public function last_message(){
        return $this->latest_messages()->first();
    }

    public function groupe_users_as_read_message(){
        return $this->hasMany(GroupeUserMessages::class,'groupe_user_id');
    }
}
