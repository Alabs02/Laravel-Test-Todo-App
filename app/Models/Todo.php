<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $dates = [
        'completed_at'
    ];

    protected $fillable = [
        'name',
        'description',
        'is_completed',
        'user_id',
        'completed_at'
    ];
}
