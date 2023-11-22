<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Category;
use App\Models\Department;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DepartmentsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('departments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('departments.create');
    }

    public function store(StoreDepartmentRequest $request)
    { 
        Department::create($request->validated());
        return redirect()->route('departments.index')->with('enviado','ok');
    }

    public function edit(Department $department)
    {
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = $department->categories;
        $categories = Category::where('department_id', $department->id)->withTrashed()->latest()->paginate(5);
        $levels = $department->levels;
        $levels = Level::where('department_id', $department->id)->withTrashed()->latest()->paginate(5);
        return view('departments.edit', compact('department', 'categories', 'levels'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
        return redirect()->route('departments.index')->with('enviado','ok');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('enviado','ok');
    }

    public function restore($id)
    {
        Department::where('id', $id)->withTrashed()->restore();
        return back()->with('enviado','ok');
    }

    public function prnpriview(){
        $departments = Department::withTrashed()->get();    
        return view('departments.print')->with('departments', $departments);
    }
}