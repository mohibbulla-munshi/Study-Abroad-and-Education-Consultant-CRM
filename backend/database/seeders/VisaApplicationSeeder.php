<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisaApplication;

class VisaApplicationSeeder extends Seeder
{
    public function run()
    {
        // Create 50 visa applications
        VisaApplication::factory()->count(50)->create();
    }
}
