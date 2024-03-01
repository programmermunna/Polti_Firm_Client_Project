<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('123456');
        $now = Carbon::now();

        User::insert([
            [
                'id'           => 1,
                'name'         => 'Admin',
                'email'        => 'admin@gmail.com',
                'phone_number' => '01713617913',
                'password'     => $password,
                'status'       => 1,
                'role'         => 'admin',
                'created_at'   => $now
            ],
            [
                'id'           => 2,
                'name'         => 'Super Admin',
                'email'        => 'superadmin@gmail.com',
                'phone_number' => '01613617913',
                'password'     => $password,
                'status'       => 1,
                'role'         => 'super-admin',
                'created_at'   => $now
            ]
        ]);
    }
}
