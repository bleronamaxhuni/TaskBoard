<?php

namespace App\Http\Controllers;

use App\Models\Projects;
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

    public function index()
    {
        $currentuser = Auth::user();
        if (request('search')) {
            $searchTerm = request('search');
            $tasks = Task::where(function ($query) use ($searchTerm) {
                $query->where('task_title', 'like', "%{$searchTerm}%")
                    ->orWhere('task_description', 'like', "%{$searchTerm}%");
            })->where('user_id', $currentuser->id)->paginate(5);
        } else {
            $tasks = Task::where('user_id', '=', $currentuser->id)->with(['tags', 'user', 'project'])->paginate(5);
        }
        return view('tasks.index', [
            'tasks' => $tasks,
            'priorities' => Task::Priorities(),
            'tags' => Tags::all(),
            'projects' => Projects::all(),
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
            'project_id' => 'required'
        ]);

        $task['user_id'] = Auth::user()->id;

        $tasks = Task::create($task);

        if ($request->has('tags')) {
            $tasks->tags()->attach(explode(',', $request->tags));
        }

        return back()->with("message", "Task has been created");
    }
    public function edit(Task $task)
    {
        $user = Auth::user();
        $tags = Tags::where('user_id', '=', $user->id)->get();
        $task['due_date'] = Carbon::parse($task['due_date'])->format('Y-m-d');

        if ($task->user_id !== $user->id) {
            return redirect()->back()->with('error', 'This task does not exist.');
        }
        return view('tasks.index', [
            'task' => $task,
            'priorities' => Task::Priorities(),
            // 'tags' => $tags,
            'projects' => Projects::all()
        ]);
    }


    public function update(Request $request, Task $task)
    {
        $tasks = $request->validate([
            'task_title' => 'required|max:200',
            'task_description' => 'required|max:100000',
            'due_date' => 'date|after_or_equal:created_at|nullable',
            'priority' => 'nullable',
            'tags' => 'array|nullable'
        ]);
        $tags = implode(',', $request->tags);
        $tag_ids = explode(',', $tags);
        $task->tags()->sync($tag_ids);

        $task->update($tasks);

        return back()->with("message", "Task has been updated");
    }

    public function toggleFavorite(Request $request, Task $task)
    {
        if ($task->favorite == 0) {
            $task->update(['favorite' => 1]);
            return back()->with("message", "Task has been favorited");
        } else {
            $task->update(['favorite' => 0]);
            return back()->with("message", "Task has been unfavorited");
        }
    }
    public function updateProgress(Request $request, Task $task)
    {
        $task->progress = $request->progress;
        $task->save();

        return back()->with("message", "Progress has been added");
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('message', "Task has been deleted");
    }
}
