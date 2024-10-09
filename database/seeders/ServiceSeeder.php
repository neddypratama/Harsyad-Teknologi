<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            'service_id' => 1,
            'service_name' => 'Website Development',
            'service_short' => 'Kami membangun website yang responsif dan berkinerja tinggi, dirancang untuk memberikan pengalaman pengguna yang optimal dan memenuhi kebutuhan bisnis Anda.',
            'service_description' => 'Di era digital saat ini, memiliki website yang kuat dan menarik adalah kunci untuk membangun kehadiran online yang efektif. Di Harsyad Teknologi, kami mengkhususkan diri dalam pengembangan website yang tidak hanya tampak profesional, tetapi juga berfungsi dengan lancar dan memberikan pengalaman pengguna yang optimal. Kami siap membantu Anda mewujudkan visi digital Anda dengan solusi yang disesuaikan untuk bisnis AndaKami membangun website yang responsif dan berkinerja tinggi, dirancang untuk memberikan pengalaman pengguna yang optimal dan memenuhi kebutuhan bisnis Anda.',
            'service_icon' => '',
            'service_image' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'service_id' => 2,
            'service_name' => 'Mobile Development',
            'service_short' => 'Kami menciptakan aplikasi mobile yang inovatif dan user-friendly, memastikan bisnis Anda selalu dalam genggaman pelanggan di mana pun mereka berada.',
            'service_description' => 'Di era digital saat ini, memiliki website yang kuat dan menarik adalah kunci untuk membangun kehadiran online yang efektif. Di Harsyad Teknologi, kami mengkhususkan diri dalam pengembangan website yang tidak hanya tampak profesional, tetapi juga berfungsi dengan lancar dan memberikan pengalaman pengguna yang optimal. Kami siap membantu Anda mewujudkan visi digital Anda dengan solusi yang disesuaikan untuk bisnis AndaKami membangun website yang responsif dan berkinerja tinggi, dirancang untuk memberikan pengalaman pengguna yang optimal dan memenuhi kebutuhan bisnis Anda.',
            'service_icon' => '',
            'service_image' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'service_id' => 3,
            'service_name' => 'Game Development',
            'service_short' => 'Kami mengembangkan game yang menarik dan berkualitas tinggi, menggabungkan desain kreatif dan teknologi canggih untuk memberikan pengalaman bermain yang mendalam dan menghibur bagi para pemain di berbagai platform.',
            'service_description' => 'Di dunia game yang terus berkembang, kreativitas dan teknologi berjalan beriringan untuk menciptakan pengalaman yang luar biasa bagi pemain. Di Harsyad Teknologi, kami mengkhususkan diri dalam pengembangan game yang tidak hanya menghibur, tetapi juga memukau secara visual dan memberikan pengalaman bermain yang tak terlupakan. Kami siap membantu Anda mewujudkan ide game Anda dengan solusi yang disesuaikan, kreatif, dan inovatif.',
            'service_icon' => '',
            'service_image' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('services')->insert([
            'service_id' => 4,
            'service_name' => 'Design Concept',
            'service_short' => 'Desain yang kuat adalah fondasi dari setiap proyek. Kami menghidupkan ide Anda dengan konsep desain yang estetis, fungsional, dan sesuai dengan identitas brand Anda.',
            'service_description' => 'Di Harsyad Teknologi, kami percaya bahwa setiap produk hebat dimulai dengan ide yang kuat dan desain konsep yang inovatif. Desain konsep bukan hanya tentang estetika; ini adalah langkah awal untuk membangun identitas visual yang kuat, menciptakan solusi yang fungsional, dan menghubungkan merek Anda dengan audiens yang tepat. Kami siap membantu Anda menghidupkan ide kreatif Anda melalui desain konsep yang menarik dan orisinal.',
            'service_icon' => '',
            'service_image' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
