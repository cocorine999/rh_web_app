<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        "project_id",
        'is_complete',
        'delay',
        'end_at',
        'finish_at',
        'begin_at',
        'start_at',
        "created_at",
        "updated_at",
    ];

    public function project(){
        return $this->belongsTo(Project::class,"project_id");
    }

    public function steps(){
        return $this->morphMany(Step::class, 'stepeable');
    }

    public function pieces_jointe(){
        return $this->morphMany(Fichier::class, 'filable');
    }

}
