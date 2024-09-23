<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lead;

class LeadSeeder extends Seeder
{
    public function run()
    {
        // Create 10 random leads
        Lead::factory()->count(10)->create();
    }
}
