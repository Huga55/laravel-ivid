<?php 
	include "setting.php";

	$query = "SELECT * FROM admin_table";
	$result = mysqli_query($link, $query) or die( mysqli_error($link) );
	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
	$data = $data[0];

	if((isset($_POST["email"]) && isset($_POST["password"])
		&& ($_POST["email"] == $data["login"]) && ($_POST["password"] == $data["password"]))
		|| (isset($_SESSION["admin"]) && $_SESSION["admin"] == "accept")) {
		//$_SESSION["admin"] = "accept";
		header("Location: main.php");
	}else {
	include "header.php";
?>

<section class="author">
	<div class="container">
		<div class="author__content author__content_admin">
			<div class="author__window window">
				<div class="author__title form-title">
					Авторизация
				</div>
				<form action="" class="author__form" method="post">
					<label for="" class="author__name label">Почта</label>
					<input type="text" name="email" class="author__input author__email input" placeholder="Введите почту">
					<label for="" class="author__name label">Пароль</label>
					<input type="text" name="password" class="author__input author__pass input" placeholder="Введите пароль">
					<input type="submit" class="autor__button button" value="Войти">
				</form>
			</div>
		</div>
	</div>
</section>

<?php 
	}
	include "footer.php";
?>