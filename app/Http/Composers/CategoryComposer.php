<?php

namespace App\Http\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Post;

class CategoryComposer
{
    protected $categories;
    protected $postsNumber;
    public function __construct(Category $categories, Post $postsNumber)
    {
        $this->categories = $categories;
        $this->postsNumber = $postsNumber;
    }
    public function compose(View $view)
    {
        $view->with('categories', $this->categories->all())->with('postsNumber', $this->postsNumber->whereApproved(1)->count());
    }
}
