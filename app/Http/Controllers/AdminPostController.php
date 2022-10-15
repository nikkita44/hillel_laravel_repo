<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController
{
    public function index()
    {
        $posts = Post::all();
        return view('admin/post/index', compact('posts'));
    }

    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();

        return view('admin/post/adding_form', compact( 'post', 'categories', 'tags', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'min: 2',
                'unique:posts,title'
            ],
            'body' => ['required', 'min: 7', 'max: 150'],
            'category_id' => ['required', 'exists:categories,id'],
            'user_id' => ['required', 'exists:users,id'],
            'tags' => ['required', 'exists:tags,id']
        ]);

        $post = Post::create($request->all());
        $post->tags()->attach($request->input('tags'));

        return redirect()->route('admin.post');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();

        return view('admin/post/updating_form', compact( 'post', 'categories', 'tags', 'users'));
    }

    public function update(Request $request)
    {
        $post_id = $request->input('id');
        $post = Post::find($post_id);

        $request->validate([
            'title' => [
                'required',
                'min: 2',
                Rule::unique('posts', 'title')->ignore($post->id)
            ],
            'body' => ['required', 'min: 7', 'max: 150'],
            'category_id' => ['required', 'exists:categories,id'],
            'user_id' => ['required', 'exists:users,id'],
            'tags' => ['required', 'exists:tags,id']
        ]);

        $post->update($request->all());
        $post->tags()->sync($request->input('tags'));

        return redirect()->route('admin.post');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.post');
    }
}
