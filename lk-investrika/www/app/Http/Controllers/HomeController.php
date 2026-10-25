<?php

namespace App\Http\Controllers;

use App\Notifications\AccountApproved;
use App\Level;
use App\Bid;
use App\User;
use App\Investment;
use App\Product;
use App\Invite;
use App\Category;
use App\Image;
use App\Doc;
use Illuminate\Http\Request;
use finfo;
use Auth;
use Illuminate\Support\Facades\Validator;
use Dotzero\LaravelAmoCrm\Facades\AmoCrm;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    
    public function registerinv(Request $request) {
        
        if (!$request->session()->has('invite')) {
            $invite = Invite::create([
                'phone' => $request->phone,
                'code' => rand(10000,99999)
            ]);

            $notify = new AccountApproved('test');
            $invite->notify($notify);
            $request->session()->put('invite', $invite);
        }
        
        // save Invite for session and check code from sms
        
        return view('registerinv', [ 'phone' => $request->phone ]);
    }
    
    public function invest(Request $request) {
        $response = array();
        $response['success'] = false;
        if (Auth::check()) {
            $user = Auth::user();
            //if ($user->hasRole('investor')) {
                // TODO bid
                $bid = new Bid;
                $product = Product::find($request->id);
                if ($product) {
                    $bid->user()->associate($user);
                    $bid->product()->associate($product);
                    if ($request->summ) $bid->summ = $request->summ;
                    if ($request->time) $bid->time = $request->time;
                    $bid->save();
                    
                    if (!$user->fool) {
                        $client = AmoCrm::getClient();
                        // Получение экземпляра модели для работы с аккаунтом
                        $account = $client->account;
                         // Добавление сделок с использованием хелпера
                        $lead = $client->lead;
                        $lead['name'] = '[ investrika.com ] Инвестор пожелал проинвестировать';
                        //$lead['price'] = $data['investmentto'];
                        
                        $lead->addCustomField(558701, $user->name); // ФИО
                        $lead->addCustomField(558765, $user->work); // Сфера для инвестирования
                        $lead->addCustomField(558779, $user->email); // E-mail
                        $lead->addCustomField(558781, $user->city); // Город
                        
//                      $lead->addCustomField(73525, $user->city); // личный менеджер
                        
                        $lead->addCustomField(16669,  $user->phone); // телефон
                        $lead->addCustomField(558783, $user->before); // Сфера для инвестирования
                        $lead->addCustomField(558785, $user->investmentfrom); // Объем инвестиций: ОТ
                        $lead->addCustomField(558787, $user->investmentto); // Объем инвестиций: ДО
                        
                        $lead['responsible_user_id'] = 2523001;
                        $lead['status_id'] = 20442325;
                        $lead->addCustomField(559691, $product->name); // Пожелал проинвестировать
                        
                        $lead->addCustomField(559827, $request->summ);
                        $lead->addCustomField(559841, $request->time);
                        
                        $id = $lead->apiAdd();
                        
                        //$lead->apiUpdate($id);
                    }
                    
                    
                    $response['success'] = true;
                }
            //}
        }
        return response()->json($response, 200);
    }
    
    public function catalog() {
        if (Auth::check()) return view('catalog');
        else return redirect()->route('login');
    }
    
    public function account(Request $request) {
        
        $user = Auth::user();
        
        
        if ($request->isMethod('post')) 
        {
            if($request->new_password == $request->repeat_password && strlen($request->new_password) > 6)
            {
                $request->user()->fill([
                    'password' => Hash::make($request->new_password)
                ])->save();
            }
            
            return view('account_password', ['user' => $user]);
        }
        
        $manager = $user->manager;
        $summ = 0;
        foreach ($user->investments as $investment) {
            $summ += $investment->summ;
        }
        $levels = Level::orderBy('summ')->get();
        
        $lvl = 0;
        
        foreach ($levels as $level) {
            if ($summ<$level->summ) {
                break;
            } else $lvl++;
        }
        
        $user->level = $lvl;

        $investments = Investment::with('product')->where('user_id', $user->id)->get();
        //var_dump($user->investments);

        $startup_cat = Category::find(10);
        $startups = $startup_cat->products;

        $cred_cat = Category::find(14);
        $creds = $cred_cat->products;

        $zay_cat = Category::find(6);
        $zays = $zay_cat->products;

        
        return view('account', ['manager' => $manager, 'user' => $user, 'levels' => $levels, 'startups' => $startups, 'creds' => $creds, 'zays' => $zays]);
    }
    
    public function calc() {
        return view('calc');
    }
    
    public function level() {
        $user = Auth::user();
        $summ = 0;
        foreach ($user->investments as $investment) {
            $summ += $investment->summ;
        }
        $levels = Level::orderBy('summ')->get();
        
        $lvl = 0;
        foreach ($levels as $level) {
            if ($summ<$level->summ) {
                break;
            } else $lvl++;
        }
        
        $user->level=$lvl;
        
        return view('level', ['user' => $user, 'levels' => $levels]);
    }
    
    
        
    public function manager(Request $request) {
        $user = Auth::user();
        $manager = $user->manager;
        return view('manager' , ['manager' => $manager] );
    }
    
    
    public function productsOfCategory(Request $request) {
        $response = array();
        $category = Category::find($request->categoryId);
        $res_products = array();
        if ($category) {
            $res_products = array();
            foreach ($category->products as $product) {
                if (isset($product->logo)) $image = $product->logo->id;
                else $image = 0;
                $res_products[] = array('id' => $product->id, 'name' => $product->name, 'description' => $product->description, 'image' => $image, 'summ' => $product->summ, 'minsumm' => $product->minsumm, 'time' => $product->time, 'percent' => $product->percent, 'currentsumm' => $product->currentSumm());
            }
            $response['products'] = $res_products;
            $response['category'] = $category->name;
        }
        else { // archive
            $products = Product::all()->filter(function($item) {
                return $item->currentSumm() >= $item->summ;
            });
            $res_products = array();
            foreach ($products as $product) {
                if (isset($product->logo)) $image = $product->logo->id;
                else $image = 0;
                $res_products[] = array('id' => $product->id, 'name' => $product->name, 'description' => $product->description, 'image' => $image, 'summ' => $product->summ, 'minsumm' => $product->minsumm, 'time' => $product->time, 'percent' => $product->percent, 'currentsumm' => $product->currentSumm());
            }
            $response['products'] = $res_products;
            $response['category'] = 'Архив';
        }
        
        
        return response()->json($response, 200);
    }
    
    public function get_product(Request $request) {
        $response = array();
        $product = Product::find($request->id);
        
        if ($product) {
            if (isset($product->logo)) $image = $product->logo->id; else $image = 0;

            $response = array(
            'id' => $product->id, 
            'name' => $product->name, 
            'description' => $product->description, 
            'image' => $image, 
            'summ' => $product->summ, 
            'minsumm' => $product->minsumm, 
            'time' => $product->time, 
            'percent' => $product->percent, 
            'percent_type' => $product->percent_type, 
            'currentsumm' => $product->currentSumm());
        }
        
        
        return response()->json($response, 200);
    }
    
    public function image($image_id) {
        $image = Image::find($image_id);
        if ($image) {
            $finfo = new finfo(FILEINFO_MIME);
            $mime = $finfo->buffer($image->data);           
            return response()->make( $image->data, 200, array( 'Content-Type' => $mime ) );
        }
    }

    public function congratulation() {
        return view('congratulation');
    }

    public function admin_credential_rules(array $data)
    {
      $messages = [
        'old_password.required' => 'Please enter current password',
        'password.required' => 'Please enter password',
      ];

      $validator = Validator::make($data, [
        'old_password' => 'required',
        'password' => 'required|same:password',
        'confirm' => 'required|same:password',   
      ], $messages);

      return $validator;
    }

    public function change(Request $request) 
    {
        $request_data = $request->All();
        if (isset($request_data['old_password'])) {
            if(Auth::Check())
            {
                $request_data = $request->All();
                //var_dump($request_data);
                $validator = $this->admin_credential_rules($request_data);
                if($validator->fails())
                {

                    return view('change', [ 'message' => $validator->getMessageBag()->toArray()['confirm'][0]]);
                }
                else
                {  
                    $current_password = Auth::User()->password;           
                    if(Hash::check($request_data['old_password'], $current_password))
                    {           
                        $user_id = Auth::User()->id;                       
                        $obj_user = User::find($user_id);
                        $obj_user->password = Hash::make($request_data['password']);;
                        $obj_user->save(); 
                        return view('change', [ 'message' => 'Пароль успешно изменен' ]);
                    }
                    else
                    {           
                        $error = array('old_password' => 'Please enter correct current password');
                        return view('change', [ 'message' => 'Введите верный пароль', 'error' => $error ]);  
                    }
                }     
            }
        }
        return view('change', [ 'message' => '']);
    }


    public function doc($doc_id) {
        $doc = Doc::find($doc_id);
        if ($doc) {
            $finfo = new finfo(FILEINFO_MIME);
            $mime = $finfo->buffer($doc->data);         
            return response()->make( $doc->data, 200, array( 'Content-Type' => $mime ) );
        }
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }
    
    public function logout(Request $request) {
      Auth::logout();
      return redirect('/');
    }
}
