<?php


use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$category1 = Category::create(['name' => 'Действующий бизнес', 'description' => 'Описание']);//1
			$category11 = Category::create(['name' => 'Общепит', 'description' => 'Описание', 'parent_category_id' => $category1->id]);//2
		
		$category2 = Category::create(['name' => 'Стартап', 'description' => 'Описание']);//3
			$category22 = Category::create(['name' => 'IT-компании', 'description' => 'Описание', 'parent_category_id' => $category2->id]);//4
			$category23 = Category::create(['name' => 'Другие компании', 'description' => 'Описание', 'parent_category_id' => $category2->id]);//5
		
		$category3 = Category::create(['name' => 'Долевое участие', 'description' => 'Описание']);//6
			$category33 = Category::create(['name' => 'Другие компании', 'description' => 'Описание', 'parent_category_id' => $category3->id]);//7
		
		$category4 = Category::create(['name' => 'Продажа бизнеса', 'description' => 'Описание']);//8
			$category44 = Category::create(['name' => 'Недвижимость', 'description' => 'Описание', 'parent_category_id' => $category4->id]);//9
		
		$category5 = Category::create(['name' => 'Блокчейн', 'description' => 'Описание']);//10
			$category11 = Category::create(['name' => 'Другое', 'description' => 'Описание', 'parent_category_id' => $category5->id]);//11
		
		/*if ($image1) $category1->images()->attach($image1);
		if ($image7) $category1->images()->attach($image7);*/

    }
}
