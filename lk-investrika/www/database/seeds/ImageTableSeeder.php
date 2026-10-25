<?php


use Illuminate\Database\Seeder;
use App\Image;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$image1 = new Image;
		$image1->data = \Storage::get('public/image/seeds/1.jpg');
		$image1->save();

		$image2 = new Image;
		$image2->data = \Storage::get('public/image/seeds/2.jpg');
		$image2->save();
		
		$image3 = new Image;
		$image3->data = \Storage::get('public/image/seeds/3.png');
		$image3->save();
		
		$image4 = new Image;
		$image4->data = \Storage::get('public/image/seeds/4.png');
		$image4->save();
		
		$image5 = new Image;
		$image5->data = \Storage::get('public/image/seeds/5.jpg');
		$image5->save();

    }
}
