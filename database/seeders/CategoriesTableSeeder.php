<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sistemas',
                'department_id' => 1
            ],
            [
                'name' => 'Redes',
                'department_id' => 1
            ],
            [
                'name' => 'Soporte',
                'department_id' => 1
            ],
        ];

        Category::insert($categories);
    }
}
