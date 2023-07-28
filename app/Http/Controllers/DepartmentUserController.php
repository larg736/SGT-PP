<?php

namespace App\Http\Controllers;

use App\Models\DepartmentUser;
use Illuminate\Http\Request;

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

		$department_user = DepartmentUser::where('department_id', $department_id)->where('user_id', $user_id)->first();

		if ($department_user)
			return back()->with('notification', 'El usuario ya pertenece a este Departamento.');

    	$department_user = new DepartmentUser();
    	$department_user->department_id = $department_id;
    	$department_user->user_id = $user_id;
    	$department_user->level_id = $request->input('level_id');
    	$department_user->save();

    	return back()->with('alert', 'ok');
    }

    public function destroy($id)
    {
    	DepartmentUser::find($id)->delete();
    	return back()->with('eliminar', 'ok');
    }
}
