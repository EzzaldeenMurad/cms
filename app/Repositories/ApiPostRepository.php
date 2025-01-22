<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class ApiPostRepository implements PostRepositoryInterface
{

    private $post;

        public function __construct(Post $post)
        {
            $this->post = $post;
        }
    public function all()
    {
        return Post::all();
    }
    public function create(array $data)
        {

        }
        public function update(array $data, $slug)
        {

        }
        public function destroy($id)
        {

        }

        public function findBySlug($slug)
        {
            return $this->post->whereSlug($slug)->firstOrFail();
        }
        public function find($id)
        {
            return $this->post->find($id);
        }
        public function getByCategory($categoryId)
        {
            return $this->post::with('user')->whereCategory_id($categoryId)->approved()->paginate(10);
        }
        public function search($query)
        {
            return $this->post::where('body', 'like', '%' . $query . '%')->with('user')->approved()->paginate(2);
        }


}
