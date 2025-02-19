<?php

namespace Database\Seeders;

use App\Models\Documentation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Documentation::create([
            'date' => '2025-02-10',
            'documentation' => 'tatausaha.png',
            'activity_id' => '1',
            'user_id' => '6',
        ]);
    }
}
