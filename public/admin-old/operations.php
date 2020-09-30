<?php 
	include "setting.php";

	if(isset($_POST["add"])) {
		if($_POST["add"] === "main") {
			echo "";
		}
		if($_POST["add"] === "list") {
			getTable("list", $link);
		}
		if($_POST["add"] === "date") {
			getTable("date", $link);
		}
	}

	if(isset($_POST["client"])) {
		$state = json_decode($_POST["client"], true);
		$name = $state["name"];
		$phone = $state["phone"];
		$email = $state["email"];
		$password = $state["password"];
		$date = date("Y-m-d");

		$query = "SELECT id FROM users WHERE email='$email'";
	  	$result = mysqli_query($link, $query) or die( mysqli_error($link) );
	  	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

	  	if(isset($data[0]["id"])) {
	  		echo false;
	  	}else {
			if($state["phone"] === "") {
				$phone = 0;
			}

			$salt = generateSalt();

			$passwordSalt = md5($salt.$password);
			//заполняем таблице users
			$query = "INSERT INTO users SET name='$name', email='$email', phone='$phone', password='$passwordSalt', salt='$salt', date_register='$date'";
			$result = mysqli_query($link, $query) or die( mysqli_error($link) );
			//получаем id только что записанного юзера
			$query = "SELECT id FROM users WHERE email='$email'";
		  	$result = mysqli_query($link, $query) or die( mysqli_error($link) );
		  	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

		  	$id = $data[0]["id"];
		  	//заполняем таблицу с информацией о юзере
		  	$query = "INSERT INTO info SET id_tariff=1, id_user='$id', money=0, date_new_tariff='$date', status=false, auto_pay=false, date_next_pay='0000-00-00', price_next_pay=0";
			$result = mysqli_query($link, $query) or die( mysqli_error($link) );

			echo "true";//всегда последняя строчка, дынне занесены в БД
		}
	}

	function getTable($type, $link) 
	{	
		$query = "SELECT users.id, email, users.name, phone, status, price_next_pay as price FROM users
			LEFT JOIN info ON users.id = info.id_user
			LEFT JOIN tariff ON tariff.id = id_tariff";
	  	$result = mysqli_query($link, $query) or die( mysqli_error($link) );
	  	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

	  	//кнопка добавления новых пользователей через админ панель
		$button = "";
		if($type === "list") {
			$button = "<button class=\"client__addition\">
							<img src=\"img/plus.svg\" alt=\"\" class=\"client__plus\">
							Добавить клиента
						</button>";
		}


		echo "
			<div class=\"container\">
				<div class=\"clients__content\">
					<div class=\"clients__title\">
						Список клиентов
						$button
					</div>
					<div class=\"clients__bottom\">
						<table class=\"clients__table\">
							<tr class=\"clients__row\">
								<th class=\"clients__cell_head\">Состояние</th>
								<th class=\"clients__cell_head\">E-mail</th>
								<th class=\"clients__cell_head\">Телефон</th>
								<th class=\"clients__cell_head\">Название клиента</th>
								<th class=\"clients__cell_head\">Активных подписок</th>
							</tr>
		";

		foreach($data as $client) {
			$nameClient = $client["name"];
			$emailClient = $client["email"];
			$phoneClient = $client["phone"];
			$statusClient = $client["status"];
			$priceClient = $client["price"];
			$idClient = $client["id"];

			if($phoneClient == 0) {
				$phoneClient = "не указан";
			}else {
				$phoneClient = "+7 ".$phoneClient; 
			}

			if($statusClient == 0) {
				$statusClassName = "clients__cell-wrapper_red";
				$statusText = "Не активен";
				$priceClient = "00,00 р.";
			}else {
				$statusClassName = "clients__cell-wrapper_green";
				$statusText = "Активен";
				$priceClient .= ",00 р.";
			}

			echo "
				<tr class=\"clients__row\">
					<td class=\"clients__cell clients__cell_state\">
						<div class=\"clients__cell-wrapper $statusClassName\">
							$statusText
						</div> 
					</td>
					<td class=\"clients__cell clients__cell_email\">$emailClient</td>
					<td class=\"clients__cell clients__cell_phone\">$phoneClient</td>
					<td class=\"clients__cell clients__cell_name\">$nameClient</td>
					<td class=\"clients__cell clients__cell_money\">$priceClient</td>
				</tr>
			";
		}
		echo "
						</table>
					</div>
				</div>
			</div>";
	}