<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryService
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->all();
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data + ['slug' => $data['title']]);
    }
    public function deleteCategory($id)
    {
        return $this->categoryRepository->destroy($id);
    }
}
