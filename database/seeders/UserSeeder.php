<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'avatar' => 'default.png',
                'banner' => 'default.png',
                'type' => 'admin'
            ],
            [
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => password_hash('5678', PASSWORD_DEFAULT),
                'avatar' => 'default.png',
                'banner' => 'default.png',
                'type' => 'user'
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => $user['password'],
                'avatar' => $user['avatar'],
                'banner' => $user['banner'],
                'type' => $user['type']
            ]);
        }
    }
}
