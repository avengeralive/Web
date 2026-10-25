<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Investment;
use App\Bid;
use App\Page;
use App\Product;
use App\Attribute;
use App\Image;
use App\Doc;
use App\Role;
use App\Category;
use App\Level;
use App\Settings;

//use Intervention\Image\ImageManagerStatic;


class AdminController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct() {
		$this->middleware(['auth','admin']);
	}
	
	public function index(Request $request) {
		return view('admin');
	}
	
	public function categories(Request $request) {
		$categories = Category::all();
		return view('admin.categories' , ['categories' => $categories] );
	}
	
	public function attributes(Request $request) {
		$attributes = Attribute::all();
		return view('admin.attributes' , ['attributes' => $attributes] );
	}
	
	public function users(Request $request) {
		$users = User::all();
		$users_res = array();
		foreach ($users as $user) {
			if ($user->hasRole('investor')) $users_res[] = $user;
		}
		return view('admin.users' , ['users' => $users_res, 'header' => 'Инвесторы'] );
	}

	
	public function userSearch(Request $request) {
		$users = User::where('name','like', '%'.$request->name.'%')->orWhere('phone',$request->name)->orWhere('email',$request->email)->get();
		$users_res = array();
		foreach ($users as $user) {
			if ($user->hasRole('investor')) $users_res[] = $user;
		}
		return view('admin.user_search' , ['users' => $users_res] );
	}
	
	public function companies(Request $request) {
		$users = User::all();
		$users_res = array();
		foreach ($users as $user) {
			if ($user->hasRole('company')) $users_res[] = $user;
		}
		return view('admin.users' , ['users' => $users_res, 'header' => 'Зарегистрировавшиеся компании'] );
	}
	
	public function managers(Request $request) {
		$users = User::all();
		$users_res = array();
		foreach ($users as $user) {
			if ($user->hasRole('manager')) $users_res[] = $user;
		}
		return view('admin.users' , ['users' => $users_res, 'header' => 'Менеджеры', 'add' => 'менеджера', 'delete' => 'менеджера'] );
	}
	
		
	public function bids(Request $request) {
		$bids = Bid::all();
		return view('admin.bids' , ['bids' => $bids] );
	}
	
	public function editUser($id) {
		$user = User::find($id);
		if ($user) return view('admin.user_edit', ['user' => $user]);
		else return redirect()->route('admin.users');
	}
	
	public function addUser() {
		return view('admin.user_add');
	}
	
	public function saveUser(Request $request) {
		// TODO transactions
		// file uploads as opencart?
		switch ($request->action)
		{
			case 'add':
				$user = new User;
				$user->name = $request->name;
				if ($request->phone) $user->phone = $request->phone;
				$user->email = $request->email;
				if ($request->work) $user->work = $request->work;
				if ($request->city) $user->city = $request->city;
				if ($request->post) $user->post = $request->post;
				if ($request->companyname) $user->companyname = $request->companyname;
				if ($request->investmentfrom) $user->investmentfrom = $request->investmentfrom;
				if ($request->investmentto) $user->investmentto = $request->investmentto;
				if ($request->before) $user->before = $request->before;
				if ($request->experience) $user->experience = $request->experience;
				if ($request->fool) $user->fool = true;
				if ($request->manager) {
					$manager = User::find($request->manager);
					if ($manager) $user->manager()->associate($manager);
					else $user->manager()->dissociate();
				}
				$user->password = Hash::make('password');
				$user->save();
				
				$role_manager  = Role::where('name', 'manager')->first();
				$user->roles()->attach($role_manager);
				break;
			case 'edit':
				$user = User::find($request->id);
				if ($user) {
					$user->name = $request->name;
					if ($request->phone) $user->phone = $request->phone;
					$user->email = $request->email;
					if ($request->work) $user->work = $request->work;
					if ($request->city) $user->city = $request->city;
					if ($request->post) $user->post = $request->post;
					if ($request->companyname) $user->companyname = $request->companyname;
					if ($request->investmentfrom) $user->investmentfrom = $request->investmentfrom;
					if ($request->investmentto) $user->investmentto = $request->investmentto;
					if ($request->before) $user->before = $request->before;
					if ($request->experience) $user->experience = $request->experience;
					if ($request->fool) $user->fool = true;
					else $user->fool = false;
					
					if ($user->hasRole('manager')) {
						if ($request->active) $user->active = true;
						else $user->active = false;
					}
					
					if ($request->manager) {
						$manager = User::find($request->manager);
						if ($manager) $user->manager()->associate($manager);
					}
					else $user->manager()->dissociate();
					$user->save();
				}
				break;
			case 'delete':
				// TODO отображение в dashboard
				// ищем пользователей слинкованных с этим менеджером и, если они есть выводим ошибку
				$user = User::find($request->id);
				if ($user) {
					if ($user->hasRole('manager')) {
						$linked_users = User::where('manager_id', $user->id)->get();
						if ($linked_users->count()) {
							return view('admin', ['users' => $linked_users]);
						}
						else {
							$user->roles()->detach();
							$user->delete();
						}
					}
				}
				break;

		}
		return redirect()->route('admin.dashboard');
	}

	public function editInvestment($id) {
		$investment = Investment::find($id);
		if ($investment) return view('admin.investment_edit', ['investment' => $investment]);
		else return redirect()->route('admin.users');
	}

	public function addInvestment($id) {
		$user = User::find($id);
		if ($user) return view('admin.investment_add', ['user' => $user]);
		else return redirect()->route('admin.users');
	}


	public function saveInvestment(Request $request) {
		// TODO transactions
		// file uploads as opencart?
		switch ($request->action)
		{
			case 'add':
				$user = User::find($request->id);
				$product = Product::find($request->product);
				if ($user&&$product) {
					$investment = new Investment;
					$investment->user()->associate($user);
					$investment->product()->associate($product);
					$investment->summ = $request->summ;
					$investment->time = $request->time;
					$investment->save();
					if ($request->doc) {
						foreach ($request->doc as $doc) {
							$data = file_get_contents($doc->path());
							$investmentDoc = Doc::where('data', $data)->first();
							if (!$investmentDoc) {
								$investmentDoc = new Doc;
								$investmentDoc->data = file_get_contents($doc->path());
								$investmentDoc->save();
							}
							$investment->docs()->attach($investmentDoc);
						}
					}
				}
				break;
			case 'edit':
				$investment = Investment::find($request->id);
				if ($investment) {
					$product = Product::find($request->product);
					if ($product) {
						$investment->product()->associate($product);						
						$investment->summ = $request->summ;
						$investment->time = $request->time;
						$investment->save();
						if ($request->docs) {
							foreach ($request->docs as $old_doc) {
								$doc = Doc::find($old_doc);
								if ($doc) {
									$investment->docs()->detach($doc);
								}
							}
						}
						// add new images

						if ($request->doc) {
							foreach ($request->doc as $doc) {
								$data = file_get_contents($doc->path());
								$investmentDoc = Doc::where('data', $data)->first();
								if (!$investmentDoc) {
									$investmentDoc = new Doc;
									$investmentDoc->data = file_get_contents($doc->path());
									$investmentDoc->save();
								}
								$investment->docs()->attach($investmentDoc);
							}
						}
					}
				}
				break;
			case 'delete':
				$investment = Investment::find($request->id);
				if ($investment) $investment->delete();
				break;

		}
		return redirect()->route('admin.dashboard');
	}
	

	public function products(Request $request) {
		$products = Product::all();
		return view('admin.products' , ['products' => $products] );
	}
	
	public function levels(Request $request) {
		$levels = Level::orderBy('summ')->get();
		return view('admin.levels' , ['levels' => $levels] );
	}
	
	public function editLevel($id) {
		$level = Level::find($id);
		if ($level) return view('admin.level_edit', ['level' => $level]);
		else return redirect()->route('admin.levels');
	}
	
	public function saveLevel(Request $request) {
		// TODO transactions
		// file uploads as opencart?
		switch ($request->action)
		{
			/*case 'add':
				$attribute = new Attribute;
				$attribute->name = $request->name;
				$attribute->save();
				break;*/
			case 'edit':
				$level = Level::find($request->id);
				if ($level) {
					$level->name = $request->name;
					$level->summ = $request->summ;
					$level->save();
				}
				break;
			/*case 'delete':
				// TODO
				break;*/

		}
		return redirect()->route('admin.levels');
	}
	
	
	public function editProduct($id) {
		$product = Product::find($id);
		if ($product) return view('admin.product_edit', ['product' => $product]);
		else return redirect()->route('admin.products');
	}
	
	public function addProduct() {
		return view('admin.product_add');
	}
	
	public function editCategory($id) {
		$category = Category::find($id);
		if ($category) return view('admin.category_edit', ['category' => $category]);
		else return redirect()->route('admin.categories');
	}

	public function addCategory() {
		return view('admin.category_add');
	}

	public function addAttribute() {
		return view('admin.attribute_add');
	}
	
	public function editAttribute($id) {
		$attribute = Attribute::find($id);
		if ($attribute) return view('admin.attribute_edit', ['attribute' => $attribute]);
		else return redirect()->route('admin.attributes');
	}

	
	public function saveAttribute(Request $request) {
		// TODO transactions
		// file uploads as opencart?
		switch ($request->action)
		{
			case 'add':
				$attribute = new Attribute;
				$attribute->name = $request->name;
				$attribute->save();
				break;
			case 'edit':
				$attribute = Attribute::find($request->id);
				if ($attribute) {
					$attribute->name = $request->name;
					$attribute->save();
				}
				break;
			case 'delete':
				// TODO
				$attribute = Attribute::find($request->id);
				if ($attribute) {
					$linked_products = \DB::table('attribute_product')->where('attribute_id', $attribute->id)->select('product_id')->distinct()->get();
					
					if ($linked_products->count()) {
						$products = array();
						foreach ($linked_products as $linked_product) {
							$products[] = Product::find($linked_product->product_id);
						}
						$attributes = Attribute::all();
						return view('admin.attributes', ['attributes' => $attributes, 'products' => $products]);
					}
					else $attribute->delete();
					/*try {
						$attribute->delete();
					} catch (QueryException $e) {
						dd($e);
					}*/
				}
				break;

		}
		return redirect()->route('admin.attributes');
	}
	

	public function pages(Request $request) {
		$pages = Page::all();
		return view('admin.pages' , ['pages' => $pages] );
	}
	
	public function settings(Request $request) {
		$settings = Settings::find(1);
		return view('admin.settings' , ['settings' => $settings] );
	}
	
	public function saveSettings(Request $request) {
		$settings = Settings::find(1);
		if ($settings) {
			$settings->companiescount = $request->companiescount;
			$settings->investorscount = $request->investorscount;
			$settings->percentfrom = $request->percentfrom;
			$settings->percentto = $request->percentto;
			if ($request->manual) $settings->manual = true;
			else $settings->manual = false;
			$settings->termsofuse = $request->termsofuse;
			$settings->personaldata = $request->personaldata;
			$settings->save();
		}
		return redirect()->route('admin.dashboard');
	}
	
	
	
	public function editPage($id) {
		$page = Page::find($id);
		if ($page) return view('admin.page_edit', ['page' => $page]);
		else return redirect()->route('admin.pages');
	}
	
	public function savePage(Request $request) {
		// TODO transactions
		// file uploads as opencart?
		switch ($request->action)
		{
			/*case 'add':
				$attribute = new Attribute;
				$attribute->name = $request->name;
				$attribute->save();
				break;*/
			case 'edit':
				$page = Page::find($request->id);
				if ($page) {
					$page->description = $request->description;
					$page->save();
				}
				break;
			/*case 'delete':
				// TODO
				break;*/

		}
		return redirect()->route('admin.pages');
	}
	
	
	public function saveBid(Request $request) {
		switch ($request->action)
		{
			case 'delete':
				$bid = Bid::find($request->id);
				if ($bid) {
					$bid->delete();
				}
				break;
		}
		return redirect()->route('admin.bids');
	}
	
	public function saveProduct(Request $request) {
		// TODO transactions
		// file uploads as opencart?
		switch ($request->action)
		{
			case 'add':
				//$category = Category::find($request->category);
				//if ($category){
					$product = new Product;
					//$product->category()->associate($category);
					$product->name = $request->name;
					$product->description = $request->description;
					$product->percent = $request->percent;
					$product->summ = $request->summ;
					$product->time = $request->time;
					$product->minsumm = $request->minsumm;
					$product->percent_type = $request->percent_type;
					
					$data = file_get_contents($request->logo->path());
					$productImage = Image::where('data', $data)->first();
					if (!$productImage) {
						$productImage = new Image;
						$productImage->data = file_get_contents($request->logo->path());
						$productImage->save();
					}
					$product->logo()->associate($productImage);
					
					$product->save();
					
					$product->categories()->detach();
					
					if ($request->category) {
						foreach ($request->category as $category) {
							$productCategory = Category::find($category);
							if ($productCategory) $product->categories()->syncWithoutDetaching($productCategory);
							$parent_category = Category::find($productCategory->parentCategory);
							if ($parent_category) $product->categories()->syncWithoutDetaching($parent_category);
						}
					}

					if ($request->image) {
						foreach ($request->image as $image) {
							$data = file_get_contents($image->path());
							$productImage = Image::where('data', $data)->first();
							if (!$productImage) {
								$productImage = new Image;
								$productImage->data = file_get_contents($image->path());
								$productImage->save();
							}
							$product->images()->attach($productImage);
						}
					}
					
					if ($request->attribute) {
						foreach ($request->attribute as $key => $attribute) {
							$product->attributes()->attach($key, [ 'value' => $attribute]);
						}
					}
				//}
				break;
			case 'edit':
				$product = Product::find($request->id);
				if ($product) {
					//dd($request->attributes);
					//$category = Category::find($request->category);
					//if ($category) {
						//$product->category()->associate($category);
						$product->name = $request->name;
						$product->description = $request->description;
						$product->percent = $request->percent;
						$product->summ = $request->summ;
						$product->time = $request->time;
						$product->minsumm = $request->minsumm;
						$product->percent_type = $request->percent_type;
						
						if ($request->logo) {
							$data = file_get_contents($request->logo->path());
							$productImage = Image::where('data', $data)->first();
							if (!$productImage) {
								$productImage = new Image;
								$productImage->data = file_get_contents($request->logo->path());
								$productImage->save();
							}
							$product->logo()->associate($productImage);
						}
						
						$product->save();
						
						$product->categories()->detach();

						if ($request->category) {
							foreach ($request->category as $category) {
								$productCategory = Category::find($category);
								if ($productCategory) $product->categories()->syncWithoutDetaching($productCategory);
								$parent_category = Category::find($productCategory->parentCategory);
								if ($parent_category) $product->categories()->syncWithoutDetaching($parent_category);
							}
						}

						// TODO!!
						$product->attributes()->detach();
						// add new attributes
						if ($request->attribute) {
							foreach ($request->attribute as $key => $attribute) {
								$product->attributes()->attach($key, [ 'value' => $attribute]);
							}
						}
						
						// check for images remove
						if ($request->images) {
							foreach ($request->images as $old_image) {
								$pic = Image::find($old_image);
								if ($pic) {
									$product->images()->detach($pic);
								}
							}
						}
						// add new images
						if ($request->image) {
							foreach ($request->image as $image) {
								$data = file_get_contents($image->path());
								$productImage = Image::where('data', $data)->first();
								if (!$productImage) {
									$productImage = new Image;
									$productImage->data = file_get_contents($image->path());
									$productImage->save();
								}
								$product->images()->attach($productImage);
							}
						}
					//}
				}
				break;
			case 'delete':
				$product = Product::find($request->id);
				if ($product) {
					
					$linked_investments = $product->investments;
					$linked_bids = $product->bids;
					if ($linked_investments->count()||$linked_bids->count()) {
						return view('admin', ['investments' => $linked_investments, 'bids' => $linked_bids]);
					}
					else {
						$product->images()->detach();
						$product->categories()->detach();
						$product->attributes()->detach();
						$product->delete();
					}
				}
				break;

		}
		return redirect()->route('admin.products');
	}
	
	
	public function saveCategory(Request $request) {
		// TODO transactions
		// file uploads as opencart?
		switch ($request->action)
		{
			case 'add':
				$category = new Category;
				//$product->category()->associate($category);
				$category->name = $request->name;
				$parent_category = Category::find($request->parentCategory);
				$category->description = $request->description;
				$category->parentCategory()->associate($parent_category);
				$category->save();
				if ($request->image) {
					foreach ($request->image as $image) {
						$data = file_get_contents($image->path());
						$categoryImage = Image::where('data', $data)->first();
						if (!$categoryImage) {
							$categoryImage = new Image;
							$categoryImage->data = file_get_contents($image->path());
							$categoryImage->save();
						}
						$category->images()->attach($categoryImage);
					}
				}
				break;
			case 'edit':
				$category = Category::find($request->id);
				if ($category) {
					//dd($request->attributes);
					$category->name = $request->name;
					$parent_category = Category::find($request->parentCategory);
					$category->parentCategory()->associate($parent_category);
					$category->description = $request->description;
					$category->save();
					// check for images remove
					if ($request->images) {
						foreach ($request->images as $old_image) {
							$pic = Image::find($old_image);
							if ($pic) {
								$category->images()->detach($pic);
							}
						}
					}
					// add new images
					if ($request->image) {
						foreach ($request->image as $image) {
							$data = file_get_contents($image->path());
							$categoryImage = Image::where('data', $data)->first();
							if (!$categoryImage) {
								$categoryImage = new Image;
								$categoryImage->data = file_get_contents($image->path());
								$categoryImage->save();
							}
							$category->images()->attach($categoryImage);
						}
					}
				}
				break;
			case 'delete':
				// check for orders with this excursions
				/*$order_excursions = OrderExcursions::where('excursion_id', $request->id)->get();
				$session_excursions = SessionExcursions::where('excursion_id', $request->id)->get();
				if ($order_excursions->count()||$session_excursions->count())	{
					$orders = array();
					$sessions = array();
					foreach ($order_excursions as $order_excursion) {
						$orders[] = Order::find($order_excursion->order_id);
					}
					foreach ($session_excursions as $session_excursion) {
						$sessions[] = Session::find($session_excursion->session_id)->id;
					}
					return view('admin.excursions', ['orders' => $orders, 'sessions' => $sessions]);
				}
				else {*/
					// TODO flush all sessions with this excursion in cart
					// for deleted event on Excursion
					/*Image::where('excursion_id', $request->id)->get()->each(function($image) {
						$image->delete();
						Storage::disk('public')->delete('images/'.$image->name, 'images/thumbs/'.$image->name);
					});*/
					
					// category can be linked with other category
					$category = Category::find($request->id);
					if ($category) {
						$linked_categories = Category::where('parent_category_id', $category->id)->get();
						if ( $linked_categories->count() ) {
							$categories_fail = array();
							foreach ($linked_categories as $linked_category) {
								$categories_fail[] = Category::find($linked_category->id);
							}
							$categories = Category::all();
							return view('admin.categories', [ 'categories_fail' => $categories_fail, 'categories' => $categories ]);
						}
						else {
							$category->images()->detach();
							$category->delete();
						}
					}
				/*}*/
				//not working
				//Excursion::where('id', $request->id)->delete();
				break;

		}
		return redirect()->route('admin.categories');
	}
}
