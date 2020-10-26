<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;
use App\Models\Operation;
use App\Models\Tariff;
use Illuminate\Support\Str;

class PayController extends Controller
{
    public function purseUp(Request $request)
    {
    	$price = $request->input('money');
    	$user = Auth::user();
        $token = Str::random(20);

    	$operation = Score::create([
    		'user_id' => $user->id,
    		'date' => date('Y-m-d'),
    		'time' => date('H:i:s'),
    		'price' => $price,
    		'status' => null,
            'token' => $token,
    		'transaction_id' => 0,
    		'up' => 1,
    		'down' => 0,
    	]);

    	$data_tinkoff = [
    		'description' => 'Пополнение счета на сумму: '. $price . '.',
    		'terminal_key' => '1591465486121DEMO',
    		//'terminal_key' => '1591465486121',
    		'order_id' => $operation->id,
    		'amount' => $price * 100,
    		'success_url' => route('pay.purse.up.success', ['token' => $token]),
    		'fail_url' => route('pay.purse.up.fail'),
    		'recurrent' => '',
    		'customer_key' => $user->id,
    	];

    	$answer = $this->queryTinkoff($data_tinkoff, 'test-');

    	if($answer->Success && $answer->Status === "NEW") {
    		$id_pay = $answer->PaymentId;//id заказа в системе банка
			$order_id = $answer->OrderId;//id заказа в системе магазина
			$payment_url = $answer->PaymentURL;//url для редиректа пользователя на страницу оплаты

			$operation->transaction_id = $order_id;

			return redirect($payment_url);
    	}
    	return redirect()->route('office');
    }

    public function payTariff(Request $request)
    {
    	$month = $request->input('month');
    	$price = $request->input('price');
    	$user = Auth::user();
        $token = Str::random(20);

    	$operation = Operation::create([
    		'user_id' => $user->id,
    		'date' => date('Y-m-d'),
    		'time' => date('H:i:s'),
    		'price' => $price,
    		'tariff_id' => Tariff::where($month, $price)->pluck('id')->first(),
    		'status' => 0,
    		'transaction_id' => 0,
    		'month' => $month,
    		'pay_with_autopay' => 0,
            'token' => $token,
    	]);

        $money = $user->info->money;

        if($money >= $price) {
            $score = Score::create([
                'user_id' => $user->id,
                'date' => date('Y-m-d'),
                'time' => date('H:i:s'),
                'price' => $price,
                'status' => 1,
                'transaction_id' => 0,
                'up' => 0,
                'down' => 1,
                'token' => $token,
            ]);

            $user->info->money -= $price;
            $user->info->save();
            
            return redirect()->route('pay.tariff.success', ['token' => $token]);
        }

    	$data_tinkoff = [
    		'description' => 'Оплата тарифа: '. $price . '.',
    		'terminal_key' => '1591465486121DEMO',
    		//'terminal_key' => '1591465486121',
    		'order_id' => $operation->id,
    		'amount' => $price * 100,
    		'success_url' => route('pay.tariff.success', ['token' => $token]),
    		'fail_url' => route('pay.tariff.fail'),
    		'recurrent' => 'Y',
    		'customer_key' => $user->id,
    	];

    	$answer = $this->queryTinkoff($data_tinkoff, 'test2-');

    	if($answer->Success && $answer->Status === "NEW") {
    		$id_pay = $answer->PaymentId;//id заказа в системе банка
			$order_id = $answer->OrderId;//id заказа в системе магазина
			$payment_url = $answer->PaymentURL;//url для редиректа пользователя на страницу оплаты

			$operation->transaction_id = $order_id;

			return redirect($payment_url);
    	}
    	return redirect()->route('tariff');
    }

    public function queryTinkoff($data, $prefix_id)
    {
    	$vars = array();
		$vars["Description"] = $data['description'];//описание платежа
		$vars["TerminalKey"] = $data['terminal_key'];//ключ терминала (id)
		$vars["OrderId"] = $prefix_id . $data['order_id'];//id аказа в системе продавца
		$vars["Amount"] = $data['amount'];//сумма платежа
		$vars["SuccessURL"] = $data['success_url'];//страница при успешной оплате
		$vars["FailURL"] = $data['fail_url'];//страница при ошибке оплаты
		$vars["Recurrent"] = $data['recurrent'];//флаг для рекуррентного платежа, для последующей автооплаты
		$vars["CustomerKey"] = $data['customer_key'];//id пользователя в системе продавца

		return json_decode($this->getCurlPOST($vars, 'https://securepay.tinkoff.ru/v2/Init'));
    }

    function getCurlPOST($arr, $link)
	{
		//отправка JSON методом POST на сервер банка
		$data_string = json_encode($arr);

		$ch = curl_init($link);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
		    array(
		        'Content-Type:application/json; charset=utf-8',
		        'Content-Length: ' . strlen($data_string)
		    )
		);
		$result_curl = curl_exec($ch);
		curl_close($ch);

		return $result_curl;
	}

    public function purseSuccess(Request $request, $token)
    {
    	$user = Auth::user();

    	$operation = Score::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        if($operation->token === $token) {
            $operation->status = 1;
            $operation->user->info->money += $operation->price;
            $operation->save();
            $operation->user->info->save();
            //для модального окна
            $this->setFlashRsultPay($request, 'pay_purse', true, $operation->price);
        }
    	return redirect()->route('office');
    }

    public function purseFail(Request $request)
    {
    	$user = Auth::user();

    	$operation = Score::where('user_id', $user->id)->orderBy('id', 'desc')->first();
    	$operation->status = 0;
    	$operation->save();
        $this->setFlashRsultPay($request, 'pay_purse', false, $operation->price);

    	return redirect()->route('office');
    }

    public function paySuccess(Request $request, $token)
    {
    	$user = Auth::user();


    	$operation = Operation::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        if($operation->token === $token) {
            $operation->status = 1;
            $operation->save();
            $operation->user->info->status = 1;
            $operation->user->info->tariff_id = $operation->tariff_id;
            $operation->user->info->date_next_pay = date('Y-m-d', strtotime("+". $operation->month ." month"));
            $operation->user->info->price_next_pay = $operation->price;
            $operation->user->info->month = $operation->month;
            $operation->user->info->save();
            //для модального окна
            $this->setFlashRsultPay($request, 'pay_tariff', true, $operation->price,
                $operation->user->info->date_next_pay, $operation->user->info->tariff->name);
        }

    	return redirect()->route('tariff');
    }

    public function payFail(Request $request)
    {
    	$user = Auth::user();

    	$operation = Operation::where('user_id', $user->id)->orderBy('id', 'desc')->first();
    	$operation->status = 0;
    	$operation->save();

    	return redirect()->route('tariff');
    }

    public function setFlashRsultPay($request, $typeResult, $result, $price, $date_next_pay = null,
                                    $tariff_name = null)
    {
        $request->session()->flash($typeResult, [
            'is_exist' => true,
            'result' => $result,
            'price' => $price,
            'date_next_pay' => $date_next_pay,
            'tariff_name' => $tariff_name,
        ]);
    }
}
