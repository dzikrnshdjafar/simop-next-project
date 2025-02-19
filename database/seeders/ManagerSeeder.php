<?php

namespace Database\Seeders;

use App\Constants\UserGender;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    public function run(): void
    {
        $dataExists = User::where('username', 'kadis')->exists();

        if ($dataExists) {
            return;
        }

        $user = User::create([
            'name' => 'Kepala Dinas',
            'username' => 'kadis',
            'email' => 'kadis@gmail.com',
            'gender' => UserGender::MALE,
            'phone' => '0812-3456-7891',
            'password' => Hash::make('kadis')
        ]);

        Manager::create([
            'user_id' => $user->id
        ]);
    }
}
