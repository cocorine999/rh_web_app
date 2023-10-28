<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        "creator",
        'is_complete',
        'delay',
        'end_at',
        'finish_at',
        'begin_at',
        'start_at',
        "created_at",
        "updated_at",
    ];

    public function users(){
        return $this->belongsToMany(User::class,'project_users','project_id','user_id');
    }

    public function pieces_jointe(){
        return $this->morphMany(Fichier::class, 'filable');
    }

    public function tasks(){
        return $this->morphMany(Task::class, 'taskeable');
    }

    public function notes(){
        return $this->morphMany(Note::class, 'noteable');
    }

    public function steps(){
        return $this->morphMany(Step::class, 'stepeable');
    }

    public function goals(){
        return $this->hasMany(Goal::class);
    }

    public function createdBy(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function project_users(){
        return $this->hasMany(ProjectUsers::class);
    }

    public function project_actual_users(){
        return $this->users()->wherePivot('is_assign',true)->where('is_complete',false);
    }

    public function project_unassign_users(){
        return $this->users()->wherePivot('is_assign',false);
    }

    public function finish_project_users(){
        return $this->users()->wherePivot('is_assign',true)->where('is_complete',true);
    }

}
