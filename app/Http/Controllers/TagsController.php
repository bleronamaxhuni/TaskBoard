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
        return back()->with("message","Tag has been created");
    }

    public function edit(Tags $tag)
    {
        return view('tags.edit', ['tag' => $tag,]);
    }

    public function update(Request $request, Tags $tag)
    {
        $tags = $request->validate([
            'name' => 'required|max:200',
        ]);
        $tag->update($tags);
        return back()->with("message","Tag has been updated");
    }


    public function destroy(Tags $tag)
    {
        $tag->delete();
        return back()->with('message', 'Tag was deleted');
    }
}
