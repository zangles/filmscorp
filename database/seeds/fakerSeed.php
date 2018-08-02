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

        for ( $j = 0; $j < $productsCant; $j++) {
            $category = factory(Category::class)->create();

            $product = factory(Product::class)->create([
                'category_id' => $category->id
            ]);

            for ( $i = 0; $i < $propertyCant; $i++) {
                $property = factory(CategoryProperty::class)->create([
                    'category_id' => $category->id
                ]);

                $product->property()->attach($property->id, [
                    'value' => rand(1,5000)
                ]);
            }

        }
    }
}
