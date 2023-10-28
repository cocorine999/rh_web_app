<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    use HasFactory;
    protected $table = 'files';
    protected $fillable = [
        'id',
        'url',
        'name',
        'filable_id',
        'filable_type',
        'created_at',
        'updated_at',
    ];

    public function filable(){
        return $this->morphTo();
    }
}
