<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    public function index()
    {
        $currentuser = Auth::user();
        $tags = Tags::where('user_id','=',$currentuser->id)->get();
        return view('tags.index', ['tags' => $tags]);
    }

    public function store(Request $request)
    {
        $tag = $request->validate([
            'name' => 'required|max:200',
        ]);
        $user_id = Auth::user()->id;
        $tag['user_id'] = $user_id;
        $tags = Tags::create($tag);

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
