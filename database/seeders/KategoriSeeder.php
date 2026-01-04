<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = ['Elektronik', 'Sembako', 'Otomotif', 'Atk', 'Makanan', 'Minuman', 'Kesehatan', 'Kecantikan'];
        foreach ($kategori as $key => $value) {
            Kategori::firstOrCreate([
                'nama_kategori' => $value,
            ]);
        }
    }
}
