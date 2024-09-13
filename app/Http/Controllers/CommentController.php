<?php

namespace App\Http\Controllers;

use App\Events\CommentNotification;
use App\Models\Alert;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public $comment;


    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
        $comment = $this->comment;
        $comment->body = $request->get('body');
        $comment->user()->associate($request->user());
        $comment->post_id = $request->get('post_id');
        $post = Post::find($request->get('post_id'));

        $post->comments()->save($comment);

        $notification = new Notification();
        $notification->user_id = $request->user()->id;
        $notification->post_id = $post->id;
        $notification->post_userId = $post->user_id;
        $notification->save();


        $data = [
            'post_title' => $post->title,
            'post' => $post,
            'user_name' => $request->user()->name,
            'user_image' => $request->user()->profile_photo_url
        ];
        event(new CommentNotification($data));
        if ($request->user()->id != $post->user_id) {
            $alert = Alert::where('user_id', $post->user_id)->first();
            $alert->alert++;
            $alert->save();
        }
        return back()->with('success', 'تم إضافة التعليق بنجاح');
    }
    public function replyStore(Request $request)
    {
        $this->validate($request, [
            'comment_body' => 'required',
        ]);
        $reply = $this->comment;
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $reply->post_id = $request->get('post_id');
        $post = Post::find($request->get('post_id'));

        $post->comments()->save($reply);
        return back()->with('success', 'تم إضافة الرد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = $this->comment::find($id);

        $comment->delete();

        return back()->with('success', 'تم حذف التعليق بنجاح');
    }
}
