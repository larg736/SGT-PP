<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Demand;

class DemandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demands = [
            [
                'title' => 'Primera Solicitud',
                'description' => 'Lo que ocurre es que se encontró un problema en la página y esta se cerró.',
                'severity' => 'N',
                'category_id' => 2,
        	    'department_id' => 1,
        	    'level_id' => 1,
        	    'client_id' => 3,
        	    'clerk_id' => null,
                'created_at'=> '2023-11-03 01:14:49'
            ],
            [
                'title' => 'Segunda Solicitud',
                'description' => 'Lo que ocurre es que se encontró un problema en la página y esta se cerró.',
                'severity' => 'M',
                'category_id' => 2,
        	    'department_id' => 1,
        	    'level_id' => 1,
        	    'client_id' => 3,
        	    'clerk_id' => null,
                'created_at'=> '2023-11-03 00:14:49'
            ],
        
        ];
        Demand::insert($demands);
    }
}
