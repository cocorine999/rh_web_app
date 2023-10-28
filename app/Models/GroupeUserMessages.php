<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupeUserMessages extends Pivot
{

    use SoftDeletes;

    protected $table = 'groupe_user_messages';
    protected $softDelete = true;

    protected $fillable = [
        'id',
        'read_at',
        'is_read',
        'groupe_user_id',
        'message_id',
        'created_at',
        'updated_at',
    ];

    public function message(){
        return $this->belongsTo(Message::class);
    }

    public function groupe_user(){
        return $this->belongsTo(GroupeUsers::class);
    }

}
