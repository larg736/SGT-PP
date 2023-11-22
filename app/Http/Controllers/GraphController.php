<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{
    public function filter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date != null && $end_date != null) {
            $demands = DB::table('departments')
                ->select('departments.name as department', DB::raw('count(demands.id) as demands_count'))
                ->leftJoin('demands', 'departments.id', '=', 'demands.department_id')
                ->whereBetween('demands.created_at', [$start_date, $end_date])
                ->groupBy('departments.name')
                ->get();  

            $labels = $demands->pluck('department');
            $data = $demands->pluck('demands_count');

        } else {
            $demands = DB::table('departments')
                ->select('departments.name as department', DB::raw('count(demands.id) as demands_count'))
                ->leftJoin('demands', 'departments.id', '=', 'demands.department_id')
                ->groupBy('departments.name')
                ->get();  

            $labels = $demands->pluck('department');
            $data = $demands->pluck('demands_count');
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    
    }

    public function graphusers(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $users = DB::table('roles')
            ->select('roles.title as rol', DB::raw('count(role_user.role_id) as roles_count'))
            ->leftJoin('role_user', 'roles.id', '=', 'role_user.role_id')
            ->groupBy('roles.title')
            ->get(); 

            $labels = $users->pluck('rol');
            $data = $users->pluck('roles_count');

            return response()->json([
                'labels' => $labels,
                'data' => $data
            ]);
    }
}