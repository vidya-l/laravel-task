<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Timesheet;
use Carbon\Carbon;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sampleTimesheets = [
            ['user_id' => 1, 'project_id' => 1, 'hours' => 5, 'date' => Carbon::create('2020', '03', '03')->format('Y-m-d'), 'task_name' => 'test 1'],
            ['user_id' => 2, 'project_id' => 2, 'hours' => 3, 'date' => Carbon::create('2020', '03', '04')->format('Y-m-d'), 'task_name' => 'test 2'],
            ['user_id' => 1, 'project_id' => 3, 'hours' => 4, 'date' => Carbon::create('2020', '03', '05')->format('Y-m-d'), 'task_name' => 'test 3'],
            ['user_id' => 3, 'project_id' => 1, 'hours' => 6, 'date' => Carbon::create('2020', '03', '06')->format('Y-m-d'), 'task_name' => 'test 4'],
            ['user_id' => 2, 'project_id' => 4, 'hours' => 2, 'date' => Carbon::create('2020', '03', '07')->format('Y-m-d'), 'task_name' => 'test 5'],
            ['user_id' => 3, 'project_id' => 2, 'hours' => 3, 'date' => Carbon::create('2020', '03', '08')->format('Y-m-d'), 'task_name' => 'test 6'],
        ];

        foreach ($sampleTimesheets as $timesheet) {
            Timesheet::create($timesheet);
        }
    }
}
