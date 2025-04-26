<?php

namespace Fateme\Category\Http\Controllers;
use App\Http\Controllers\Controller;
use Fateme\Category\Http\Requests\CategoryRequest;
use Fateme\Category\Models\Category;

class CategoryController  extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('Categories::index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
                'title'=>$request->title,
                'slug'=>$request->slug,
                'parent_id'=>$request->parent_id,
            ]);

            return back();
    }

    public function edit(Category $category)
    {
        $categories = Category::where('id','!=','$category->id')->get();
        return view('Categories::edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'parent_id'=>$request->parent_id,
        ]);

        return back();
    }
}
