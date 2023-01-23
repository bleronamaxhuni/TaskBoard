<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tags::all();
        return view('tags.index', ['tags' => $tags]);
    }

    public function store(Request $request)
    {
        $tags = $request->validate([
            'name' => 'required|max:200',
        ]);
        Tags::create($tags);
        // Tags::create(['name' => $request->name]);
        return back()->with("message","Tag has been created");
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

    public function destroy(Tags $tag)
    {
        $tag->delete();
        return back()->with('message', 'Tag was deleted');
    }
}
