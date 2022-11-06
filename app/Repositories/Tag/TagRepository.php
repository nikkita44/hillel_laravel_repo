<?php

namespace App\Repositories\Tag;

use App\Models\Tag;
use App\Repositories\BaseRepositoryInterface;

class TagRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return Tag::all();
    }

    public function find($id)
    {
        return Tag::find($id);
    }

    public function create(array $parameters)
    {
        return Tag::create($parameters);
    }

    public function update(array $parameters, int $id)
    {
        $tag = $this->find($id);
        $tag->update($parameters);
        return $tag;
    }

    public function delete(int $id)
    {
        $tag = $this->find($id);
        $tag->delete();
        return $tag;
    }

}
