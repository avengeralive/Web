<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['as'=>'admin.', 'prefix' => 'admin'], function(){
	Route::get('', 'AdminController@index')->name('dashboard');
	Route::post('categories', 'AdminController@saveCategory')->name('categories.submit');
	Route::get('categories', 'AdminController@categories')->name('categories');
	Route::get('categories/{category_id}', 'AdminController@editCategory')->where('category_id', '[0-9]+')->name('categories.id');
	Route::get('categories/add', 'AdminController@addCategory')->name('categories.add');
	
	Route::post('attributes', 'AdminController@saveAttribute')->name('attributes.submit');
	Route::get('attributes', 'AdminController@attributes')->name('attributes');
	Route::get('attributes/{attributes_id}', 'AdminController@editAttribute')->where('attributes_id', '[0-9]+')->name('attributes.id');
	Route::get('attributes/add', 'AdminController@addAttribute')->name('attributes.add');
	
	
	Route::post('bids', 'AdminController@saveBid')->name('bids.submit');
	Route::get('bids', 'AdminController@bids')->name('bids');
	
	Route::post('pages', 'AdminController@savePage')->name('pages.submit');
	Route::get('pages', 'AdminController@pages')->name('pages');
	Route::post('settings', 'AdminController@saveSettings')->name('settings.submit');
	Route::get('settings', 'AdminController@settings')->name('settings');
	Route::get('pages/{page_id}', 'AdminController@editPage')->where('page_id', '[0-9]+')->name('pages.id');
	
	
	Route::post('levels', 'AdminController@saveLevel')->name('levels.submit');
	Route::get('levels', 'AdminController@levels')->name('levels');
	Route::get('levels/{level_id}', 'AdminController@editLevel')->where('level_id', '[0-9]+')->name('levels.id');
	
	Route::post('investments', 'AdminController@saveInvestment')->name('investments.submit');
	Route::get('investments/{investment_id}', 'AdminController@editInvestment')->where('investment_id', '[0-9]+')->name('investments.id');
	Route::get('investments/add/{user_id}', 'AdminController@addInvestment')->where('user_id', '[0-9]+')->name('investments.add');
	
	
	Route::post('users', 'AdminController@saveUser')->name('users.submit');
	Route::get('users', 'AdminController@users')->name('users');
	Route::get('userSearch', 'AdminController@userSearch')->name('userSearch');
	Route::get('companies', 'AdminController@companies')->name('companies');
	Route::get('managers', 'AdminController@managers')->name('managers');
	Route::get('users/{user_id}', 'AdminController@editUser')->where('user_id', '[0-9]+')->name('users.id');
	Route::get('users/add', 'AdminController@addUser')->name('users.add');
	
	Route::post('products', 'AdminController@saveProduct')->name('products.submit');
	Route::get('products/{product_id}', 'AdminController@editProduct')->where('product_id', '[0-9]+')->name('products.id');
	Route::get('products/add', 'AdminController@addProduct')->name('products.add');
	Route::get('products', 'AdminController@products')->name('products');
});



Auth::routes();

Route::post('registerinv', 'Auth\RegisterController@registerinv');
Route::post('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('logout', 'HomeController@logout');
Route::get('congratulation', 'HomeController@congratulation');


Route::post('invest', 'HomeController@invest')->name('invest.ajax');
Route::post('productsOfCategory', 'HomeController@productsOfCategory')->name('productsOfCategory.ajax');
Route::post('get_product', 'HomeController@get_product')->name('getProduct.ajax');


Route::get('images/{image_id}', 'HomeController@image')->where('image_id', '[0-9]+')->name('images.id');
Route::get('docs/{doc_id}', 'HomeController@doc')->where('doc_id', '[0-9]+')->name('docs.id');
Route::get('', 'HomeController@index')->name('/');
Route::get('home', 'HomeController@index')->name('home');
// Route::get('registerinv', 'HomeController@registerinv')->name('registerinv');
Route::get('catalog', 'HomeController@catalog')->name('catalog')->middleware('auth');
Route::get('account', 'HomeController@account')->name('account')->middleware('auth');
Route::get('account/change', 'HomeController@change');
Route::post('account/change', 'HomeController@change');
Route::post('account', 'HomeController@account')->name('account.submit')->middleware('auth');

Route::get('calc', 'HomeController@calc')->name('calc')->middleware('auth');
Route::get('level', 'HomeController@level')->name('level')->middleware('auth');
Route::get('manager', 'HomeController@manager')->name('manager')->middleware('auth');


