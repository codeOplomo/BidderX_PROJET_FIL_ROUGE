<?php

namespace Database\Seeders;

use App\Models\Bid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bid::factory()->count(100)->create();
    }
}
