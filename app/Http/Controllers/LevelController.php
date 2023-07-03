<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;


class LevelController extends Controller
{
    public function byDeparment($id)
    {
        return Level::where('department_id', $id)->get();
    }

    public function store(StoreLevelRequest $request)
    {
        Level::create($request->validated());

        /* return redirect()->route('levels.index'); */
        return back();
    }

    public function update(UpdateLevelRequest $request, Level $level)
    {
        $level->update($request->validated());

        /* return redirect()->route('levels.index'); */
        return back();
    }

    public function destroy(Level $level)
    {
        abort_if(Gate::denies('level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $level->delete();
        return back();

        /* return redirect()->route('levels.index'); */
    }
}
