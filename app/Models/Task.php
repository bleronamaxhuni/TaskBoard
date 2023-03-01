<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany(Tags::class, 'tasks_tags', 'task_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function project()
    {
        return $this->belongsTo(Projects::class);
    }

    public function toggleFavorite()
    {
        $this->favorite = !$this->favorite;
        $this->save();
    }

}
