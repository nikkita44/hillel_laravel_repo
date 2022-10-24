<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Editorial_change;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user', 'tags'])->get();
        return view('admin/post/index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('admin/post/show', compact('post'));
    }

    public function commentAdding(Request $request, $id)
    {
        $request->validate([
            'body' => ['required', 'min: 5', 'max: 150'],
        ]);
        $post = Post::find($id);
        $editorial_change = new Editorial_change();
        $editorial_change->body = $request->input('body');
        $post->editorial_changes()->save($editorial_change);

        return redirect()->route('admin.post.show', ['id' => $post->id]);
    }

    public function create()
    {
        $this->authorize('create', Post::class);
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
            'tags' => ['required', 'exists:tags,id']
        ]);

        $userInfo = $request->all();
        $userInfo['user_id'] = Auth::id();
        $post = Post::create($userInfo);
        $post->tags()->attach($request->input('tags'));

        return redirect()->route('admin.post');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $this->authorize('update', $post);
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
            'tags' => ['required', 'exists:tags,id']
        ]);

        $userInfo = $request->all();
        $userInfo['user_id'] = Auth::id();
        $post->update($userInfo);
        $post->tags()->sync($request->input('tags'));

        return redirect()->route('admin.post');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $this->authorize('delete', $post);
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.post');
    }
}
