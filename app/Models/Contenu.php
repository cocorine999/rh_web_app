<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    use HasFactory;

    protected $table = 'contentes';

    protected $fillable = [
        'id',
        'details',
        'contentable_id',
        'contentable_type',
        'created_at',
        'updated_at',
    ];

    public function contentable(){
        return $this->morphTo();
    }

    public function pieces_jointe(){
        return $this->morphMany(Fichier::class, 'filable');
    }
}
