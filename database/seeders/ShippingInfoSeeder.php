<?php

namespace Database\Seeders;

use App\Models\ShippingInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingInfo::factory()->count(30)->create();
    }
}
