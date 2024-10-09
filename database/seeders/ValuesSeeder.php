<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('values')->insert([
            'values_id' => 1,
            'short_name' => 'H',
            'values_name' => 'Harmoni',
            'values_description' => "Membangun lingkungan kerja yang kolaboratif dan harmonis di antara tim dan dengan pelanggan.",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('values')->insert([
            'values_id' => 2,
            'short_name' => 'A',
            'values_name' => 'Adaptabilitas',
            'values_description' => "Fleksibel dalam merespons perubahan teknologi dan kebutuhan pasar.",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('values')->insert([
            'values_id' => 3,
            'short_name' => 'R',
            'values_name' => 'Responsibilitas',
            'values_description' => "Bertanggung jawab secara etis terhadap pelanggan, lingkungan, dan komunitas.",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('values')->insert([
            'values_id' => 4,
            'short_name' => 'S',
            'values_name' => 'Sinergi',
            'values_description' => "Mendorong kerja sama dan sinergi lintas departemen untuk mencapai tujuan bersama.",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('values')->insert([
            'values_id' => 5,
            'short_name' => 'Y',
            'values_name' => 'Yakin',
            'values_description' => "Percaya diri dalam menciptakan solusi inovatif dan menghadapi tantangan dengan optimisme.",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('values')->insert([
            'values_id' => 6,
            'short_name' => 'A',
            'values_name' => 'Akurasi',
            'values_description' => "Menekankan ketelitian dan presisi dalam pengembangan produk dan layanan.",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('values')->insert([
            'values_id' => 7,
            'short_name' => 'D',
            'values_name' => 'Dedikasi',
            'values_description' => "Berkomitmen untuk memberikan yang terbaik dan terus berusaha melampaui ekspektasi.",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
