<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('feedback')->insert([
            'feedback_id' => 1,
            'feedback_name' => 'Nirmala Rahayu',
            'company_name' => 'Company Name',
            'feedback_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque suscipit est lorem, ultricies accumsan lacus pulvinar non. In tincidunt quis ante sed varius. Ut id ex a leo sollicitudin rhoncus. ',
            'rate' => '5',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('feedback')->insert([
            'feedback_id' => 2,
            'feedback_name' => 'Nirmala Rahayu',
            'company_name' => 'Company Name',
            'feedback_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque suscipit est lorem, ultricies accumsan lacus pulvinar non. In tincidunt quis ante sed varius. Ut id ex a leo sollicitudin rhoncus. ',
            'rate' => '4',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('feedback')->insert([
            'feedback_id' => 3,
            'feedback_name' => 'Nirmala Rahayu',
            'company_name' => 'Company Name',
            'feedback_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque suscipit est lorem, ultricies accumsan lacus pulvinar non. In tincidunt quis ante sed varius. Ut id ex a leo sollicitudin rhoncus. ',
            'rate' => '5',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('feedback')->insert([
            'feedback_id' => 4,
            'feedback_name' => 'Nirmala Rahayu',
            'company_name' => 'Company Name',
            'feedback_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque suscipit est lorem, ultricies accumsan lacus pulvinar non. In tincidunt quis ante sed varius. Ut id ex a leo sollicitudin rhoncus. ',
            'rate' => '5',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('feedback')->insert([
            'feedback_id' => 5,
            'feedback_name' => 'Nirmala Rahayu',
            'company_name' => 'Company Name',
            'feedback_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque suscipit est lorem, ultricies accumsan lacus pulvinar non. In tincidunt quis ante sed varius. Ut id ex a leo sollicitudin rhoncus. ',
            'rate' => '5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
