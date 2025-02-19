<?php

namespace Database\Seeders;

use App\Constants\Department;
use App\Constants\UserGender;
use App\Models\DepartmentHead;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DepartmentHeadSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            (object) [
                'name' => 'Kepala Bidang Tata Usaha',
                'username' => 'kabidtatausaha',
                'email' => 'kabidtatausaha@gmail.com',
                'gender' => UserGender::MALE,
                'phone' => '0812-3455-7898',
                'password' => Hash::make('kabidtatausaha'),
                'department' => Department::TATA_USAHA
            ],
            (object) [
                'name' => 'Kepala Bidang Kerjasama',
                'username' => 'kabidkerjasama',
                'email' => 'kabidkerjasama@gmail.com',
                'gender' => UserGender::MALE,
                'phone' => '0812-3454-7899',
                'department' => Department::KERJASAMA
            ],
            (object) [
                'name' => 'Kepala Bidang Program dan Perencanaan',
                'username' => 'kabidperencanaan',
                'email' => 'kabidperencanaan@gmail.com',
                'gender' => UserGender::MALE,
                'phone' => '0812-3453-7890',
                'department' => Department::PERENCANAAN
            ]
        ];

        foreach ($users as $user) {
            $dataExists = User::where('username', $user->username)->exists();
            if (!$dataExists) {
                $createdUser = User::create([
                    'name' => $user->name,
                    'username' => $user->username,
                    'phone' => $user->phone,
                    'gender' => $user->gender,
                    'email' => $user->email,
                    'password' => Hash::make($user->username)
                ]);

                DepartmentHead::create([
                    'department' => $user->department,
                    'user_id' => $createdUser->id
                ]);
            }
        }
    }
}
