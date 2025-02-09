<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);


    if($request->hasFile('image')){
        $image=$request['image'];
        $imageName=time() . "." . $image->getClientOriginalExtension();
        $image->move(public_path('categories_images'),$imageName);
         $validateData['image']=$imageName;
     }

        Category::create([
            'category' => $request->category,
            'image' => $imageName,
        ]);

        return redirect()->route('Categories.index')->with('success','category has been created successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $Category)
    {
        $Category->delete();
        return redirect()->route('Categories.index')->with('success','category has been deleted successfully');
    }
}
