<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftar_satuan = ['pcs','unit','box','lusin','pack','botol','kilo','rim','meter'];
        for ($i = 1; $i <= 20; $i++) {
            Barang::create([
                'nama_barang' => "Barang Dummy ke-$i",
                'satuan' => Arr::random($daftar_satuan),
                'jumlah' => 0,
                'harga_beli' => rand(1000, 5000),
                'harga_jual' => rand(1000, 5000),
                'id_kategori' => Kategori::inRandomOrder()->first()->id_kategori,
            ]);
        }
    }
}
