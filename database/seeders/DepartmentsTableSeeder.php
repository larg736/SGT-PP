<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $departments = [
            [ 
                'name' => 'DTI',
        	    'description' => 'Departamento Tecnico de Informatica.',
            ],
        ];

        Department::insert($departments);
    }
}
