<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UserSeeder::class]);
        $this->call([FagSeeder::class]);
        $this->call([ContactSeeder::class]);
        $this->call([DetailCompanySeeder::class]);
        $this->call([FeedbackSeeder::class]);
        $this->call([ProjectSeeder::class]);
        $this->call([GaleryPorjectSeeder::class]);
        $this->call([ServiceSeeder::class]);
        $this->call([LayananSeeder::class]);
        $this->call([FormSeeder::class]);
        $this->call([TeamSeeder::class]);
        $this->call([ValuesSeeder::class]);
        $this->call([VisiMisiSeeder::class]);
    }
}
