<?php

namespace Fateme\Category\Http\Controllers;
use App\Http\Controllers\Controller;
use Fateme\Category\Http\Requests\CategoryRequest;
use Fateme\Category\Models\Category;
use Fateme\Category\Repositories\CategoryRepo;
use Responses\AjaxResponses;

class CategoryController  extends Controller
{
    public $repo;
    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->repo = $categoryRepo;
    }

    public function index()
    {
//        dd(auth()->user()->permissions);
        $this->authorize('manage', Category::class);
        $categories = $this->repo->all();
        return view('Categories::index', compact('categories'));

    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('manage', Category::class);
         $this->repo->store($request);
            return back();
    }

    public function edit($categoryId)
    {
        $this->authorize('manage', Category::class);
        $category = $this->repo->findById($categoryId);
        $categories = $this->repo->allExceptById($categoryId);
        return view('Categories::edit', compact('category', 'categories'));
    }

    public function update($categoryId, CategoryRequest $request)
    {
        $this->authorize('manage', Category::class);
        $this->repo->update($categoryId, $request);
        return back();
    }

    public function destroy($categoryId)
    {
        $this->authorize('manage', Category::class);
        $this->repo->delete($categoryId);
       return AjaxResponses::SuccessResponse();
    }
}
