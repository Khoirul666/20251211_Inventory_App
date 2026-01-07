<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Kategori::factory()->create([
        //     'nama_kategori' => 'Elektronik',
        // ]);

        $this->call([
            KategoriSeeder::class,
            BarangSeeder::class,
            SupplierSeeder::class,
            CustomerSeeder::class,
            UserSeeder::class,
            TransaksionalSeeder::class,
        ]);
    }
}
