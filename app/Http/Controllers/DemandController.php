<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Level;
use App\Models\Demand;
use App\Models\DepartmentUser;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class DemandController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
    }

    public function index(Request $request){
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $demands = Demand::withTrashed()->get();
        return view('demands.index', compact('demands'));
    }
    
    public function prnpriview(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if ($start_date != null && $end_date != null) {
            $demands = Demand::withTrashed()
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }else {
            $demands = Demand::withTrashed()->get();
        }
        return view('demands.demandsprint')->with('demands', $demands);
    }

    public function create(){
        $categories = Category::where('department_id', auth()->user()->selected_department_id)->get();
        $levels = Level::where('department_id', auth()->user()->selected_department_id)->get();
        return view('demands.create')->with(compact('categories', 'levels'));
    }

    public function store(Request $request){
        $this->validate($request, Demand::$rules, Demand::$messages);
        
        $demand = new Demand();

        if ($request->hasFile('photo')) {
            $this->validate($request, Demand::$rules, Demand::$messages);
            $path = $request->file('photo')->store('public/photos');
            $demand->url = $path;
        }
        $demand->category_id = $request->input('category_id') ?: null;
        $demand->severity = $request->input('severity');
        $demand->title = $request->input('title');
        $demand->description = $request->input('description');
        $demand->level_id = $request->input('level_id') ?: null;
        $demand->serial = $request->input('serial') ?: null;
        $user = auth()->user();
        $demand->client_id = $user->id;
        $demand->department_id = $user->selected_department_id;

        $demand->save();
        return redirect()->route('home.index')->with('enviado','ok');
    }

    public function show($id){
        $demand = Demand::findOrFail($id);
        $user = auth()->user();
        if (isset($demand->department->levels)) {
            $messages = $demand->messages;
            $levels = $demand->department->levels;
            $imagePath = $demand->url;
            return view('demands.show')->with(compact('demand', 'messages', 'levels', 'imagePath'));
        } else {
            return redirect()->back()->with(['title' => 'Tarea no encontrada', 'icon' => 'error']);
        }
    }

    public function details($id){
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $demand = Demand::findOrFail($id);
        $user = auth()->user();
        if (isset($demand->department->levels)) {
            $levels = $demand->department->levels;
            $imagePath = $demand->url;
            return view('demands.details')->with(compact('demand', 'levels', 'imagePath'));
        } else {
            return redirect()->back()->with(['title' => 'Tarea no encontrada', 'icon' => 'error']);
        }
    }

    public function edit($id)
    {
        $demand = Demand::findOrFail($id);
        $categories = $demand->department->categories;
        $levels = $demand->department->levels;
        return view('demands.edit')->with(compact('demand', 'categories', 'levels'));
    }

    public function update(Request $request, $id)
    {
        $demand = Demand::findOrFail($id);

        //Si se sube una nueva imagen validar y actualizar la demanda
        if ($request->hasFile('photo')) {
            $this->validate($request, Demand::$rules, Demand::$messages);
            $path = $request->file('photo')->store('public/photos');
            $demand->url = $path;
        }

        $demand->category_id = $request->input('category_id') ?: null;
        $demand->severity = $request->input('severity');
        $demand->title = $request->input('title');
        $demand->description = $request->input('description');
        $demand->serial = $request->input('serial') ?: null;

        if ($demand->clerk_id == auth()->user()->id){
            $demand->level_id = $request->input('level_id') ?: null;
            $demand->clerk_id = null;
        }

        $demand->save();    
        return redirect()->back()->with('enviado','ok');
    }

    public function destroy(Demand $demand)
    {   
        $demand->delete();
        return redirect()->route('home.index')->with('enviado','ok');
    }

    public function restore($id)
    {
        Demand::where('id', $id)->withTrashed()->restore();
        return redirect()->route('home.index')->with('enviado','ok');
    }

    public function take($id)
    {
        $user = auth()->user();

        if (! $user->is_clerk && !$user->is_admin)
            return back();

        $demand = Demand::findOrFail($id);

        $department_user = DepartmentUser::where('department_id', $demand->department_id)->where('user_id',$user->id)->first();

        if (! $department_user)
            return back();

        if ($department_user->level_id != $demand->level_id)
            return back(); 
        
        $demand->clerk_id = $user->id;
        $demand->save();

        return redirect()->route('home.index')->with('enviado','ok');
    }

    public function solve($id){

        $demand = Demand::findOrFail($id);

        if ($demand->client_id != auth()->user()->id){
            return back();
        }
        
        $demand->active = 0; //false
        $demand->save();

        return redirect()->route('home.index')->with('enviado','ok');
    }

    public function open($id){

        $demand = Demand::findOrFail($id);
        
        if ($demand->client_id != auth()->user()->id){
            return back();
        }
        
        $demand->active = 1; //true
        $demand->clerk_id = null;
        $demand->save();

        return redirect()->route('home.index')->with('enviado','ok');
    }

    public function getDemandasData()
    {
        $demands = DB::table('demand')
            ->select(DB::raw('COUNT(*) as total'), DB::raw('MONTH(created_at) as mes'))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        return $demands;
    }

    public function updateDemands(Request $request)
    {
    	$input = $request->all();
        
		if(!empty($input['inProgress']))
    	{
			foreach ($input['inProgress'] as $key => $value) {
				$key = $key + 1;
				Demand::where('id',$value)
						->update([
							'active'=> 1,
							'order'=>$key,
                            'clerk_id'=>auth()->user()->id,
						]);
			}
		}
        
		if(!empty($input['pending']))
        {
            foreach ($input['pending'] as $key => $value) {
                $key = $key + 1;
                Demand::where('id',$value)
                        ->update([
                            'active'=> 1,
                            'order'=>$key,
                            'clerk_id'=> null,
                        ]);
            }
        }

        if(!empty($input['done']))
    	{
			foreach ($input['done'] as $key => $value) {
				$key = $key + 1;
				Demand::where('id',$value)
						->update([
							'active'=> 0,
							'order'=>$key,
                            'clerk_id'=>auth()->user()->id,
						]);
			}
		}

    	return response()->json(['active'=>'success']);
    }

}