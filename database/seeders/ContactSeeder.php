<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            'contact_id' => 1,
            'contact_name' => 'Email',
            'contact_detail' => 'harsyad.Tech@harsyad.co.id',
            'contact_icon' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('contacts')->insert([
            'contact_id' => 2,
            'contact_name' => 'Instagram',
            'contact_detail' => 'harsyadTech.id',
            'contact_icon' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('contacts')->insert([
            'contact_id' => 3,
            'contact_name' => 'WhatsApp',
            'contact_detail' => '+6281233445566 (sit Amet)',
            'contact_icon' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
