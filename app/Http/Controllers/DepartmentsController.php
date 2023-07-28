<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DepartmentsController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $departments = Department::withTrashed()->get();

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('departments.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()->route('departments.index')->with('alert', 'ok');
    }

    public function edit(Department $department)
    {
        abort_if(Gate::denies('department_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = $department->categories;
        $levels = $department->levels;
        return view('departments.edit', compact('department', 'categories', 'levels'));
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()->route('departments.index')->with('alert', 'ok');
    }

    public function destroy(Department $department)
    {
        /* Department::find($department)->delete(); */

        $department->delete();

        return redirect()->route('departments.index')->with('eliminar','ok');
    }

    public function restore($id)
    {
        /* Department::withTrashed()->find($id)->restore(); */

        Department::where('id', $id)->withTrashed()->restore();

        return back()->with('restore', 'ok');
    }
}
