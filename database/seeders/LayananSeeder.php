<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layanans')->insert([
            'layanan_id' => 1,
            'layanan_name' => 'Custom Website Development',
            'layanan_description' => 'Pengembangan website dari awal sesuai kebutuhan spesifik bisnis, mulai dari desain hingga implementasi fungsionalitas. Layanan ini mencakup website yang dirancang khusus untuk merefleksikan identitas brand dan memenuhi tujuan bisnis.',
            'service_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
