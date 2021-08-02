<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departement;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departements = [
            [
                'name' => 'HR',
                'description' => 'Selecting job applicants',
                'slug' => 'hr',
            ],
            [
                'name' => 'Marketing',
                'description' => 'Do promotion',
                'slug' => 'marketing',
            ],
            
        ];

        foreach ($departements as $departement) {
            Departement::create($departement);
        }
    }
}
