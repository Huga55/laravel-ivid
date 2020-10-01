<?php

namespace App\Http\Controllers\Admin;

use App\Http\Middleware\isAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operation;
use App\Models\Tariff;
use App\Models\User;

class AdminController extends Controller
{
    public function author(Request $request)
    {
    	return view('admin.auth');
    }

    public function main()
    {
    	return view('admin.main');
    }

    public function getOperations($count, $status)
    {
    	$data = Operation::orderBy('id', 'desc')
    						->where('status', '!=', $status)
    						->take($count)
    						->get();

    	return $this->createTable($data);
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

	public function searchPage()
	{
		return view('admin.search');
	} 

	public function getResult($name)
	{
		$result = User::where('email', 'like', '%' . $name . '%')->get();
		return $result;
	}
}
