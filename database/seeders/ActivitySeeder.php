<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Support\Str;
use App\Constants\UserGender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::create([
            'uuid' => Str::uuid(),
            'name' => 'Kegiatan Tata Usaha 1',
            'status' => 'Selesai',
            'place' => 'Sumber Ria',
            'date' => '2025-02-13',
            'attachment' => 'tatausaha1.docx',
            'pic_id' => '1',
        ]);
        Activity::create([
            'uuid' => Str::uuid(),
            'name' => 'Kegiatan Tata Usaha 2',
            'status' => 'Pending',
            'place' => 'Ruang Tata Usaha',
            'date' => '2025-03-14',
            'attachment' => 'tatausaha2.docx',
            'pic_id' => '1',
        ]);
        Activity::create([
            'uuid' => Str::uuid(),
            'name' => 'Kegiatan Tata Usaha 3',
            'status' => 'Pending',
            'place' => 'Ruang Rapat',
            'date' => '2025-04-15',
            'attachment' => 'tatausaha3.docx',
            'pic_id' => '1',
        ]);
    }
}
