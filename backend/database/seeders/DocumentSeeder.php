<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    public function run()
    {
        // Create 50 documents
        Document::factory()->count(10)->create();
    }
}
