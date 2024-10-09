<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisiMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('visi_misis')->insert([
            'visimisi_id' => 1,
            'visimisi_type' => 'Visi',
            'visimisi_description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('visi_misis')->insert([
            'visimisi_id' => 2,
            'visimisi_type' => 'Misi',
            'visimisi_description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ultrices ullamcorper risus et condimentum. Fusce purus nunc.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
