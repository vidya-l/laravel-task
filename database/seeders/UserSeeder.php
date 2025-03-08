<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'Vidya',
                'last_name' => 'l',
                'email' => 'lvidya66@gmail.com',
                'password' => Hash::make('password123'),
            ]
        ];

        DB::table('users')->insert($users);

        \App\Models\User::factory(10)->create(); 

    }
}
