<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('task', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $tasks = $request->validate([
            'task_title' => 'required|max:200',
            'task_description' => 'required|max:100000',
            'due_date'=>'after:now|nullable',
        ]);
        Task::create($tasks);
        return back()->with("message","Task has been created");

    }
    public function edit(Task $task)
    {
        $task['due_date'] = Carbon::parse($task['due_date'])->format('Y-m-d');
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        $tasks = $request->validate([
            'task_title' => 'required|max:200',
            'task_description' => 'required|max:100000',
            'due_date'=>'after:now|nullable',
        ]);
        $task->update($tasks);
        return back()->with("message","Task has been updated");
    }

    public function completed(Request $request, Task $task)
    {
        if ($task->completed_at == NULL) {
            $task->update(['completed_at' => now()]);
            return back()->with("message", "Task has been completed");
        } else {
            $task->update(['completed_at' => NULL]);
            return back()->with("message", "Task has been uncompleted");
        }
    }
    public function search(Request $request){
        if(request('search')){
            $tasks = Task::where('task_title','like','%'.request('search').'%')->orWhere('task_description','like','%'.request('search').'%')
            ->get();
        }else{
            $tasks = Task::all();
        }
        return view('task')->with('tasks', $tasks);
    }
    
    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('message', "Task has been deleted");
    }
}
