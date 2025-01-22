<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function destroy($id);
}
