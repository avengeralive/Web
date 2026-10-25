<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Product;
use App\Image;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$category1 = Category::find(4);
		$category2 = Category::find(6);
		$category3 = Category::find(7);

		$productImage = Image::find(1);
		$product1 = Product::create(['name' => 'Продукт1', 'description' => 'Тут описание продукта1', 'percent' => 7, 'summ' => 10000000, 'minsumm' => 100000, 'time' => 12, 'image_id' => $productImage->id]);
		if ($productImage) $product1->images()->attach($productImage);

		$product1->categories()->syncWithoutDetaching($category2);
		$parent_category = Category::find($category2->parentCategory);
		if ($parent_category) $product1->categories()->syncWithoutDetaching($parent_category);
		
		$productImage = Image::find(2);		
		$product2 = Product::create(['name' => 'Продукт2', 'description' => 'Тут описание продукта2', 'percent' => 8, 'summ' => 100000000, 'minsumm' => 200000, 'time' => 36, 'image_id' => $productImage->id]);

		$product2->categories()->syncWithoutDetaching($category1);
		$parent_category = Category::find($category1->parentCategory);
		if ($parent_category) $product2->categories()->syncWithoutDetaching($parent_category);
		
		$product2->categories()->syncWithoutDetaching($category2);
		$parent_category = Category::find($category2->parentCategory);
		if ($parent_category) $product2->categories()->syncWithoutDetaching($parent_category);
		
		if ($productImage) $product2->images()->attach($productImage);
		
		$productImage = Image::find(3);
		$product3 = Product::create(['name' => 'Продукт3', 'description' => 'Тут описание продукта3', 'percent' => 9, 'summ' => 100000, 'minsumm' => 10000, 'time' => 6, 'image_id' => $productImage->id]);
		
		$product3->categories()->syncWithoutDetaching($category1);
		$parent_category = Category::find($category1->parentCategory);
		if ($parent_category) $product3->categories()->syncWithoutDetaching($parent_category);
		
		if ($productImage) $product3->images()->attach($productImage);
		
		
		$productImage = Image::find(3);
		$product4 = Product::create(['name' => 'Продукт4', 'description' => 'Тут описание продукта4', 'percent' => 10, 'summ' => 100000, 'minsumm' => 10000, 'time' => 9, 'image_id' => $productImage->id]);
		
		$product4->categories()->syncWithoutDetaching($category3);
		$parent_category = Category::find($category3->parentCategory);
		if ($parent_category) $product4->categories()->syncWithoutDetaching($parent_category);
		
		if ($productImage) $product4->images()->attach($productImage);
				

    }
}
