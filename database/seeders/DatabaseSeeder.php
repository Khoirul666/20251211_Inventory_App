<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
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

        // Kategori::factory()->create([
        //     'nama_kategori' => 'Elektronik',
        // ]);

        $this->call([
            KategoriSeeder::class,
            BarangSeeder::class,
            SupplierSeeder::class,
            CustomerSeeder::class,
        ]);
    }
}
