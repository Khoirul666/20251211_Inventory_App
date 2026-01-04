<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Barang::create([
                'nama_barang' => "Barang Dummy ke-$i",
                'jumlah' => 0,
                'harga_beli' => rand(1000, 5000),
                'harga_jual' => rand(1000, 5000),
                'id_kategori' => Kategori::inRandomOrder()->first()->id_kategori,
            ]);
        }
    }
}
