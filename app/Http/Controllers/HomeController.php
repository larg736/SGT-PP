<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Demand;
use App\Models\DepartmentUser;
use App\Models\Department;


class HomeController extends Controller
{ 

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
        $this->authenticated();

        $user = auth()->user();
        $selected_department_id = $user->selected_department_id;
            if ($selected_department_id) {
                if ($user->is_clerk){
                    $my_demands = Demand::where('department_id', $selected_department_id)->where('clerk_id', $user->id)->get();
                    $departmentUser = DepartmentUser::where('department_id', $selected_department_id)->where('user_id', $user->id)->first();
                    
                    if($departmentUser){
                        $pending_demands = Demand::where('clerk_id', NULL)->where('level_id', $departmentUser->level_id)->get();
                    }else{
                        $pending_demands = collect();
                    }
            
                    $demands_by_me = Demand::where('client_id', $user->id)->where('department_id', $selected_department_id)->get();
                

                    $categories = Category::where('department_id', auth()->user()->selected_department_id)->get();
                    return view('home')->with(compact('my_demands', 'pending_demands', 'demands_by_me', 'categories'));
                }
                $demands_by_me = Demand::where('client_id', $user->id)->where('department_id', $selected_department_id)->get();
                $categories = Category::where('department_id', auth()->user()->selected_department_id)->get();
                return view('home')->with(compact('demands_by_me', 'categories'));

            } else {
                $my_demands = [];
                $pending_demands = [];
                $demands_by_me = [];
                $categories = [];
            }
    
            return view('home')->with(compact('my_demands', 'pending_demands', 'demands_by_me', 'categories'));
    }

    public function selectDepartment($id)
    {
        $user = auth()->user();
        $user->selected_department_id = $id;
        $user->save();
        return back();
    }

    protected function authenticated()
    {
        $user = auth()->user();

        if (! $user->selected_department_id) {
            if ($user->is_admin || $user->is_client) {
                $user->selected_department_id = Department::first()->id;

            } else {
                $first_department = $user->departments->first();
                
                if ($first_department)
                    $user->selected_department_id = $first_department->id;                
            }
            $user->save();

            return view('home');
        }
        
    }

}
