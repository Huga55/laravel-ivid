<?php

namespace App\Http\Controllers\lk;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tariff;

class TariffController extends Controller
{
    public function get(Request $request)
    {
    	$user = Auth::user();

    	$data = [
    		'status' => $user->info->status,
    		'auto_pay' => $user->info->auto_pay,
    	];

        //модальные окна результат опалты
        $result_pay = ['is_exist' => false];
        if($request->session()->has('pay_tariff')) {
            $result_pay = $request->session()->get('pay_tariff');
            $result_pay['date_next_pay'] = $this->dateTransform($result_pay['date_next_pay']);
        }

    	return view('lk.tariff', [
    		'user' => $user,
    		'data' => $data,
            'result_pay' => $result_pay,
    	]);
    }

    public function getPrice($month)
    {
    	$prices = Tariff::where($month, '!=', 0)->get()->pluck($month);
    	return response()->json($prices, 200);
    }

    public function dateTransform($date)
    {
        return implode('.', array_reverse(explode('-', $date)));
    }
}
