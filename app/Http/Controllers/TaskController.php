<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $currentuser = Auth::user();
        if (request('search')) {
            $searchTerm = request('search');
            $tasks = Task::where(function($query) use ($searchTerm) {
                $query->where('task_title', 'like', "%{$searchTerm}%")
                    ->orWhere('task_description', 'like', "%{$searchTerm}%");
            })->where('user_id', $currentuser->id)->paginate(5);
        } else {
            $tasks = Task::where('user_id','=',$currentuser->id)->with(['tags','user'])->paginate(5);
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
            'tags' => 'nullable',
        ]);
        $user_id = Auth::user()->id;
        $task['user_id'] = $user_id;
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
