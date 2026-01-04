<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            Supplier::create([
                'nama_supplier' => $faker->company(),
                'alamat' => $faker->address,
                'email' => $faker->unique()->companyEmail,
                'telepon' => $faker->phoneNumber,
            ]);
        }
    }
}
