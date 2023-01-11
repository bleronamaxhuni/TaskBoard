<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['task_title', 'task_description','completed_at','due_date'];
    protected $casts = [
        'completed_at' => 'boolean',
    ];
}
