<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class PostController
{
    public function index()
    {
        $posts = Post::all();

        return view('posts/index', compact( 'posts'));
    }

    public function author($id)
    {
        $author = User::find($id);
        $author_posts = $author->posts;

        return view('posts/author', compact( 'author', 'author_posts'));
    }

    public function category($id)
    {
        $category = Category::find($id);
        $category_posts = $category->posts;

        return view('posts/category', compact( 'category', 'category_posts'));
    }

    public function tag($id)
    {
        $tag = Tag::find($id);
        $tag_posts = $tag->posts;

        return view('posts/tag', compact( 'tag', 'tag_posts'));
    }

    public function author_category($id, $category_id)
    {
        $author = User::find($id);
        $category = Category::find($category_id);

        $posts = Post::whereHas('user', function ($user) use ($id) {
            $user->where('id', $id);
        })->where('category_id', $category_id)->get();

        return view('posts/author_category', compact( 'author', 'posts', 'category'));
    }

    public function author_category_tag($id, $category_id, $tag_id)
    {
        $author = User::find($id);
        $category = Category::find($category_id);
        $tag = Tag::find($tag_id);

        $posts = Post::whereHas('tags', function ($exact_tag) use ($tag_id) {
            $exact_tag->where('tag_id', $tag_id);
        })->where('user_id', $id)->where('category_id', $category_id)->get();

        return view('posts/author_category_tag', compact( 'author', 'posts', 'category', 'tag'));
    }

}
