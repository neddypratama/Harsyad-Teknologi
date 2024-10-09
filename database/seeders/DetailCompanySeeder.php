<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_companies')->insert([
            'detail_id' => 1,
            'detail_logo' => '',
            'detail_name' => 'PT Harsyad Teknologi',
            'address' => 'Jl. Kapi Sraba Raya 12A 22, Desa Mangliawan, Kecamatan Pakis, Kab. Malang  Jawa Timur, 65164',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
