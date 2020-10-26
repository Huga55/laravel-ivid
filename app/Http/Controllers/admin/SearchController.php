<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Info;
use App\Models\Score;
use App\Models\Operation;
use Illuminate\Support\Facades\Hash;

class SearchController extends Controller
{
    public function searchPage(Request $request)
	{
		$user = $request->session()->get('admin_login');
		$all_users = User::all()->count();
		return view('admin.search', [
			'user' => $user,
			'count_users' => $all_users,
		]);
	} 

	public function getResult($name)
	{
		if($name === "0") {
			$result = User::all();
		}else {
			$result = User::where('email', 'like', '%' . $name . '%')->get();
		}

		if(!count($result)) {
			return "<tr><td class=\"search__cell-center\">Ничего не найдено</td></tr>";
		}
		
		$table = "";
		foreach ($result as $key => $value) {
			$link = route("admin.get.user.page", ['id' => $value['id']]);
			$info_status = $value->info->status;
			if($info_status) {
				$status = "Активный";
			}else {
				$status = "Неактивный";
			}
			$tariff = $value->info->tariff->name;
			$table .= 
			"<tr class=\"search__line\">
				<td class=\"search__cell search__cell_checkbox\"><input type=\"checkbox\" class=\"search__checkbox search__checkbox-user\" data-id=\"{$value['id']}\" id=\"user-{$value['id']}\"><label for=\"user-{$value['id']}\" class=\"search__label\"></label></td>
				<td class=\"search__cell search__cell_email\">{$value['email']}</td>
				<td class=\"search__cell search__cell_phone\">{$value['phone']}</td>
				<td class=\"search__cell search__cell_tariff\">«{$tariff}»</td>
				<td class=\"search__cell search__cell_status\">$status</td>
				<td class=\"search__cell search__cell_link\"><a href=" . '"' . $link . '"' . " class=\"search__link\">Войти</a></td>
			</tr>";
		}

		return $table;
	}

	public function getUserPage($id)
	{	
		Auth::loginUsingId($id);
        return redirect()->route('office');
	}

	public function registrValidation(Request $request)
    {
        $validation = $this->validate($request, [
            'name' => 'required|max:60',
            'email' => 'required|email|unique:users',
            'phone' => array('required', 
            	'unique:users',
            	'regex:/^(8|(\+7))\d{10}$/'),
            'password' => 'required',
        ]);

        $data = $request->all();

        $user =  User::create([
    		'name' => $data['name'],
    		'email' => $data['email'],
    		'phone' => preg_replace('#^(8|(\+7))#',"", $data['phone']),
    		'password' => Hash::make($data['password']),
    	]);

        $userId = $user->id;
    	Info::create([
    		'user_id' => $userId,
    	]);

        return ['result' => true, 'email' => $data['email']];
    }

    public function deleteUsers(Request $request)
    {
    	$id_all = $request->all()['users'];

    	foreach ($id_all as $id) {
    		Score::where('user_id', $id)->delete();
    		Operation::where('user_id', $id)->delete();
    		Info::where('user_id', $id)->delete();
    		User::where('id', $id)->delete();
    	}

    	return ['result' => "true"];
    }
}
