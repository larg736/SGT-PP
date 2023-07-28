<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DepartmentUser;

class DepartmentUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departmentUsers = [
            [
                'department_id' => 1,
        	    'user_id' => 2,
        	    'level_id' => 1,
            ],
            [
                'department_id' => 1,
        	    'user_id' => 4,
        	    'level_id' => 2,
            ],
        ];
    
        DepartmentUser::insert($departmentUsers);
    }
}
