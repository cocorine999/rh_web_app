<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectUsers extends Pivot
{

    protected $table = 'project_users';

    protected $fillable = [
        'id',
        'is_assign',
        'project_id',
        "user_id",
        "created_at",
        "updated_at",
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
