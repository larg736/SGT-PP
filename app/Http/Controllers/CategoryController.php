<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function edit($id)
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $department_id = $request->input('department_id');
    	$name = $request->input('name');
		$categories = Category::where('department_id', $department_id)->where('name', $name)->withTrashed()->first();
        if($categories)
            return back()->with(['title' => 'El Nombre ingresado ya pertenece a una Categoría', 'icon' => 'error']);

        $categories = Category::create($request->validated());
        return back()->with('enviado','ok');
    }

    public function destroy(Category $category)
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $category->delete();
        return back()->with('enviado','ok');
    }

    public function restore($id)
    {
        Category::where('id', $id)->withTrashed()->restore();
        return back()->with('enviado','ok');
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $department_id = $request->input('department_id');
        $category = Category::find($id);
        $category->name = $request->input('name');
        $exists = Category::where('department_id', $department_id)->where('name', $category->name)->where('id', '<>', $category->id)->withTrashed()->first();
        if ($exists) {
            return back()->with(['title' => 'El Nombre ingresado ya pertenece a una Categoría', 'icon' => 'error']);
        }
        $category->save();

        return back()->with('enviado','ok');
    }

}

    
