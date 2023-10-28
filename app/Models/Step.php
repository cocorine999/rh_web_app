<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $table = 'steps';

    protected $fillable = [
        'id',
        'intitule',
        'description',
        'stepeable_id',
        'stepeable_type',
        'end_at',
        'finish_at',
        'begin_at',
        'start_at',
        'created_at',
        'updated_at',
    ];

    public function stepeable(){
        return $this->morphTo();
    }

    public function tasks(){
        return $this->morphMany(Task::class, 'taskeable');
    }

}
