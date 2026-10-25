<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {		
		$role_admin = Role::where('name', 'admin')->first();
		$role_investor  = Role::where('name', 'investor')->first();
		$role_company  = Role::where('name', 'company')->first();
		$role_manager  = Role::where('name', 'manager')->first();
		
		$admin = new User;
		$admin->name = 'Administrator Name';
		$admin->email = 'admin@admin.com';
        $admin->password = Hash::make('password');
		$admin->save();
		$admin->roles()->attach($role_admin);
		
		$manager1 = new User;
		$manager1->name = 'Manager Name 1';
		$manager1->email = 'manager1@manager.com';
		$manager1->phone = '+760080004020';
        $manager1->password = Hash::make('password');
		$manager1->save();
		$manager1->roles()->attach($role_manager);
		
		$manager2 = new User;
		$manager2->name = 'Manager Name 2';
		$manager2->email = 'manager2@manager.com';
		$manager2->phone = '+790080004040';
        $manager2->password = Hash::make('password');
		$manager2->save();
		$manager2->roles()->attach($role_manager);

		$investor = new User;
		$investor->name = 'Investor Name';
		$investor->email = 'investor@investor.com';
        $investor->password = Hash::make('password');
		$investor->manager()->associate($manager1);
		$investor->save();
		$investor->roles()->attach($role_investor);
		
		$company = new User;
		$company->name = 'Company Name';
		$company->email = 'company@company.com';
        $company->password = Hash::make('password');
		$company->save();
		$company->roles()->attach($role_company);
    }
}
