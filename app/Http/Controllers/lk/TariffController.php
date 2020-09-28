<?php

namespace App\Http\Controllers\lk;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tariff;

class TariffController extends Controller
{
    public function get()
    {
    	$user = Auth::user();

    	$data = [
    		'status' => $user->info->status,
    		'auto_pay' => $user->info->auto_pay,
    	];

    	return view('lk.tariff', [
    		'user' => $user,
    		'data' => $data,
    	]);
    }

    public function getPrice($month)
    {
    	$prices = Tariff::where($month, '!=', 0)->get()->pluck($month);
    	return response()->json($prices, 200);
    }
}
