<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Projects $project,Request $request)
    {
        $currentuser = Auth::user();

        $projects = $currentuser->projects;

        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $project = $request->validate([
            'name' => 'required|max:200',
        ]);
        Projects::create($project);
        // dd($project);
    }
    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Projects $project)
    {
        $project->delete();
        return back()->with('message', "Project has been deleted");
    }
}
