<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function all()
    {
        $this->all();
    }
    public function create(array $data)
    {
        $this->create($data);
    }
    public function destroy($id)
    {
        $this->category->find($id)->delete();
    }
}
