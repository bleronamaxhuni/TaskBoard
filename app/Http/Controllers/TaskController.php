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
            'task_title' =>'required|max:200',
            'task_description' =>'required|max:100000',
            'published_at' =>'required|date'
        ]);
        Task::create($tasks);
        return back()->with("message","Task has been created");

    }
    public function edit(Task $task)
    {
        return view('edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        $tasks = $request->validate([
            'task_title' =>'required|max:200',
            'task_description' =>'required|max:100000',
            'published_at' =>'required|date'
        ]);
        $task->update($tasks);
        return back()->with("message","Task has been updated");
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('message', "Task has been deleted");
    }
}
