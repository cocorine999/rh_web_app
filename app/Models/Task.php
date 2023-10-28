<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'id',
        'name',
        'details',
        'taskeable_id',
        'taskeable_type',
        'is_complete',
        'delay',
        'end_at',
        'finish_at',
        'begin_at',
        'start_at',
        'created_at',
        'updated_at',
    ];

    public function taskeable(){
        return $this->morphTo();
    }

    public function pieces_jointe(){
        return $this->morphMany(Fichier::class, 'filable');
    }

    public function notes(){
        return $this->morphMany(Note::class, 'noteable');
    }

    public function users(){
        return $this->belongsToMany(User::class,'user_tasks','task_id','user_id');
    }

    public function user_tasks(){
        return $this->hasMany(UserTasks::class);
    }

    public function user_actual_tasks(){
        return $this->users()->wherePivot('is_assign',true)->where('is_complete',false);
    }

    public function user_unassign_tasks(){
        return $this->users()->wherePivot('is_assign',false);
    }

    public function user_ended_tasks(){
        return $this->users()->wherePivot('is_assign',true)->where('is_complete',true);
    }

}
