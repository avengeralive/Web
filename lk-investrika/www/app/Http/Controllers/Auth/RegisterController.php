<?php
// 79992120075 / 5-eg5tS$@ENaA/

namespace App\Http\Controllers\Auth;

use App\Notifications\AccountApproved;
use App\User;
use App\Role;
use App\Invite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dotzero\LaravelAmoCrm\Facades\AmoCrm;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/congratulation';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	public function showRegistrationForm(Request $request)
    {
        
        $phone = $this->clear_phone($request->phone);
        $code  = $request->code;
        $error = FALSE;
        $role = $request->session()->get('role');
        
		if (!$request->session()->has('invite') && $phone > 0) 
		{
			$invite = Invite::create([
				'phone' => $phone,
				'code' => rand(10000,99999),
			]);

			$notify = new AccountApproved('test');
			$invite->notify($notify);
			$request->session()->put('invite', $invite);
			$request->session()->put('name', $request->name);
			$request->session()->put('role', $request->role);
			$request->session()->put('phone', $phone);
		}
		
		if(empty($phone) && $request->session()->has('phone'))
		{
    	    $phone = $request->session()->get('phone');
		}
		
		if(empty($phone) && empty($code))
		{
    		return redirect('/');
		}
		
		if(!empty($code))
		{
    		$code = intval(implode('', $code));
    		
    		if($code > 0)
    		{
        		$invite = $request->session()->get('invite');
        		
        		if ($code == $invite->code) 
        		{
            		$request->session()->put('confirm', 1);
            		
            		
            		if($role == 'investor')
            		{
                		return view('registerinv',  ['phone' => $phone]);
            		}
            		else
            		{
                		return view('auth.register',  ['phone' => $phone]);
            		}
        		} 
        		else 
        		{
            		$error = 'Неверный код подтверждения.';
        		}
    		}
		}
		
		if($request->session()->has('confirm') && $request->session()->get('confirm') == 1)
		{
    		
    		if(empty($role)) $role = 'investor';
        		
    		if ($request->isMethod('post')) 
    		{
        		
        		if($role == 'investor')
        		{
                    $this->validatorinv($request->all())->validate();
                    $data = $request->all();
                    $data['name'] = implode(' ', [$data['second_name'], $data['first_name'], $data['middle_name']]);
                    $data['investmentfrom'] = 0;
                    $data['phone'] = $phone;
                    event(new Registered($user = $this->createinv($data)));
        		}
        		else
        		{
                    $this->validator($request->all())->validate();
                    $data = $request->all();
                    $data['name'] = implode(' ', [$data['second_name'], $data['first_name'], $data['middle_name']]);
                    $data['investmentfrom'] = 0;
                    $data['phone'] = $phone;
                    event(new Registered($user = $this->create($data)));
        		}

                $this->guard()->login($user);
                
                return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    		}
    		
    		
    		if($role == 'investor')
    		{
        		return view('registerinv',  ['phone' => $phone]);
    		}
    		else
    		{
        		return view('auth.register',  ['phone' => $phone]);
    		}
    		
		}

		
        return view('auth/sms_confirm',  ['phone' => $phone, 'error' => $error]);
    }

    public function register(Request $request) // for company
    {
        $this->validator($request->all())->validate();
		$invite = $request->session()->get('invite');
		
		if ($request->code == $invite->code) {
			event(new Registered($user = $this->create($request->all())));
			$this->guard()->login($user);
		}

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
    
    function clear_phone($phone)
    {
        $phone = str_replace([' ', '-', '.', '+', '(' , ')'], '', $phone);
        
        return intval($phone);
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerinv(Request $request)
    {
		
        $this->validatorinv($request->all())->validate();

		$invite = $request->session()->get('invite');
		if ($request->code == $invite->code) {
			event(new Registered($user = $this->createinv($request->all())));
			$this->guard()->login($user);
		}
		else return redirect($this->redirectPath());

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
	
	
	
	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
//             'phone' => 'required|string|max:255',
            'work' => 'required|string|max:255',
            'post' => 'string|max:255',
            'city' => 'required|string|max:255',
            'experience' => 'integer',
			'companyname' => 'string|max:255',
			'investmentfrom' => 'integer',
			'investmentto' => 'integer',
			//'before' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'check_terms' => 'boolean',
        ]);
    }
	
	protected function validatorinv(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            
//             'phone' => 'required|string|max:255',
            'work' => 'required|string|max:255',
            //'post' => 'string|max:255',
            'city' => 'required|string|max:255',
            //'experience' => 'integer',
			//'companyname' => 'string|max:255',
// 			'investmentfrom' => 'integer',
			'investmentto' => 'integer',
			'before' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
		
		$role_company  = Role::where('name', 'company')->first();
		$user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'work' => $data['work'],
            'post' => $data['post'],
            'city' => $data['city'],
            //'before' => $data['before'],
            'experience' => $data['experience'],
			'companyname' => $data['companyname'],
			'investmentfrom' => $data['investmentfrom'],
			'investmentto' => $data['investmentto'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
		$user->roles()->attach($role_company);
		return $user;
    }
	
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createinv(array $data)
    {
		$role_investor  = Role::where('name', 'investor')->first();
		
		$manager_id = null;
		$oldcount = -1;
		
		foreach (User::all() as $user1) {
			if ($user1->hasRole('manager')&&$user1->active) {
				if ($oldcount==-1) {
					$manager_id = $user1->id;
					$oldcount = $user1->managedUsers->count();
				}
				else {
					if ( ($user1->managedUsers->count()<=$oldcount) ) {
						$manager_id = $user1->id;
						$oldcount = $user1->managedUsers->count();
					}
				}
			}
		}
			
		
		$user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'work' => $data['work'],
            //'post' => $data['post'],
            'city' => $data['city'],
            'before' => $data['before'],
            //'experience' => $data['experience'],
			//'companyname' => $data['companyname'],
			'investmentfrom' => $data['investmentfrom'],
			'investmentto' => $data['investmentto'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
			'manager_id' => $manager_id,
        ]);
		$user->roles()->attach($role_investor);
		
		$client = AmoCrm::getClient();
		// Получение экземпляра модели для работы с аккаунтом
		$account = $client->account;
		 // Добавление сделок с использованием хелпера
		$lead = $client->lead;
		$lead['name'] = '[ investrika.com ] Регистрация инвестора';
		//$lead['price'] = $data['investmentto'];
		
		$lead->addCustomField(558701, $data['name']); // ФИО
		$lead->addCustomField(558765, $data['work']); // Сфера для инвестирования
		$lead->addCustomField(558779, $data['email']); // E-mail
		$lead->addCustomField(558781, $data['city']); // Город
		$lead->addCustomField(16669,  $data['phone']); // телефон
		$lead->addCustomField(558783, $data['before']); // Сфера для инвестирования
		$lead->addCustomField(558785, $data['investmentfrom']); // Объем инвестиций: ОТ
		$lead->addCustomField(558787, $data['investmentto']); // Объем инвестиций: ДО
		
		$lead['responsible_user_id'] = 2523001;
		//$lead['status_id'] = 20442325;
		//$lead->addCustomField(559691, 'Название компании'); // Пожелал проинвестировать
		$id = $lead->apiAdd();
		
		//$lead->apiUpdate($id);
		
	
		
		return $user;
    }
}
