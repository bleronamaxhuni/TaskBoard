<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\TaskDueNotification;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','task_title', 'task_description', 'completed_at', 'due_date', 'priority','favorite','progress','project_id'];
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
    protected $enum = [
        'progress' => [
            'to do' => 'to do',
            'doing' => 'doing',
            'done' => 'done'
        ]
    ];
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tasks_tags', 'task_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function toggleFavorite()
    {
        $this->favorite = !$this->favorite;
        $this->save();
    }

    public function sendDueNotification()
    {
        if ($this->due_date && $this->due_date->diffInHours(now()) <= 24) {
            $this->user->notify(new TaskDueNotification($this));
        }
    }

    protected static function booted()
    {
        static::created(function ($task) {
            $task->sendDueNotification();
        });

        static::updated(function ($task) {
            if ($task->isDirty('due_date')) {
                $task->sendDueNotification();
            }
        });
    }
}
