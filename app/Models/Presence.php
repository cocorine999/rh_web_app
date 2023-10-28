<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'is_present',
        'in_at',
        'out_at',
        'user_id',
        "created_at",
        "updated_at",
    ];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

}
