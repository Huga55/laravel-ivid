<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create(array $data)
    {
    	$user = new User;
    	$user->name = $data['name'];
    	$user->email = $data['email'];
    	$user->phone = $data['phone'];
    	$user->password = $data['password'];
    	$user->save();
    }
}
