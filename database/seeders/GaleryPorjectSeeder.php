<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaleryPorjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('galery_projects')->insert([
            'galery_id' => 1,
            'galery_name' => '',
            'project_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('galery_projects')->insert([
            'galery_id' => 2,
            'galery_name' => '',
            'project_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('galery_projects')->insert([
            'galery_id' => 3,
            'galery_name' => '',
            'project_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('galery_projects')->insert([
            'galery_id' => 4,
            'galery_name' => '',
            'project_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
