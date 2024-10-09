<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('forms')->insert([
            'form_id' => 1,
            'form_name' => 'Admin Admin',
            'email' => 'admin@white.com',
            'no_telp' => '0862762738273',
            'form_description' => 'mantap',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
