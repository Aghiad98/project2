<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

class CommentController extends Controller
{
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
        /* return view('comments.create'); */
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, Post $post)
{
    $comment = new Comment();
    $comment->content = $request->content;
    $comment->user_id = auth()->id();
    $comment->post_id = $post->id; // يتم تعيين post_id تلقائيًا
    $comment->save();

    return redirect()->route('posts.show', $post->id)->with('success', 'comment  has been added successfuly');
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
    public function update(Request $request, Post $post, Comment $comment)
{
    // التحقق من أن المستخدم هو صاحب التعليق
    if (auth()->id() !== $comment->user_id) {
        abort(403, 'you can`t update this comment');
    }

    $request->validate([
        'content' => 'required|string|max:255',
    ]);

    $comment->update([
        'content' => $request->content,
    ]);

    return redirect()->route('posts.show', $post->id)->with('success', ' comment has been updated successfuly');
}

public function destroy(Post $post, Comment $comment)
{
    // التحقق من أن المستخدم هو صاحب التعليق
    if (auth()->id() !== $comment->user_id) {
        abort(403, 'غير مسموح لك بحذف هذا التعليق.');
    }

    $comment->delete();

    return redirect()->route('posts.show', $post->id)->with('success', 'comment has been deleted successfuly');
}
}
