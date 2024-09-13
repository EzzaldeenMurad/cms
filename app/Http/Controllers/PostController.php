<?php

namespace App\Http\Controllers;

use App\Helpers\Slug;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $post;
    function __construct(Post $post)
    {
        $this->post =  $post;
        $this->middleware('verified')->only('create');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->post::with('user:id,name,profile_photo_path')->approved()->paginate(2);
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',

        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . $file->getClientOriginalName();
            $file->storeAs('public/images/', $fileName);
        }
        $request->user()->posts()->create($request->all() + ['image_path' => $fileName ?? 'default.jpg'] + ['slug' => $request->title]);
        return back()->with('success', 'تم إضافة المنشور بنجاح، سيظهر بعد أن يوافق عليه المسؤول');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = $this->post::where('slug', $slug)->first();
        // $comments = $post->comments->sortByDesc('created_at');
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = $this->post::find($id);

        abort_unless(auth()->user()->can('edit-post', $post), 403);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $data = $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $data['slug'] = Slug::uniqueSlug($request->title, 'posts');
        $data['category_id'] = $request->category_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $file->storeAs('public/images/', $filename);
        }

        $request->user()->posts()->where('slug', $slug)->update($data + ['image_path' => $filename ?? 'default.jpg']);

        return redirect(route('post.show', $data['slug']))->with('success', 'تم تعديل المنشور بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = $this->post::find($id);

        $post->delete();

        return back()->with('success', 'تم حذف المنشور بنجاح');
    }

    public function search(Request $request)
    {
        $posts = $this->post::where('body', 'like', '%' . $request->keyword . '%')->with('user')->approved()->paginate(2);
        $title = "نتائج البحث عن: " . $request->keyword;
        return view('index', compact('posts', 'title'));
    }
    public function getByCategory($id)
    {
        $posts = $this->post::with('user')->whereCategory_id($id)->approved()->paginate(10);
        $title = "المنشورات العائدة لتصنيف: " . Category::find($id)->title;
        return view('index', compact('posts', 'title'));
    }
}
