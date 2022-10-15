<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCategoryController
{
    public function index()
    {
        $categories = Category::all();
        return view('admin/category/index', compact('categories'));
    }

    public function create()
    {
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
        $category->delete();

        return redirect()->route('admin.post');
    }
}

