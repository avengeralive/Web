<?php


use Illuminate\Database\Seeder;
use App\Level;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$level1 = Level::create(['name' => 'Новичок', 'summ' => 500000]);
		$level2 = Level::create(['name' => 'Любитель', 'summ' => 1000000 ]);
		$level3 = Level::create(['name' => 'Любитель+', 'summ' => 2500000 ]);
		$level4 = Level::create(['name' => 'Инвестор', 'summ' => 5000000 ]);
		$level5 = Level::create(['name' => 'Крутой инвестор', 'summ' => 10000000 ]);
		$level6 = Level::create(['name' => 'Самый заряженный', 'summ' => 30000000 ]);
		
		/*if ($image1) $category1->images()->attach($image1);
		if ($image7) $category1->images()->attach($image7);*/

    }
}
