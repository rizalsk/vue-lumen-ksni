<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ["id" => "IDN", "name" => "Indonesia"],
            ["id" => "BRA", "name" => "Brazil"],
            ["id" => "AGO", "name" => "Angola"]
        ];
        Country::insert($countries);
    }
}
