<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faqs')->insert([
            'faq_id' => 1,
            'faq_name' => 'Bagaimana cara memulai bekerja sama dengan Harsyad Teknologi?',
            'faq_description' => 'Untuk memulai, Anda bisa menghubungi kami melalui form Free Consultation di situs web kami. Tim kami akan memberikan kabar dan menjadwalkan konsultasi awal untuk membahas kebutuhan proyek Anda dan menyediakan solusi yang sesuai.',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('faqs')->insert([
            'faq_id' => 2,
            'faq_name' => 'Apa yang membedakan Harsyad Teknologi dari perusahaan teknologi lainnya?',
            'faq_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque suscipit est lorem, ultricies accumsan lacus pulvinar non. In tincidunt quis ante sed varius. Ut id ex a leo sollicitudin rhoncus. ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
