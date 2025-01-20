<?php

namespace App\Services;

use App\Helpers\Slug;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\RepositoryInterface;

class PostService
{
    protected $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->all();
    }

    public function createPost(array $data)
    {
        if (isset($data['image'])) {
            $file = $data['image'];
            $fileName = time() . $file->getClientOriginalName();
            $file->storeAs('public/images/', $fileName);
        }
        $data["user_id"] = auth()->id();
        return $this->postRepository->create($data + ['image_path' => $fileName ?? 'default.jpg']);
    }

    public function getPost($slug)
    {
        return $this->postRepository->show($slug);
    }
    public function findPost($id)
    {
        return $this->postRepository->find($id);
    }
    public function updatePost(array $data, $slug)
    {
        $data['slug'] = Slug::uniqueSlug($data['title'], 'posts');
        $data['category_id'] = $data['category_id'];

        if (isset($data['image'])) {
            $file = $data['image'];
            $filename = time() . $file->getClientOriginalName();
            $file->storeAs('public/images/', $filename);
        }
        $data['user_id'] = auth()->id();
    }

    public function deletePost($id)
    {
        return $this->postRepository->delete($id);
    }
    public function getByCategory($categoryId)
    {
        return $this->postRepository->getByCategory($categoryId);
    }
    public function search($query)
    {
        return $this->postRepository->search($query);
    }
}
