<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // جلب الفئات والعلامات


    // جلب المنشورات مع العلاقات (التعليقات، الفئات، والعلامات)
    $posts = Post::with('user', 'category', 'tags')->get();

    // إرسال البيانات إلى الـ view
    return view('posts.index', compact('posts'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all();
        $tags= Tag::all();
        return view('posts.create' ,compact('categories','tags'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
        $validateData=$request->validate([
            'title'=>'required|max:50',
            'content'=>'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id'
        ]);
        $post=new Post();
        $imageName = null;

        if($request->hasFile('image')){
            $image=$request['image'];
            $imageName=time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$imageName);
             $validateData['image']=$imageName;
         }

     $post->title = $request->title;
     $post->content = $request->content;
     $post->category_id = $request->category_id;
     $post->user_id = auth()->user()->id;
     $post->image=$imageName;
        $post->save();

     // ربط العلامات (tags) بالمنشور
     if ($request->has('tags')) {
        $tags = $request->tags; // هنا نحن نستخدم الـ tags كما هي من الـ request (مصفوفة من الـ IDs)
        $post->tags()->attach($tags); // استخدام علاقة many-to-many لإضافة العلامات
    }


        return redirect()->route('posts.index')->with("success","post has been added successfuly");
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
    /* $categories = Category::all();
    $tags = Tag::all();
    $comments= Comment::all(); */
    $post = Post::with('user', 'category', 'tags', 'comments.user')->find($post->id);
    if (!$post) {
        abort(404, 'Post not found');
    }
    return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'You can\'t edit this post.');
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'You can\'t update this post.');
        }

        $validateData=$request->validate([
            'title'=>'required|max:50',
            'content'=>'required|string',
            'image'=>'nullable|image',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id'
        ]);
        if($request->hasFile('image')){
            $image=$request['image'];
            $imageName=time() . "." . $image->getClientOriginalExtension();
            $post->image=$imageName;
            $image->move(public_path('images'),$imageName);
            $validateData['image']=$imageName;
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $validateData['image'] ?? $post->image,
        ]);
        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index')->with('success', 'The post has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'you can`t delete this post');
        }

        $post->delete();
        return redirect()->route('posts.index');
    }
}
