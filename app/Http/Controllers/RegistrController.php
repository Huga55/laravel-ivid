<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrController extends Controller
{
    public function get()
    {
    	return view('registr');
    }

    public function create(Request $request)
    {	
    	$this->validate($request, [
    		'name' => 'required|max:60',
    		'email' => 'required|email|unique:users',
    		'phone' => 'required|unique:users',
    		'password' => 'required',
    		'password_double' => 'required|same:password',
    		'agree' => 'accepted',
    	]);
    }
}
