<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','task_title', 'task_description', 'completed_at', 'due_date', 'priority'];
    protected $dates = ['due_date', 'completed_at'];

    const Urgent = 'Urgent';
    const High = 'High';
    const Medium = 'Medium';
    const Low = 'Low';

    public static function Priorities()
    {
        return  [
            'urgent' => self::Urgent,
            'high' => self::High,
            'medium' => self::Medium,
            'low' => self::Low,
        ];
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'tasks_tags', 'task_id', 'tag_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
