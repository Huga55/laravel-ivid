<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
	private $links = [
		"main" => [
			"text" => "Главная",
			'li' => "",
			"link" => "",
			"active" => "",
			"uri" => "main",
		],

		2 => [
			"text" => "О компании",
			'li' => "",
			"link" => " header__link_soon",
			"active" => "",
			"uri" => "404",
		],

		"solution" => [
			"text" => "Решения",
			'li' => "",
			"link" => "",
			"active" => "",
			"uri" => "solution",
		],

		4 => [
			"text" => "Услуги",
			'li' => "",
			"link" => " header__link_soon",
			"active" => "",
			"uri" => "404",
		],

		5 => [
			"text" => "наш магазин",
			'li' => " header__elem_soon",
			"link" => " header__link_soon",
			"active" => "",
			"uri" => "404",
		],

		"contact" => [
			"text" => "Контакты",
			'li' => "",
			"link" => "",
			"active" => "",
			"uri" => "contact",
		],
	];

	private $white = [
		"header" => " header_white",
		"elem" => " header__elem_white",
		"link" => " header__link_white",
	];

	private function checkURIActive($request)
	{
		$this->links[$request->route()->getName()]["active"] = " header__link_active";
	}

    public function main(Request $request)
    {
    	$this->checkURIActive($request);

    	foreach ($this->white as $key => $value) {
    		$this->white[$key] = "";
    	}

    	return view('main.main', [
    		'links' => $this->links,
    		'white_style' => $this->white,
    	]);
    }

    public function solution(Request $request)
    {
    	$this->checkURIActive($request);

    	return view('main.solution', [
    		'links' => $this->links,
    		'white_style' => $this->white,
    	]);
    }

    public function contact(Request $request)
    {
    	$this->checkURIActive($request);

    	return view('main.contact', [
    		'links' => $this->links,
    		'white_style' => $this->white,
    	]);
    }

    public function politic()
    {
    	return view('main.politic');
    }

    public function score()
    {
    	return view('main.score');
    }
}
