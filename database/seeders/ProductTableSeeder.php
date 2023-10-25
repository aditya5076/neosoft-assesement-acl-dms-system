<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'category_id' => rand(4, 10),
                'name' => $faker->name,
                'description' => $faker->sentence(3),
                'price' => $faker->numberBetween(1000, 10000),
                'image' => $faker->image(public_path('product-images'), 400, 300, 'people', false),
            ]);
        }
    }
}
