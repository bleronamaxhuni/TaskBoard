<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{

    /**
     * Display a listing of projects for the authenticated user
     */
    public function index(Project $project)
    {
        return view('projects.index', [
            'projects' => Auth::user()->projects,
            'project' => $project,
            'priorities' => Task::Priorities(),
            'tags' => Tag::all(),
        ]);
    }
    
    /**
     * Store a new project in the database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:200'
        ]);

        Auth::user()->projects()->create($validated);
        
        return back()->with('message', 'Project has been created');
    }

    /**
     * Show the form for editing an existing project
     */
    public function edit(Project $project)
    {
        return view('projects.index',['project'=>$project]);
    }

    /**
     * Update an existing project in the database
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
        ]);
        $project->update($validated);
        
        return back()->with('message', 'Project has been updated');
    }
    
    /**
     * Delete a project from the database
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('message', 'Project has been deleted');
    }
}
