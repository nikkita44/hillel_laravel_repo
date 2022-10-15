<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminTagController
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin/tag/index', compact('tags'));
    }

    public function create()
    {
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
        $tag->delete();

        return redirect()->route('admin.tag');
    }
}

