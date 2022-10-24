<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Editorial_change;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminTagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin/tag/index', compact('tags'));
    }

    public function show($id)
    {
        $tag = Tag::find($id);
        return view('admin/tag/show', compact('tag'));
    }

    public function commentAdding(Request $request, $id)
    {
        $request->validate([
            'body' => ['required', 'min: 5', 'max: 150'],
        ]);
        $tag = Tag::find($id);
        $editorial_change = new Editorial_change();
        $editorial_change->body = $request->input('body');
        $tag->editorial_changes()->save($editorial_change);

        return redirect()->route('admin.tag.show', ['id' => $tag->id]);
    }

    public function create()
    {
        $this->authorize('create', Tag::class);
        $tag = new Tag();

        return view('admin/tag/adding_form', compact('tag'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'min: 2',
                'unique:tags,title'
            ],
            'slug' => ['required']
        ]);

        Tag::create($request->all());

        return redirect()->route('admin.tag');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        $this->authorize('update', $tag);

        return view('admin/tag/updating_form', compact('tag'));
    }

    public function update(Request $request)
    {
        $tag_id = $request->input('id');
        $tag = Tag::find($tag_id);

        $request->validate([
            'title' => [
                'required',
                'min: 2',
                Rule::unique('tags', 'title')->ignore($tag->id)
            ],
            'slug' => ['required']
        ]);

        $tag->update($request->all());

        return redirect()->route('admin.tag');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $this->authorize('delete', $tag);
        $tag->delete();

        return redirect()->route('admin.tag');
    }
}

