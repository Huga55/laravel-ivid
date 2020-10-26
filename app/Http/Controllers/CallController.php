<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CallController extends Controller
{
    public function getPage()
    {
    	return view('main.call');
    }

    public function callValidation(Request $request)
    {
    	$validation = $this->validate($request, [
            'name' => 'required|max:60',
            'phone' => array('required', 
                'unique:users',
                'regex:/^(8|(\+7))\d{10}$/'),
            'agree' => 'accepted',
        ]);

        $name = $request->input('name');
        $phone = $request->input('phone');

    	return 1;
    }

    public function sendMail($name, $phone)
    {

    }
}
