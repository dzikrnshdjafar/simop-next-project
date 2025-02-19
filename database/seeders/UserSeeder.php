<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use App\Constants\UserGender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Insert users
        User::create([
            'uuid' => Str::uuid(),
            'name' => 'PJ Tata Usaha',
            'username' => 'pjtu',
            'email' => 'tatausaha@gmail.com',
            'gender' => UserGender::MALE,
            'phone' => '0814-3456-7891',
            'password' => Hash::make('pjtu'),
        ]);
        User::create([
            'uuid' => Str::uuid(),
            'name' => 'PJ Kerjasama',
            'username' => 'pjks',
            'email' => 'kerjasama@gmail.com',
            'gender' => UserGender::MALE,
            'phone' => '0815-3456-7891',
            'password' => Hash::make('pjks'),
        ]);
        User::create([
            'uuid' => Str::uuid(),
            'name' => 'PJ Program dan Perencanaan',
            'username' => 'pjpp',
            'email' => 'program@gmail.com',
            'gender' => UserGender::FEMALE,
            'phone' => '0816-3456-7891',
            'password' => Hash::make('pjpp'),
        ]);
    }
}
