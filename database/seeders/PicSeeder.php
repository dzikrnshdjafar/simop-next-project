<?php

namespace Database\Seeders;

use App\Models\Pic;
use Illuminate\Support\Str;
use App\Constants\UserGender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pic::create([
            'department' => 'Tata Usaha',
            'user_id' => '6',
        ]);
        Pic::create([
            'department' => 'Kerjasama',
            'user_id' => '7',
        ]);
        Pic::create([
            'department' => 'Program dan Perencanaan',
            'user_id' => '8',
        ]);
    }
}
