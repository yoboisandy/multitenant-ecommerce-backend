<?php

namespace Database\Seeders;

use App\Models\StoreCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "General",
            "Fashion, Shoes & Accessories",
            "Beauty & Cosmetics",
            "Pharmacy & Medical Care",
            "Plants & Nursery",
            "Jwellery, Gold & Gems",
            "Mobile, Computers & Other Accessories",
            "Gym & Sports",
            "Hardware & Construction Tools",
            "Transportation, Taxi, Travel & Tourism",
            "Fruits & Vegetables",
            "Grocery",
            "Restaurants & Hotels",
            "Books & Stationery",
            "Bakery & Cake Shops",
            "Home Decoration & Electronic Appliances",
            "Meat & Fish",
            "Vehicle & Vehicle Accessories",
            "Local & Online Services",
            "Insurance & Finance Services",
            "Educational Institutions, Schools & Teachers",
        ];

        foreach ($categories as $category) {
            StoreCategory::updateOrCreate([
                'name' => $category,
            ]);
        }
    }
}
