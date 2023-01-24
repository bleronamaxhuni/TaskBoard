<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if (request('search')) {
            $tasks = Task::where('task_title', 'like', '%' . request('search') . '%')->orWhere('task_description', 'like', '%' . request('search') . '%')
                ->get();
        } else {
            $tasks = Task::with(['tags'])->paginate(5);
        }
        return view('tasks.index', [
            'tasks' => $tasks,
            'priorities' => Task::Priorities(),
            'tags' => Tags::all(),
        ]);
    }

    public function create()
    {
        $tags = Tags::all();
        return view('tasks.index', [
            'tags' => $tags,
        ]);
    }
    public function store(Request $request)
    {
        $task = $request->validate([
            'task_title' => 'required|max:200',
            'task_description' => 'required|max:100000',
            'due_date' => 'date|after_or_equal:created_at|nullable',
            'priority' => 'nullable',
            'tags' => 'nullable'
        ]);
        $tasks = Task::create($task);

        if ($request->has('tags')) {
            $tasks->tags()->attach(explode(',', $request->tags));
        }


        return back()->with("message", "Task has been created");
    }
    public function edit(Task $task)
    {
        $task['due_date'] = Carbon::parse($task['due_date'])->format('Y-m-d');
        return view('tasks.edit', [
            'task' => $task,
            'priorities' => Task::Priorities(),
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $tasks = $request->validate([
            'task_title' => 'required|max:200',
            'task_description' => 'required|max:100000',
            'due_date' => 'date|after_or_equal:created_at|nullable',
            'priority' => 'nullable',

        ]);
        $task->update($tasks);
        return back()->with("message", "Task has been updated");
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

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('message', "Task has been deleted");
    }
}
