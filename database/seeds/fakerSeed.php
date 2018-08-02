<?php

use App\Category;
use App\CategoryProperty;
use App\Product;
use Illuminate\Database\Seeder;

class fakerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsCant = 50;
        $propertyCant = 10;

        $category = factory(Category::class, 30)->create();

        for ( $j = 0; $j < $productsCant; $j++) {

            $product = factory(Product::class)->create([
                'category_id' => Category::inRandomOrder()->first()->id
            ]);

            for ( $i = 0; $i < $propertyCant; $i++) {
                $property = factory(CategoryProperty::class)->create([
                    'category_id' => $product->category->id
                ]);

                $product->property()->attach($property->id, [
                    'value' => rand(1,5000)
                ]);
            }

            for ( $k = 0; $k < rand(1,5); $k++) {
                $quantity = rand(1,10);
                $sale = factory(\App\Sales::class)->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'amount' => $product->price * $quantity
                ]);
            }
        }



    }
}
