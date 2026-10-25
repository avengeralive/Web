<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
		// Role comes before User seeder here.
		$this->call(RoleTableSeeder::class);
		// User seeder will use the roles above created.
		$this->call(UserTableSeeder::class);
		$this->call(ImageTableSeeder::class);
		$this->call(CategoryTableSeeder::class);
		$this->call(ProductTableSeeder::class);
		$this->call(InvestmentTableSeeder::class);
		$this->call(PageTableSeeder::class);
		$this->call(LevelTableSeeder::class);
		$this->call(SettingsTableSeeder::class);
    }
}
