<?php 
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	session_start();
	//Устанавливаем доступы к базе данных:
	$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
	$user = 'root'; //имя пользователя, по умолчанию это root
	$password = ''; //пароль, по умолчанию пустой
	$db_name = 'view'; //имя базы данных
	
	$link = mysqli_connect($host, $user, $password, $db_name);
	//Соединяемся с базой данных используя наши доступы:
		mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));

	//Устанавливаем кодировку (не обязательно, но поможет избежать проблем):
		mysqli_query($link, "SET NAMES 'utf8'");

	function generateSalt()
	{
		$salt = '';
		$saltLength = 8; // длина соли
		
		for($i = 0; $i < $saltLength; $i++) {
			$salt .= chr(mt_rand(33, 126)); // символ из ASCII-table
		}
		
		return $salt;
	}