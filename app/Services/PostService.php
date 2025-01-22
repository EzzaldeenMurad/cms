<?php

namespace App\Services;

use App\Helpers\Slug;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\PostRepository;

;

class PostService
{
    protected  $postRepository;
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

    public function getPostBySlug($slug)
    {
        return $this->postRepository->findBySlug($slug);
    }
    public function getPost($id)
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
        $this->postRepository->update($data + ['image_path' => $filename ?? 'default.jpg'], $slug);
    }

    public function deletePost($id)
    {
        return $this->postRepository->destroy($id);
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
