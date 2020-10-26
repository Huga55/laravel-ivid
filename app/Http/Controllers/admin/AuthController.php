<?php

namespace App\Http\Controllers\admin;

use App\Http\Middleware\isAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function author(Request $request)
    {
    	if($request->session()->has('admin') && $request->session()->get('admin')) {
    		return redirect(route('admin.main'));
    	}
    	if($request->has('login') && $request->has('password') &&
    		$request->input('agree')) {
    		$login = $request->input('login');
    		$password = md5($request->input('password'));
    		$result = Admin::where('login', $login)
    						->where('password', $password)
    						->get();
			if(count($result) !== 0) {
				session(['admin' => true]);
				session(['admin_login' => $login]);
				return redirect(route('admin.main'));
			}
    	}
    	return view('admin.auth');
    }

    public function logout(Request $request)
	{
		$request->session()->forget('admin');
		$request->session()->forget('admin_login');

		return redirect()->route('admin.author');
	}
}
