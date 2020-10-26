<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if(Auth::check()) {
            return redirect()->route('office');
        }

        if($request->session()->has('user')) {
            $user = true;
        }else {
            $user = false;
        }

    	return view('auth.register', [
            'user' => $user,
        ]);
    }

    public function registrValidation(Request $request)
    {
        $validation = $this->validate($request, [
            'name' => 'required|max:60',
            'email' => 'required|email|unique:users',
            'phone' => array('required', 
                'unique:users',
                'regex:/^(8|(\+7))\d{10}$/'),
            'password' => 'required',
            'password_double' => 'required|same:password',
            'agree' => 'accepted',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        $request->session()->put('user', $check);

        return 1;
    }

    public function postRegister(Request $request)
    {
        //нужно избавиться от + в телефоне!!!!
    	$this->validate($request, [
    		'name' => 'required|max:60',
    		'email' => 'required|email|unique:users',
    		'phone' => array('required', 
                'unique:users',
                'regex:/^(8|(\+7))\d{10}$/'),
    		'password' => 'required',
    		'password_double' => 'required|same:password',
    		'agree' => 'accepted',
    	]);

    	$data = $request->all();
        $data['phone'] = preg_replace('#^(8|(\+7))#',"", $data['phone']);
    	$check = $this->create($data);

        $request->session()->put('user', $check);

    	return redirect()->route('register');
    }

    protected function create(array $data)
    {
    	$user =  User::create([
    		'name' => $data['name'],
    		'email' => $data['email'],
    		'phone' => $data['phone'],
    		'password' => Hash::make($data['password']),
    	]);

    	$userId = $user->id;
    	Info::create([
    		'user_id' => $userId,
    	]);
    	return $user;
    }

    public function accept(Request $request)
    {
        $user = $request->session()->get('user');
        $request->session()->forget('user');
        Auth::login($user);

        return redirect()->route('office');
    }

    public function auth()
    {
        if(Auth::check()) {
            return redirect()->route('office');
        }

    	return view('auth.author');
    }

    public function authValidation(Request $request)
    {
        
        $key = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $login = preg_replace('#^(8|(\+7))#',"", $request->input('login'));
        //$request->input('login') = preg_replace('#^(8|(\+7))#',"", $request->input('login'));

        return Auth::attempt([$key => $login,
                        'password' => $request->input('password'),
                        ]);
    }
/*
    public function postAuth(Request $request)
    {
    	$key = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

    	$this->validate($request, [
    		'login' => 'required',
    		'password' => 'required',
    		'agree' => 'accepted',
    	]);
    	$credentials = [$key => $request->input('login'),
    					'password' => $request->input('password'),
    					];
    	if(Auth::attempt($credentials)) {
    		return redirect('/lk');
    	}
    	return redirect('/auth')->withSuccess('Oppes! You have entered invalid credentials');;
    }*/
}
