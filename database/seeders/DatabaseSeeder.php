<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class, // Seed categories before products
            ProductSeeder::class,
            ProductRatingSeeder::class,
            BlogPostSeeder::class,
            CommentSeeder::class,
            AuctionSeeder::class,
            BidSeeder::class,
            PaymentSeeder::class,
            ShippingInfoSeeder::class,
            AddressSeeder::class, // Seed addresses after users
            MessageSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
