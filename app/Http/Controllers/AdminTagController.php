<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Editorial_change;
use App\Models\Tag;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Tag\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminTagController extends Controller
{
    public $repository;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;

    }

    public function index()
    {
        $tags = $this->repository->all();
        return view('admin/tag/index', compact('tags'));
    }

    public function show($id)
    {
        $tag = $this->repository->find($id);
        return view('admin/tag/show', compact('tag'));
    }

    public function commentAdding(Request $request, $id)
    {
        $request->validate([
            'body' => ['required', 'min: 5', 'max: 150'],
        ]);
        $tag = $this->repository->find($id);
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

        $this->repository->create($request->all());

        return redirect()->route('admin.tag');
    }

    public function edit($id)
    {
        $tag = $this->repository->find($id);
        $this->authorize('update', $tag);

        return view('admin/tag/updating_form', compact('tag'));
    }

    public function update(Request $request)
    {
        $tag_id = $request->input('id');
        $tag = $this->repository->find($tag_id);

        $request->validate([
            'title' => [
                'required',
                'min: 2',
                Rule::unique('tags', 'title')->ignore($tag->id)
            ],
            'slug' => ['required']
        ]);

        $this->repository->update($request->all(), $tag_id);

        return redirect()->route('admin.tag');
    }

    public function destroy($id)
    {
        $tag = $this->repository->find($id);;
        $this->authorize('delete', $tag);
        $this->repository->delete($id);

        return redirect()->route('admin.tag');
    }
}

