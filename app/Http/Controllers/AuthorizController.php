<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorizController extends Controller
{
    public function get()
    {
    	return view('authoriz');
    }
}
