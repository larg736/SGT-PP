<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use App\Models\DepartmentUser;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $users = User::with('roles')->get();
        $roles = Role::pluck('title', 'id');
        
        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::pluck('title', 'id');
        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->roles()->sync($request->input('roles', []));
        $user->password = bcrypt($request->input('password'));

        return redirect()->route('users.index')->with('enviado','ok');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $departments = Department::all();
        $departments_user = DepartmentUser::where('user_id', $user->id)->withTrashed()->paginate(5);
        $roles = Role::pluck('title', 'id');
        $user->load('roles');
        
        return view('users.edit', compact('user', 'roles', 'departments', 'departments_user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->roles()->sync($request->input('roles', []));
        $password = $request->input('password');
    	if ($password)
    		$user->password = bcrypt($password);
    	$user->save();

        return redirect()->route('users.index')->with('enviado','ok');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->delete();
        return redirect()->route('users.index')->with('enviado','ok');
    }

    public function prnpriview(){
        $users = User::all();
        return view('users.print')->with('users', $users);
    }

    public function restore($id)
    {
        User::where('id', $id)->withTrashed()->restore();
        return back()->with('enviado','ok');
    }
}