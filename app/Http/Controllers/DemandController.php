<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demand;
use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\Category;

class DemandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $demand = Demand::findOrFail($id);
        $messages = $demand->messages;
        return view('demands.show')->with(compact('demand', 'messages'));
    }

    public function create(){
        $categories = Category::where('department_id', auth()->user()->selected_department_id)->get();
        return view('demands.create')->with(compact('categories'));
    }

    public function store(Request $request){

        $this->validate($request, Demand::$rules, Demand::$messages);
        
        $demand = new Demand();
        $demand->category_id = $request->input('category_id') ?: null;
        $demand->severity = $request->input('severity');
        $demand->title = $request->input('title');
        $demand->description = $request->input('description');
        
        $user = auth()->user();

        $demand->client_id = $user->id;
        $demand->department_id = $user->selected_department_id;
        $demand->level_id = Department::find($user->selected_department_id)->first_level_id;

        $demand->save();
        return back()->with('alert', 'ok'); 
    }

    public function take($id)
    {
        $user = auth()->user();

        if (! $user->is_clerk)
            return back();

        $demand = Demand::findOrFail($id);

        $department_user = DepartmentUser::where('department_id', $demand->department_id)
                                        ->where('user_id',$user->id)->first();

        if (! $department_user)
            return back();

        if ($department_user->level_id != $demand->level_id)
            return back(); 
        
        $demand->clerk_id = $user->id;
        $demand->save();

        return back()->with('atender', 'ok');
    }

    public function solve($id){

        $demand = Demand::findOrFail($id);

        if ($demand->client_id != auth()->user()->id){
            return back();
        }
        
        $demand->active = 0; //false
        $demand->save();

        return back();
    }

    public function open($id){

        $demand = Demand::findOrFail($id);
        
        if ($demand->client_id != auth()->user()->id){
            return back();
        }
        
        $demand->active = 1; //true
        $demand->save();

        return back();
    }

    public function nextLevel($id){

        $demand = Demand::findOrFail($id);
        $level_id = $demand->level_id;

        $department = $demand->department;
        $levels = $department->levels;

        $next_level_id = $this->getNextLevelId($level_id, $levels);
        
        if ($next_level_id) {
            $demand->level_id = $next_level_id;
            $demand->clerk_id = null;
            $demand->save();
            return back();
        }
        return back();
    }

    public function getNextLevelId($level_id, $levels){
        if (sizeof($levels) <= 1) {
            return null;
        }

        $position = -1;
        for ($i=0; $i<sizeof($levels)-1; $i++){
            if ($levels[$i]->id == $level_id) {
                $position = $i;
                break;
            }
        }

        if ($position == -1)
            return null;

        return $levels[$position+1]->id;
    }

    public function edit($id)
    {
        $demand = Demand::findOrFail($id);
        $categories = $demand->department->categories;
        return view('demands.edit')->with(compact('demand', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, Demand::$rules, Demand::$messages);

        $demand = Demand::findOrFail($id);

        $demand->category_id = $request->input('category_id') ?: null;
        $demand->severity = $request->input('severity');
        $demand->title = $request->input('title');
        $demand->description = $request->input('description');

        $demand->save();    
        return redirect("/demands/$id"); 
    }
}
