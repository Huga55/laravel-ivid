<?php

namespace App\Http\Controllers\lk;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Info;
use App\Models\Tariff;

class OfficeController extends Controller
{
	public function get(Request $request)
	{
		$user = Auth::user();

		return view('lk/main', [
			'user' => $user,
			'month' => $user->info->month,
		]);
	}

	/*
		Logout user
	*/

	public function logOut()
	{
		Auth::logout();
		return redirect()->route('author');
	}

	/*
		Cancel tariff of user
	*/

	public function delete()
	{
		$user = User::find(Auth::user()->id);
		
		$user->info->tariff_id = 1;
		$user->info->month = 0;
		$user->info->status = 0;
		$user->info->autopay = 0;
		$user->info->date_next_pay= null;
		$user->info->price_next_pay = 0;

		$user->info->save();

		return redirect()->route('office');
	}

	public function getTable($count, $status)
	{
		$user = Auth::user();
		$email = $user->email;
		$operations = $user->operation
							->sortByDesc('id')
							->where('status', '!=', $status)
							->take($count);

		return $this->createTable($operations, $email);
	}

	private function createTable($operations, $email)
	{
		$table = "";
		foreach ($operations as $key => $value) {
			$need_date = $value->date;
			//$need_date = get_nedd_format($date);
			$name_tariff = Tariff::find($value->tariff_id)->name;
			$month = $value->month;
			$price = $value->price;
			$status = $value->status;
			$email = $email;

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
