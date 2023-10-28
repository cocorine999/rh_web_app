<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserTasks extends Pivot
{

    protected $table = 'user_tasks';

    protected $fillable = [
        'id',
        'is_assign',
        'task_id',
        "user_id",
        "created_at",
        "updated_at",
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
