<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable = [
        'id',
        'details',
        'noteable_id',
        'noteable_type',
        'created_at',
        'updated_at',
    ];

    public function noteable(){
        return $this->morphTo();
    }

    public function pieces_jointe(){
        return $this->morphMany(Fichier::class, 'filable');
    }

    public function contentes(){
        return $this->morphMany(Contenu::class, 'contentable');
    }
}
