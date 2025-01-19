<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Require authentication for all controller actions
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a paginated list of user's tasks with search functionality
     * Includes related tags, user, and project data
     */
    public function index()
    {
        $currentUser = Auth::user();

        $searchTerm = request('search');

        $tasks = Task::query()
            ->where('user_id', $currentUser->id)
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('task_title', 'like', "%{$searchTerm}%")->orWhere('task_description', 'like', "%{$searchTerm}%");
            })
            ->with(['tags', 'user', 'project'])
            ->orderByRaw("CASE 
                WHEN priority = 'Urgent' THEN 1 
                WHEN priority = 'High' THEN 2 
                WHEN priority = 'Medium' THEN 3 
                WHEN priority = 'Low' THEN 4 
                ELSE 5 
            END")
            ->paginate(10);

        return view('tasks.index', [
            'tasks' => $tasks,
            'priorities' => Task::Priorities(),
            'tags' => Tag::all(),
            'projects' => Project::all(),
        ]);
    }

    /**
     * Show the form for creating a new task
     */
    public function create()
    {
        return view('tasks.index', [
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created task in the database
     * Validates input, creates task, and attaches tags if provided
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task_title' => 'required|max:200',
            'task_description' => 'required|max:100000',
            'due_date' => 'date|after_or_equal:created_at|nullable',
            'priority' => 'nullable',
            'tags' => 'nullable',
            'project_id' => 'required',
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        $tasks = Task::create($validatedData);

        if ($request->has('tags')) {
            $tasks->tags()->attach(explode(',', $request->tags));
        }

        return back()->with('message', 'Task has been created');
    }

    /**
     * Show the form for editing an existing task
     */
    public function edit(Task $task)
    {
        $user = Auth::user();

        if ($task->user_id !== $user->id) {
            return redirect()->back()->with('error', 'This task does not exist.');
        }

        $task['due_date'] = Carbon::parse($task['due_date'])->format('Y-m-d');

        return view('tasks.index', [
            'task' => $task,
            'priorities' => Task::Priorities(),
            'projects' => Project::all(),
        ]);
    }

    /**
     * Update the specified existing task in the database
     */
    public function update(Request $request, Task $task)
    {
        $tasks = $request->validate([
            'task_title' => 'required|max:200',
            'task_description' => 'required|max:100000',
            'due_date' => 'date|after_or_equal:created_at|nullable',
            'priority' => 'nullable',
            'tags' => 'array|nullable',
        ]);

        $task->update($tasks);

        if ($request->has('tags')) {
            $task->tags()->sync($request->tags);
        }

        return back()->with('message', 'Task has been updated');
    }

    /**
     * Toggle the favorite status of a task
     */
    public function toggleFavorite(Task $task)
    {
        $task->update(['favorite' => !$task->favorite]);

        $message = $task->favorite ? 'Task has been favorited' : 'Task has been unfavorited';

        return back()->with('message', $message);
    }

    /**
     * Update the progress of a task
     */
    public function updateProgress(Request $request, Task $task)
    {
        $task->progress = $request->progress;
        $task->save();

        return back()->with('message', 'Progress has been added');
    }

    /**
     * Delete a task from the database
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('message', 'Task has been deleted');
    }
}
