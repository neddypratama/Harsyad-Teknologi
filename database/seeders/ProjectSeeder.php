<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            'project_id' => 1,
            'project_name' => 'Company Profile Mamina.id',
            'project_type' => 'Website',
            'project_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed viverra est. In hac habitasse platea dictumst. Donec mi tellus, lacinia sed est eu, tempus porta tellus. Proin eu auctor enim, id molestie magna. Maecenas fermentum augue urna, in lobortis magna blandit interdum. Phasellus eget dictum ex. Quisque ut tellus consequat, eleifend enim sed, venenatis libero.
            Suspendisse id eleifend nisi. Fusce eros felis, lobortis quis nisi mattis, sagittis varius magna. Vivamus auctor turpis est, vitae sollicitudin orci tempus sed. Donec pellentesque porttitor odio, nec fermentum enim tristique non. Cras auctor eleifend viverra. Nullam tincidunt finibus accumsan. Morbi ac erat velit. Maecenas eu lobortis lorem. Donec malesuada tortor nec lectus pretium, at commodo est ornare. Nulla commodo massa nec vehicula lobortis. Aenean in pulvinar nulla. Maecenas vel dignissim nisl, laoreet interdum eros. Aliquam erat volutpat.',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'project_id' => 2,
            'project_name' => 'Company Profile Mamina.id',
            'project_type' => 'Website',
            'project_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed viverra est. In hac habitasse platea dictumst. Donec mi tellus, lacinia sed est eu, tempus porta tellus. Proin eu auctor enim, id molestie magna. Maecenas fermentum augue urna, in lobortis magna blandit interdum. Phasellus eget dictum ex. Quisque ut tellus consequat, eleifend enim sed, venenatis libero.
            Suspendisse id eleifend nisi. Fusce eros felis, lobortis quis nisi mattis, sagittis varius magna. Vivamus auctor turpis est, vitae sollicitudin orci tempus sed. Donec pellentesque porttitor odio, nec fermentum enim tristique non. Cras auctor eleifend viverra. Nullam tincidunt finibus accumsan. Morbi ac erat velit. Maecenas eu lobortis lorem. Donec malesuada tortor nec lectus pretium, at commodo est ornare. Nulla commodo massa nec vehicula lobortis. Aenean in pulvinar nulla. Maecenas vel dignissim nisl, laoreet interdum eros. Aliquam erat volutpat.',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'project_id' => 3,
            'project_name' => 'Company Profile Mamina.id',
            'project_type' => 'Website',
            'project_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed viverra est. In hac habitasse platea dictumst. Donec mi tellus, lacinia sed est eu, tempus porta tellus. Proin eu auctor enim, id molestie magna. Maecenas fermentum augue urna, in lobortis magna blandit interdum. Phasellus eget dictum ex. Quisque ut tellus consequat, eleifend enim sed, venenatis libero.
            Suspendisse id eleifend nisi. Fusce eros felis, lobortis quis nisi mattis, sagittis varius magna. Vivamus auctor turpis est, vitae sollicitudin orci tempus sed. Donec pellentesque porttitor odio, nec fermentum enim tristique non. Cras auctor eleifend viverra. Nullam tincidunt finibus accumsan. Morbi ac erat velit. Maecenas eu lobortis lorem. Donec malesuada tortor nec lectus pretium, at commodo est ornare. Nulla commodo massa nec vehicula lobortis. Aenean in pulvinar nulla. Maecenas vel dignissim nisl, laoreet interdum eros. Aliquam erat volutpat.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
