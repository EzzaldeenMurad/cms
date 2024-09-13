<?php

namespace App\Http\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;

class CommentComposer
{
    protected $comments;
    public function __construct(Comment $comments)
    {
        $this->comments = $comments;
    }
    public function compose(View $view)
    {
        $view->with('recent_comments', $this->comments::with('user', 'post:id')->take(8)->latest()->get());
    }
}
