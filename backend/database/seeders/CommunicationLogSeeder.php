<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CommunicationLog;

class CommunicationLogSeeder extends Seeder
{
    public function run()
    {
        // Create 10 communication logs
        CommunicationLog::factory()->count(1000)->create();
    }
}
