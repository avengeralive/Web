<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$role_admin = new Role;
		$role_admin->name = 'admin';
		$role_admin->description = 'Администратор';
		$role_admin->save();
		$role_investor = new Role;
		$role_investor->name = 'investor';
		$role_investor->description = 'Инвестор';
		$role_investor->save();
		$role_company = new Role;
		$role_company->name = 'company';
		$role_company->description = 'Компания';
		$role_company->save();
		$role_company = new Role;
		$role_company->name = 'manager';
		$role_company->description = 'Менеджер';
		$role_company->save();
    }
}
