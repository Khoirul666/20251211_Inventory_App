<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            Customer::create([
                'nama_customer' => $faker->name,
                'alamat' => $faker->address,
                'email' => $faker->unique()->companyEmail,
                'telepon' => $faker->phoneNumber,
            ]);
        }
    }
}
