<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settingExists = Setting::where('id', 1)->exists();

        if ($settingExists) {
            return;
        }

        Setting::create([
            'app_name' => 'Simop',
            'app_desc' => 'Sistem Informasi Monitoring dan Pelaporan BSIP Gorontalo',
            'report_header' => '<h4>LOREM IPSUM DOLOR SIT AMET <br> CONSECTUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR <br> INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA</h4>'
        ]);
    }
}
