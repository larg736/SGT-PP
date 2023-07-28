<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function edit(Category $category)
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        return view('categories.edit', compact('category'));
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());
        return back()->with('alert', 'ok');
    }

    public function destroy(Category $category)
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $category->delete();
        return back()->with('eliminar','ok');
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category_id = $request->input('category_id');
        $category = Category::find($category_id);
        $category->name = $request->input('name');
        $category->update($request->validated());

        return back()->with('alert', 'ok');
    }

}

    
