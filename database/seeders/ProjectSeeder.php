<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            [
                'name' => 'Project 1',
                'status' => 'pending',
            ],
            [
                'name' => 'Project 2',
                'status' => 'completed',
            ],
            [
                'name' => 'Project 3',
                'status' => 'pending',
            ],
            [
                'name' => 'Project 4',
                'status' => 'in_progress',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
