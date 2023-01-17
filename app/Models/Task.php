<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['task_title', 'task_description','completed_at','due_date','priority'];
    protected $dates = ['due_date','completed_at'];

    const Urgent = 'Urgent';
    const High = 'High';
    const Medium = 'Medium';
    const Low = 'Low';

    public static function Priorities()
    {
        return $priorities = [
            'urgent' => self::Urgent,
            'high' => self::High,
            'medium' => self::Medium,
            'low' => self::Low,
        ];
    }
}
