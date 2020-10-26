/* NAV меню и бургер */

$(".burger").click(function() {
	$(".burger").toggleClass("burger_active");
	$(".header__top").toggleClass("header__top_active");
	$(".header-lk__nav").toggleClass("header-lk__nav_active");
});

/* ВВОД В ИНПУТ НОМЕР ТЕЛЕФОНА */

//в работе

/* Удаление содержимого инпутов при удачной отправке данных */

let clearInputs = (inputs) => {
  for(let i = 0; i < inputs.length; i++) {
    console.log(inputs[i].value);
    inputs[i].value = "";
  }
}

/* Моадльное окно */

/* смена тарифа */

$(".tariff__button_change").click(function() {
	//если не согласен с офертой, ничего не делаем!
	$(".registr__check").removeClass("registr__check_error");
	if($(this).parent().next(".registr__agree").prop("checked") !== true) {
		$(this).parent().next().next(".registr__check").addClass("registr__check_error");
		return;
	}

	

	let monthPrice = $(this).parent().parent(".tariff__window").children(".tariff__price").html();
	let medioYearPrice = $(this).parent().parent(".tariff__window").children(".tariff__price_medio-year").html();
	//номер тарифа
	$(".modal__link_season").attr("href", "tariff?numbTariff=" + $(this).attr("data-numb"));
	//оплата за 1 или 6 месяцев
	$('[data-month = "1"]').parent().attr("href", $('[data-month = "1"]').parent().attr("href") + 
		"&&monthTariff=" + $('[data-month = "1"]').attr("data-month"));
	$('[data-month = "6"]').parent().attr("href", $('[data-month = "6"]').parent().attr("href") + 
		"&&monthTariff=" + $('[data-month = "6"]').attr("data-month"));

	$('[data-month = "1"]').html(monthPrice);
	$('[data-month = "6"]').html(medioYearPrice);
	activeModal();
});

$(".modal__bg, .modal__link_cancel").click(function(event) {
	event.preventDefault();
	deactiveModal();
});

let activeModal = (classNameWindow = "modal__season") => {
	$(".modal").addClass("modal_active");
	$(".modal__bg").addClass("modal__bg_active");
	$("." + classNameWindow).addClass(classNameWindow + "_active");
	$(".section").addClass("section_smear");
	$(".header-lk").addClass("section_smear");
	$("section").addClass("section_smear");
}

let deactiveModal = () => {
	$(".modal").removeClass("modal_active");
	$(".modal__bg").removeClass("modal__bg_active");
	$(".modal__season").removeClass("modal__season_active");
	$(".modal__consult").removeClass("modal__consult_active");
	$(".modal-success__window").removeClass("modal-success__window_active");
	$(".modal-cancel__window").removeClass("modal-cancel__window_active");
	$(".modal-error__window").removeClass("modal-error__window_active");
	$(".section_smear").removeClass("section_smear");
}

/* ВАЛИДАЦИЯ ВСЕХ ФОРМ */

$(".call__form, .order__form, .registr__form, .author__form").submit(function(e) {
	let data = {};
	let error = 0;
	let classNameForm = $(this).attr("class").replace(/(.*)__form$/, '$1');

	e.preventDefault();

	$(this).find('input').each(function() {
		data[this.name] = $(this).val();
		if(this.value == "" && (this.type === "text" || this.type === "password")) {
			error = 1;//значит есть пустые инпуты
			activePromtp("Не все поля заполнены",
			"Заполните все необходимые поля", 
			this.name, classNameForm);
			e.preventDefault();
		}
	});

	if(error == 0) {
		let thisURL = $(location).attr('href');
		if($(this).hasClass("author__form")) {
			validAuthor(thisURL, data, this, classNameForm);
		}
		if($(this).hasClass("registr__form")) {
			validRegistr(thisURL, data, this, classNameForm);
		}
		if($(this).hasClass("call__form")) {
			validCall(thisURL, data, this, classNameForm);
		}
		if($(this).hasClass("order__form")) {
			data.agree = true;
			validCall(thisURL + "call", data, this, classNameForm);
		}
	}	
});

let validAuthor = (thisURL, data, form, classNameForm) => {
	$.ajax({
		url: thisURL + "/valid",
		type: "POST",
		data: data,
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		},
		success: function (data) {
			if(data === "1") {
				location.reload();
			}else {
				activePromtp("Логин или пароль введены неверно",
				"Проверьте правильность ввода", 
				form.name, classNameForm);
			}
		},
		error: function (msg) {
			console.log("Для разработчика! Ошибка при валидации регистрации или авторизации: ")
			console.log(msg);
		}
	});
}

let validRegistr = (thisURL, data, form, classNameForm) => {
	$.ajax({
		url: thisURL + "/valid",
		type: "POST",
		data: data,
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		},
		success: function (data) {
			if(data === "1") {
				activePopup();
			}
		},
		error: function (msg) {
			console.log("Для разработчика! Ошибка при валидации регистрации или авторизации: ")
			console.log(msg);
			let inputName = Object.keys(msg.responseJSON.errors)[0];
			activePromtp("Неверно заполнено поле",
				"Проверьте правильность заполнения",
				inputName, classNameForm);
		}
	});
}

let validCall = (thisURL, data, form, classNameForm) => {
	$.ajax({
		url: thisURL + "/valid",
		type: "POST",
		data: data,
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		},
		success: function (data) {
			if(data === "1") {
				activePopup();
				clearInputs($(".order__input"));
			}
		},
		error: function (msg) {
			console.log("Для разработчика! Ошибка при валидации регистрации или авторизации: ")
			console.log(msg);
			let inputName = Object.keys(msg.responseJSON.errors)[0];
			activePromtp("Неверно заполнено поле",
				"Проверьте правильность заполнения",
				inputName, classNameForm);
		}
	});
}

let activePromtp = (title, describe, input, className, time = 5000) => {
	$("." + className + "__input_" + input).addClass("input_error");
	$(".prompt").addClass("prompt_active");
	$(".prompt__title").html(title);
	$(".prompt__desribe").html(describe);
	let timerId = setTimeout(() => deletePrompt(), time);

	let deletePrompt = () => {
		$("." + className + "__input_" + input).removeClass("input_error");
		$(".prompt").removeClass("prompt_active");
		$(".prompt__title").html("");
		$(".prompt__desribe").html("");
	}
}

let activePopup = (className = "popup") => {
	$("." + className).addClass("popup_active");
	$(".popup__bg").addClass("popup__bg_active");
	$(".popup__form").addClass("popup__form_active");
	$(".popup__window").addClass("popup__window_active");
	$(".section, section, .header-lk").addClass("section_smear");
}

let desActivePopup = () => {
	$(".popup__form_active").removeClass("popup__form_active");
	$(".popup_active").removeClass("popup_active");
	$(".popup__bg_active").removeClass("popup__bg_active");
	$(".popup__window_active").removeClass("popup__window_active");
	$(".section_smear").removeClass("section_smear");
}

$(".popup_register").click(function(e) {
    window.location = $(".popup__button").prop("href");
});

/* включение и выключение автоплатежа */


/* модальное окно с отказом в платеже */

$(".pay-false__button").click(function() {
	$(".pay-false").addClass("pay-false_no-active");
	$(".pay-false__window").addClass("pay-false__window_no-active");
});

/* ВАЛИДАЦИЯ ЧЕК БОКС ОФЕРТЫ ПРИ РЕГИСТРАЦИИ */

$(".registr__button, .autor__button, .call__button").click(function(e) {
	$(".registr__check").removeClass("registr__check_error");
	if($(".registr__agree").prop("checked") !== true) {
		e.preventDefault();
		$(".registr__check").addClass("registr__check_error");
	}
});

/* ПОКАЗ СКРЫТИЕ ВЫХОД ИЗ ЛК */

$(".header-lk__login").mousemove(function() {
	$(".header-lk__add").addClass("header-lk__add_active");
});

$(".header-lk__login").mouseleave(function() {
	$(".header-lk__add").removeClass("header-lk__add_active");
});

/* AJAX ЗАПРОСЫ ДЛЯ ПОЛУЧЕНИЯ ДАННЫХ ТАБЛИЦЫ О ПЛАТЕЖАХ ПОЛЬЗОВАТЕЛЯ */


$(".office__link").click(function(e) {
	e.preventDefault();

	let statusOperations = $(this).attr("data-status");

	$(".office__link").removeClass("office__link_active")
	$(this).addClass("office__link_active");
	$(".office__add").css("display", "block").
	attr("data-status", statusOperations);
	getTable(statusOperations);
});

$(".office__add").click(function() {
	let statusOperations = $(this).attr("data-status");
	getTable(statusOperations, 500);
	$(this).css("display", "none");
});

let getTable = (status, count = 4) => {
	let thisURL = $(location).attr('href');
	$(".office__preloader").addClass("office__preloader_active");
	$.ajax({
		url: thisURL + "/operations/" + count + "/" + status,
		type: "GET",
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		},
		success: function (data) {
			$(".office__preloader_active").removeClass("office__preloader_active");
			if(data.count !== 0) {
				$(".office__table").html(data.table);
			}else {
				$(".office__table").html("Оплаты не найдены");
			}
			if(data.count < 5) {
				$(".office__add").css("display", "none");
			}
		},
		error: function (msg) {
			console.log("Для разработчика! Ошибка при запросе операций пользователя: ")
			console.log(msg);
		}
	});
}


$(".office__link_first").click();

/* AJAX СМЕНА ЦЕНЫ ПРИ ИЗМЕНЕНИИ ПЕРИОДА */

let removeActiveTariff = () => {
	$(".tariff__window").removeClass("tariff__window_active");
	$(".tariff__button").html("Выбрать тариф");
}

$(".tariff__choice-box").click(function() {
	let data = {
		month:$(this).attr("data-season"),
	};

	$(".tariff__choice-box").removeClass("tariff__choice-box_active");
	$(this).addClass("tariff__choice-box_active");

	removeActiveTariff();

	let thisURL = $(location).attr('href');
	let month = $(this).attr("data-season");
	$.ajax({
		url: thisURL + "/price/" + month,
		type: "GET",
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		},
		success: function (data) {
			$(".tariff__price").each(function(index) {
		  		$(this).html(data[index]);
		  	});
		},
		error: function (msg) {
			console.log("Для разработчика! Ошибка при изменении цены тарифов: ")
			console.log(msg);
		}
	});
});

$(".tariff__choice-box_first").click();

/* Подсвет тарифа при клике */

$(".tariff__button").click(function() {
	removeActiveTariff();
	$(this).parent().parent().addClass("tariff__window_active");
	$(this).html("Тариф выбран");

	let month = $(".tariff__choice-box_active").attr("data-season");
	let price = $(this).next().html();
	
	$(".tariff__pay-button").addClass("tariff__pay-button_active").
	attr("disabled", false);
	$("[name=month]").val(month);
	$("[name=price]").val(price);
});

/* ОПЛАТА НОВОГО ТАРИФА */



/* Обработка попапа для пополнения внутреннего кошелька */

$(".office__cart-button").click(function() {
	activePopup("popup_pay");
});

$(".popup").click(function(e) {
	if($(e.target).hasClass("popup__button-ok")) {
		return;//попап перезвонить клиенту, кнопка - ссылка на главную
	}

	e.preventDefault();
	if( $(e.target).hasClass("popup__content") ||
		$(e.target).hasClass("popup__button_cancel") ||
		$(e.target).hasClass("popup__close") ) {
		desActivePopup();
	}
});

$(".popup__button_pay").click(function(e) {
	let value = $(".popup__input").val();
	if(value === "") {
		activePromtp("Пустое поле", "Заполните поле ввода", 
			"money", "popup");
		event.preventDefault();
		return;
	}
	if(value < 10 || value > 100000) {
		activePromtp("Недопустимое значение", "Сумма должная быть в диапазоне от 10 до 100000", 
			"money", "popup");
		event.preventDefault();
		return;
	}
	$(".popup__form").submit();
	//let link = $(".popup__form").attr("action") + "/pay" + (value);
});

/* AJAX включить / отключить автоплатеж */
$(".tariff__autopay").click(function() {
	if($(this).attr('data-link')) {
		changeAutopay($(this).attr('data-link'));
	}else {
		activePopup("popup_auto-pay");
	}

	$(".popup__button_auto-yes").click(function() {
		changeAutopay($(this).attr('data-link'));
	});
	
});

let changeAutopay = (path) => {
	$.ajax({
		url: path,
		type: "PUT",
		data: {},
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		},
		success: function (data) {
			if(data.status) {
				$(".tariff__autopay").html(data.html).
				attr('data-link', data.link);
			}
			if(data.html === "включить") {
				desActivePopup();
				activePopup("popup_auto-pay-ok");
			}
		},
		error: function (error) {
			console.log("Для разработчика! Ошибка при включении/отключении автоплатежа: ");
			console.log(error);
		}
	});
}

$(".popup__button_auto-no").click(function() {
	desActivePopup();
});

/* модальные окна на стра личного кабинета */
$(".office__button_cancel").click(function() {
	activeModal("modal-cancel__window");
});

$(".modal-cancel__cancel").click(function(e) {
	e.preventDefault();
	deactiveModal();
})

$(".popup__close").click(function() {
	deactiveModal();
})

//проверка существования попапа с результатом оплаты/пополнения кошелька
let existResultModal = (classNameWindow) => {
	if($("." + classNameWindow).length > 0) {
		activeModal(classNameWindow);
	}
}

existResultModal("modal-success__window");
existResultModal("modal-error__window");

/* MOBILE VERSION */

$(".footer__company").click(function(e) {
	event.preventDefault();
	$(".footer__modal").addClass("footer__modal_active");
});

$(".footer__close, .footer__button").click(function() {
	$(".footer__modal").removeClass("footer__modal_active");
});

$(".footer__link_exit").click(function(e) {
	event.preventDefault();
	$(".exit").addClass("exit_active");
});

$(".exit__close, .exit__button_cancel").click(function() {
	$(".exit").removeClass("exit_active");
});