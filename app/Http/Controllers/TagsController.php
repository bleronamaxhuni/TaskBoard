<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    /**
     * Display a listing of tags for the authenticated user
     */
    public function index()
    {
        $currentuser = Auth::user();
        $tags = Tag::where('user_id', '=', $currentuser->id)->get();
        return view('tags.index', [
            'tags' => $tags,
            'projects'=>Project::all()
        ]);
    }

    /**
     * Store a new tag in the database
     */
    public function store(Request $request)
    {
        $tag = $request->validate([
            'name' => 'required|max:200',
            'color' => 'required|in:red,blue,orange,green,yellow',
        ]);

        $tag['user_id'] = Auth::user()->id;
        $tags = Tag::create($tag);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Tag has been created']);
        }

        return back()->with('message', 'Tag has been created');
    }

    /**
     * Show the form for editing an existing tag
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', [
        'tag' => $tag,
        'projects'=>Project::all()
    ]);
    }

    /**
     * Update an existing tag in the database
     */
    public function update(Request $request, Tag $tag)
    {
        $tags = $request->validate([
            'name' => 'required|max:200',
            'color' => 'required|in:red,blue,orange,green,yellow',
        ]);
        $tag->update($tags);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Tag has been created']);
        }
        return back()->with('message', 'Tag has been updated');
    }

    /**
     * Delete a tag from the database
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('message', 'Tag was deleted');
    }
}
