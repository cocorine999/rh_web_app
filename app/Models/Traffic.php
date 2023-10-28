<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    use HasFactory;

    protected $table = 'trafics';

    protected $fillable = [
        'id',
        'motif',
        'groupe_user_id',
        "created_at",
        "updated_at",
    ];

    public function groupe_user(){
        return $this->belongsTo(GroupeUsers::class, 'groupe_user_id');
    }
}
