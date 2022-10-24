<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Editorial_change;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin/category/index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('admin/category/show', compact('category'));
    }

    public function commentAdding(Request $request, $id)
    {
        $request->validate([
            'body' => ['required', 'min: 5', 'max: 150'],
        ]);
        $category = Category::find($id);
        $editorial_change = new Editorial_change();
        $editorial_change->body = $request->input('body');
        $category->editorial_changes()->save($editorial_change);

        return redirect()->route('admin.category.show', ['id' => $category->id]);
    }

    public function create()
    {
        $this->authorize('create', Category::class);
        $category = new Category();

        return view('admin/category/adding_form', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'unique:categories,title'
            ],
            'slug' => ['required']
        ]);

        Category::create($request->all());

        return redirect()->route('admin.category');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $this->authorize('update', $category);

        return view('admin/category/updating_form', compact('category'));
    }

    public function update(Request $request)
    {
        $category_id = $request->input('id');
        $category = Category::find($category_id);

        $request->validate([
            'title' => [
                'required',
                Rule::unique('categories', 'title')->ignore($category->id)
            ],
            'slug' => ['required']
        ]);

        $category->update($request->all());

        return redirect()->route('admin.category');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $this->authorize('delete', $category);
        $category->delete();

        return redirect()->route('admin.post');
    }
}

