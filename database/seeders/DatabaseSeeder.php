<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(ManagerSeeder::class);
        $this->call(DepartmentHeadSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PicSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(DocumentationSeeder::class);
    }
}
