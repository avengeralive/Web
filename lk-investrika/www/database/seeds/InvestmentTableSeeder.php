<?php


use Illuminate\Database\Seeder;
use App\Product;
use App\User;
use App\Investment;

class InvestmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$investor = User::find(4);
		$product1 = Product::find(1);
		$product2 = Product::find(2);
		$investment1 = Investment::create(['user_id' => $investor->id, 'product_id' => $product1->id, 'summ' => 1850000, 'time' => 12]);
		$investment2 = Investment::create(['user_id' => $investor->id, 'product_id' => $product2->id, 'summ' => 1500000, 'time' => 6]);
		

		
		/*if ($image1) $category1->images()->attach($image1);
		if ($image7) $category1->images()->attach($image7);*/

    }
}
