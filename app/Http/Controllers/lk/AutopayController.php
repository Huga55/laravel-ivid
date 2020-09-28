<?php

namespace App\Http\Controllers\lk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutopayController extends Controller
{
    public function on()
    {
    	$user = Auth::user();
    	$user->info->autopay = 1;
    	$user->info->save();

    	$response = [
    		'status' => true,
    		'html' => 'выключить',
    		'link' => "",
    	];

    	return $response;
    }

    public function off()
    {
    	$user = Auth::user();
    	$user->info->autopay = 0;
    	$user->info->save();

    	$response = [
    		'status' => true,
    		'html' => 'включить',
    		'link' => route('auto.on'),
    	];

    	return $response;
    }
}
