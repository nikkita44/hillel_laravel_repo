<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(array $parameters);

    public function update(array $parameters, int $id);

    public function delete(int $id);
}
