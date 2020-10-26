<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operation;
use App\Models\Tariff;
use App\Models\User;

class MainController extends Controller
{
    public function main(Request $request)
    {
    	$months = [ 1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];

    	$day = date('j', strtotime('now'));
    	$month = $months[date('n', strtotime('now'))];

    	$pay_today = Operation::where('status', 1)->pluck('price')->sum();
    	$clients = User::all()->count();
    	$pays = Operation::all()->count();
    	$salary_avg = Operation::pluck('price')->avg();

    	$user = $request->session()->get('admin_login');
    	return view('admin.main', [
    		'user' => $user,
    		'day' => $day,
    		'month' => $month,
    		'clients' => $clients,
    		'pays' => $pays,
    		'salary_avg' => $salary_avg,
    		'pay_today' => $pay_today,
    	]);
    }

    public function getOperations($count, $status)
    {
    	$data = Operation::orderBy('id', 'desc')
    						->where('status', '!=', $status)
    						->take($count)
    						->get();
    	$countAllOperations = Operation::where('status', '!=', $status)->count();

    	return ['table' => $this->createTable($data),
    			'count' => $countAllOperations];
    }

    private function createTable($operations)
	{
		$table = "";
		foreach ($operations as $key => $value) {
			$need_date = $value->date;
			//$need_date = get_nedd_format($date);
			$name_tariff = Tariff::find($value->tariff_id)->name;
			$month = $value->month;
			$price = $value->price;
			$status = $value->status;
			$email = User::find($value->user_id)->email;

			if($status == 1) {
				$status_class = "tabel-status_accept";
				$status_text = "Успешная оплата";
			}else {
				$status_class = "tabel-status_error";
				$status_text = "Неуспешная оплата";
			}

			$table .= "
				<div class=\"table-content\">
					<div class=\"offise__table-left table-left\">
						<div class=\"office__date table-date\">
							$need_date
						</div>
						<div class=\"office__table-info table-info\">
							<div class=\"office__email table-email\">
								$email
							</div>
							<div class=\"office__status tabel-status $status_class\">
								$status_text
							</div>
						</div>
						<div class=\"office__desctibe table-describe\">
							Ежемесячная оплата по тарифу $name_tariff на $month месяцев
						</div>
					</div>
					<div class=\"office__table-right table-right\">
						$price ,00 ₽
					</div>
				</div>
			";
		}
		return $table;
	}
}
