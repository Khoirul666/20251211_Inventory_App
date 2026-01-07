<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'pemilik',
            'password' => Hash::make('pemilik1234'),
            'role' => 'pemilik',
        ]);
        User::create([
            'username' => 'karyawan',
            'password' => Hash::make('karyawan1234'),
            'role' => 'karyawan',
        ]);
    }
}
