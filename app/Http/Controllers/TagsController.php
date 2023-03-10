<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    public function index()
    {
        $currentuser = Auth::user();
        $tags = Tags::where('user_id', '=', $currentuser->id)->get();
        return view('tags.index', [
            'tags' => $tags,
            'projects'=>Projects::all()
        ]);
    }

    public function store(Request $request)
    {
        $tag = $request->validate([
            'name' => 'required|max:200',
        ]);

        $tag['user_id'] = Auth::user()->id;
        $tags = Tags::create($tag);

        return back()->with("message","Tag has been created");
    }

    public function edit(Tags $tag)
    {
        return view('tags.edit', [
        'tag' => $tag,
        'projects'=>Projects::all()
    ]);
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
