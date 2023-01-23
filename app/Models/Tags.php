<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table = 'tags';

    public function setNameAttribute($tag){
        $this->attributes['name']= $tag;
    }
    public function tasks()
    {
        return $this->belongsToMany(Task::class,'tasks_tags','task_id','tag_id');
    }
}
