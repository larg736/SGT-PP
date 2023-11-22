<?php

namespace App\Http\Controllers;

use App\Models\DepartmentUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;


class DepartmentUserController extends Controller
{
    public function store(Request $request)
    {
    	// El nivel pertenezca al proyecto.
    	// Asegurar que el proyecto exista.
    	// Asegurar que el nivel exista.
    	// Asegurar que el usuario exista.

    	$department_id = $request->input('department_id');
    	$user_id = $request->input('user_id');

		$department_user = DepartmentUser::where('department_id', $department_id)->where('user_id', $user_id)->withTrashed()->first();

		if ($department_user)
			return back()->with(['title' => 'El usuario ya pertenece a este Departamento', 'icon' => 'error']);

    	$department_user = new DepartmentUser();
    	$department_user->department_id = $department_id;
    	$department_user->user_id = $user_id;
    	$department_user->level_id = $request->input('level_id');
    	$department_user->save();

    	return back()->with('enviado','ok');
    }

	public function edit(User $user, $id, Request $request, Department $department)
	{
		$department_user = DepartmentUser::findOrFail($id);
		if (isset($department_user->department->levels)){
			$levels = $department_user->department->levels;
        	return view('departments_user.levels')->with(compact('department_user', 'levels'));
		}else {
            return redirect()->back()->with(['title' => 'Departamento no encontrada', 'icon' => 'error']);
        }
        
	}

    public function destroy($id)
    {
    	DepartmentUser::find($id)->delete();
    	return back()->with('enviado','ok');
    }

	public function restore($id)
    {
        DepartmentUser::where('id', $id)->withTrashed()->restore();
        return back()->with('enviado','ok');
    }

	public function update(Request $request, $id)
    {
    	$department_user = DepartmentUser::find($id);
		if (!$department_user)
			return back()->with(['title' => 'El usuario no pertenece a este Departamento', 'icon' => 'error']);
    	$department_user->level_id = $request->input('level_id') ?: null;
    	$department_user->save();
		return redirect()->back()->with('enviado','ok');
    }
}
