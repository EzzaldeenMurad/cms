<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index()
    {
        return view('admin.index')
            ->with('posts_count', Post::count())
            ->with('users_count', User::count())
            ->with('comments_count', Comment::count())
            ->with('categories_count', Category::count());
    }
}
