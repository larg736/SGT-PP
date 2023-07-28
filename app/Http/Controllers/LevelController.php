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

    public function edit(Level $level)
    {
        abort_if(Gate::denies('level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        return view('levels.edit', compact('level'));
    }

    public function store(StoreLevelRequest $request)
    {
        Level::create($request->validated());
        return back()->with('alert', 'ok');
    }

    public function update(UpdateLevelRequest $request, Level $level)
    {
        
        $level_id = $request->input('level_id');
        $level = Level::find($level_id);
        $level->name = $request->input('name');
        $level->update($request->validated());
    
        return back()->with('alert', 'ok');
    }

    public function destroy(Level $level)
    {
        abort_if(Gate::denies('level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $level->delete();
        return back()->with('eliminar', 'ok');

    }
}
