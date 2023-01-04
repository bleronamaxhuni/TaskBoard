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
        return view('task');
    }

    public function store(Request $request)
    {
        $tasks = [
            'task_title' => $request->input( 'task_title'),
            'task_description' => $request->input('task_description'),
            'published_at' => $request->input('published_at'),
        ];
        dd(Task::create($tasks));

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

    public function destroy($id)
    {
        //
    }
}
