<?php

namespace App\Http\Controllers;

use App\Helpers\Slug;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;
    function __construct(PostService $postService)
    {
        $this->postService =  $postService;
        $this->middleware('verified')->only('create');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts =  $this->postService->getAllPosts();
        $title = 'جميع المنشورات';
        return view('index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $postRequest)
    {

        $data = $postRequest->all();
        $this->postService->createPost($data);
        return back()->with('success', 'تم إضافة المنشور بنجاح، سيظهر بعد أن يوافق عليه المسؤول');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = $this->postService->getPost($slug);
        // $comments = $post->comments->sortByDesc('created_at');
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = $this->postService->findPost($id);

        abort_unless(auth()->user()->can('edit-post', $post), 403);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $postRequest, $slug)
    {

        $data = $postRequest->validated();
        $this->postService->updatePost($data, $slug);

        return redirect(route('post.show', $data['slug']))->with('success', 'تم تعديل المنشور بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->postService->deletePost($id);

        return back()->with('success', 'تم حذف المنشور بنجاح');
    }

    public function search(Request $request)
    {
        $posts =  $this->postService->search($request->keyword);
        $title = "نتائج البحث عن: " . $request->keyword;
        return view('index', compact('posts', 'title'));
    }
    public function getByCategory($id)
    {
        $posts =  $this->postService->getByCategory($id);
        $title = "المنشورات العائدة لتصنيف: " . Category::find($id)->title;
        return view('index', compact('posts', 'title'));
    }
}
