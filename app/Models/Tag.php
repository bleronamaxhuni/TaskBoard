<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name'];
    protected $table = 'tags';

    public function setNameAttribute($tag){
        $this->attributes['name']= $tag;
    }
    public function tasks()
    {
        return $this->belongsToMany(Task::class,'tasks_tags','task_id','tag_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
