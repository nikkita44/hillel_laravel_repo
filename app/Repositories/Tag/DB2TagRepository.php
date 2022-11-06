<?php

namespace App\Repositories\Tag;

use App\Models\Tag;
use App\Repositories\BaseRepositoryInterface;

class DB2TagRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return Tag::qweall();
    }

    public function find($id)
    {
        return Tag::qwefind($id);
    }

    public function create(array $parameters)
    {
        return Tag::qwecreate($parameters);
    }

    public function update(array $parameters, int $id)
    {
        $tag = $this->qwefind($id);
        $tag->qweupdate($parameters);
        return $tag;
    }

    public function delete(int $id)
    {
        $tag = $this->qwefind($id);
        $tag->qqqdelete();
        return $tag;
    }

}
