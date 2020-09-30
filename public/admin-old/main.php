<?php 
	include "setting.php";
	include "header.php";
?>
<div class="top">
	<div class="container">
		<nav class="nav">
			<form action="" class="nav__form" method__post>
				<ul class="nav__list">
					<li class="nav__elem"><a href="main.php" class="nav__link nav__link_active">Главная страница</a></li>
					<li class="nav__elem"><a href="list" class="nav__link">Список клиентов</a></li>
					<li class="nav__elem"><a href="date" class="nav__link">Статистика по клиентам</a></li>
				</ul>
			</form>	
		</nav>
	</div>
</div>
<?php 
	//получем общее количество клиентов, активных клиентов и доход
	$query = "SELECT COUNT(id) AS count_users, 
	(SELECT COUNT(status) FROM users 
	LEFT JOIN info ON users.id = id_user
	WHERE status != 0) AS count_active,
	(SELECT SUM(price_next_pay) as sum FROM info
	LEFT JOIN users ON users.id = id_user) AS count_money
	FROM users";
  	$result = mysqli_query($link, $query) or die( mysqli_error($link) );
  	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

  	$count_users = $data[0]["count_users"];
 	$count_active = $data[0]["count_active"];
 	$count_money = $data[0]["count_money"];
  	
?>
<div class="info">
	<div class="container">
		<div class="info__content">
			<div class="info__left">
				<div class="info__date">
					Оплат за сегодня, 15 июля
				</div>
				<div class="info__salary">
					4800 ₽
				</div>
			</div>
			<div class="info__right">
				<div class="info__block">
					<div class="info__name">Всего клиентов</div>
					<div class="info__index">14</div>
				</div>|
				<div class="info__block">
					<div class="info__name">Кол-во платежей</div>
					<div class="info__index">4</div>
				</div>|
				<div class="info__block">
					<div class="info__name">Средняя сумма</div>
					<div class="info__index">1200</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="clients">
	<table>margin top 16px</table>
</div>

<?php 
	include "footer.php";
?>