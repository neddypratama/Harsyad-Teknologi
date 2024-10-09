<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teams')->insert([
            'team_id' => 1,
            'team_name' => 'Nirmala Rahayu',
            'role' => 'CEO',
            'team_image' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('teams')->insert([
            'team_id' => 2,
            'team_name' => 'Nirmala Rahayu',
            'role' => 'CTO',
            'team_image' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('teams')->insert([
            'team_id' => 3,
            'team_name' => 'Nirmala Rahayu',
            'role' => 'Fullstack Developer',
            'team_image' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('teams')->insert([
            'team_id' => 4,
            'team_name' => 'Nirmala Rahayu',
            'role' => 'Business Analyst',
            'team_image' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
