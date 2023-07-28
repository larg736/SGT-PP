<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'name' => 'Nivel 1',
        	    'department_id' => 1,
            ],
            [
                'name' => 'Nivel 2',
        	    'department_id' => 1,
            ],
        ];

        Level::insert($levels);
    }
}
