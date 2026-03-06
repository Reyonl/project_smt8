<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// You need to import your model here:
use App\Models\Package; 

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::create([
            'name' => 'Basic Website',
            'description' => 'Landing Page',
            'price' => 500000
        ]);

        Package::create([
            'name' => 'Company Profile',
            'description' => 'Website company profile',
            'price' => 1500000
        ]);

        Package::create([
            'name' => 'Website + Admin Panel',
            'description' => 'Website lengkap dengan dashboard',
            'price' => 3000000
        ]);
    }
}