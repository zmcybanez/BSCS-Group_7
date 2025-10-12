<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Aeroponics & Aquaponics'],
            ['name' => 'Hydroponics'],
            ['name' => 'Azolla Farming'],
            ['name' => 'Bangus and Tilapia Farming'],
            ['name' => 'Cacao Production'],
            ['name' => 'Catfish Production'],
            ['name' => 'Chicken and Layer Poultry'],
            ['name' => 'Dragon Fruit Farming'],
            ['name' => 'Duck Farming'],
            ['name' => 'Goat Production'],
            ['name' => 'Herbs and Spices'],
            ['name' => 'Hog and Cattle Raising'],
            ['name' => 'Horticulture'],
            ['name' => 'Landscaping'],
            ['name' => 'Mais Production'],
            ['name' => 'Moringa'],
            ['name' => 'Mushroom Farming'],
            ['name' => 'Rabbit Production'],
            ['name' => 'Shrimp Production'],
            ['name' => 'Vegetables and Fruits'],
            ['name' => 'Vermiculture'],
            ['name' => 'Vermicomposting'],
            ['name' => 'Equipment & Tools'],
            ['name' => 'Soil & Fertilizer'],
            ['name' => 'Weather & Climate'],
            ['name' => 'General Farming'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
