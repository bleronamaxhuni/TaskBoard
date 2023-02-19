<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Tags;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function index(Projects $project)
    {
        // $currentuser = Auth::user();
        
        // if (request('searchProject')) {
        //     $searchTerm = request('searchProject');
        //     $projects = Projects::where(function ($query) use ($searchTerm) {
        //         $query->where('name', 'like', "%{$searchTerm}%");
        //     })->where('user_id', $currentuser->id)->paginate(5);
        // } else {
        //     $projects = Projects::where('user_id', '=', $currentuser->id)->paginate(5);
        // }
        // return view('projects.index', [
        //     'projects' => $projects,
        //     'project' => $project,
        // ]);
        $currentuser = Auth::user();

        $projects = $currentuser->projects;

        return view('projects.index', [
            'projects' => $projects,
            'project' => $project,
        ]);
    }
    
    public function store(Request $request)
    {
        $project = $request->validate([
            'name' => 'required|max:200'
        ]);
        $project['user_id'] = Auth::user()->id;

        $projects =  Projects::create($project);
        
        return back()->with("message", "Project has been created");
    }

    public function show(Projects $project)
    {    

    }

    public function edit(Projects $project)
    {
        return view('projects.index',['project'=>$project]);
    }

    public function update(Request $request, Projects $project)
    {
        $projects = $request->validate([
            'name' => 'required|max:200',
        ]);
        $project->update($projects);
        
        return back()->with("message", "Project has been updated");
    }

    public function destroy(Projects $project)
    {
        $project->delete();
        return back()->with('message', "Project has been deleted");
    }
}
