<?php

namespace App\Repositories;

use App\Models\Post;

use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\SluggableRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PostRepository  implements PostRepositoryInterface, SluggableRepositoryInterface
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function all()
    {
        return $this->post->with('user:id,name,profile_photo_path')->approved()->paginate(2);
    }

    public function create(array $data)
    {
        return $this->post->create($data);
    }
    public function update(array $data, $slug)
    {
        return Auth::user()->posts()->whereSlug($slug)->update($data);
    }
    public function destroy($id)
    {
        return $this->post->destroy($id);
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
