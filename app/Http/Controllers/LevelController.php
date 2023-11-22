<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;


class LevelController extends Controller
{
    public function byDepartment($id)
    {
        return Level::where('department_id', $id)->get();
    }

    public function edit($id)
    {
        abort_if(Gate::denies('level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $level = Level::findOrFail($id);
        return view('levels.edit', compact('level'));
    }

    public function store(StoreLevelRequest $request)
    {
        $department_id = $request->input('department_id');
    	$name = $request->input('name');
		$levels = Level::where('department_id', $department_id)->where('name', $name)->withTrashed()->first();
        if($levels)
            return back()->with(['title' => 'El Nombre ingresado ya pertenece a un Nivel', 'icon' => 'error']);

        $levels = Level::create($request->validated());
        return back()->with('enviado','ok');
    }

    public function update(UpdateLevelRequest $request, $id)
    {
        $level = Level::find($id);
        $department_id = $request->input('department_id');
        $level->name = $request->input('name');
        $exists = Level::where('department_id', $department_id)->where('name', $level->name)->where('id', '<>', $level->id)->withTrashed()->first();
        if ($exists) {
            return back()->with(['title' => 'El Nombre ingresado ya pertenece a un Nivel', 'icon' => 'error']);
        }
        $level->update($request->validated());
        return back()->with('enviado','ok');
    }

    public function destroy(Level $level)
    {
        abort_if(Gate::denies('level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $level->delete();
        return back()->with('enviado','ok');
    }

    public function restore($id)
    {
        Level::where('id', $id)->withTrashed()->restore();
        return back()->with('enviado','ok');
    }

}
