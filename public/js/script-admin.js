/* NAV меню и бургер */

$(".burger").click(function() {
  $(".burger").toggleClass("burger_active");
  $(".header__top").toggleClass("header__top_active");
  $(".header-lk__nav").toggleClass("header-lk__nav_active");
});

/* Удаление содержимого инпутов при удачной отправке данных */

let clearInputs = (inputs) => {
  for(let i = 0; i < inputs.length; i++) {
    inputs[i].value = "";
  }
}

/* массовый клик на checkbox */
$("#select-all").change(function() {
  $(".search__checkbox").prop("checked", $(this).prop("checked"));
});

/* обработка и удаление пользователей из админ панели */

$('.search__table').on('change', '.search__checkbox', function(e) {
  let countChecked = $(".search__checkbox-user:checked").length;
  if(countChecked) {
    $(".delete").addClass("delete_active");
    $(".delete__count").html(countChecked);
  }else {
    $(".delete_active").removeClass("delete_active");
  }
});


/* Получение списка операций пользователей */

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

/* ВАЛИДАЦИЯ ФОРМЫ ДОБАВЛЕНИЯ КЛИЕНТОВ */
$(".add__form").submit(function(e) {
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
    }
  });

  if(error == 0) {
    let thisURL = $(location).attr('href');
    validRegistr(thisURL, data, this, classNameForm);
  }  
});

let validRegistr = (thisURL, data, form, classNameForm) => {
  $.ajax({
    url: thisURL + "/valid",
    type: "POST",
    data: data,
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      if(data.result) {
        activePopup("modal", data.email);
        clearInputs($(".add__input"));
      }
    },
    error: function (msg) {
      console.log("Для разработчика! Ошибка при валидации регистрации")
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

let activePopup = (classPopup, email = false) => {
  $("." + classPopup).addClass(classPopup + "_active");
  $("." + classPopup + "__bg").addClass(classPopup + "__bg_active");
  $("." + classPopup + "__window").addClass(classPopup + "__window_active");
  if(email) {
    $("." + classPopup + "__text").html("Клиент " + email + " успешно добавлен.");
  }
}

let inactiveAllPopup = (classPopup) => {
  $("." + classPopup + "_active").removeClass(classPopup + "_active");
  $("." + classPopup + "__bg_active").removeClass(classPopup + "__bg_active");
  $("." + classPopup + "__window_active").removeClass(classPopup + "__window_active");
  clearInputs($(".add__input"));
}

$(".search__button").click(function() {
  activePopup("add");
})

$(".add__button-cancel, .add__bg").click(function(e) {
  e.preventDefault();
  inactiveAllPopup("add");
});

$(".modal__bg, .modal__button").click(function() {
  inactiveAllPopup("add");
  inactiveAllPopup("modal");
});
/* поиск пользователей по имени */

$(".search__input").keyup(function() {
  let thisURL = $(location).attr('href');
  let endPoint;
  if($(this).val() === "") {
    endPoint = "0";
  }else {
    endPoint = $(this).val();
  }

  $.ajax({
    url: thisURL + "/result/" + endPoint,
    type: "GET",
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      $(".search__table-result").html(data);
    },
    error: function (msg) {
      console.log("Для разработчика! Ошибка при запросе операций пользователя: ")
      console.log(msg);
    }
  });
});



/* реализация ошибок в форме */

let giveErrors = (resultValid, nameSection) => {
  for(let i = 1; i < resultValid.length; i++) {
    $("[name = " + resultValid[i][0] + "]").addClass(nameSection + "__input_error");
    $("." + nameSection + "__prompt-" + resultValid[i][0]).html(resultValid[i][1]);
  }
}

/* AJAX меню навигации */
$(function () {
    $(".nav__link").click(function (event) {
    	event.preventDefault();
    	$(".nav__link").removeClass("nav__link_active");
    	$(this).addClass("nav__link_active");
       $.post('operations.php', {add: $(this).attr("href")}, function (data) {
         $(".clients").html(data);
       })
    })
});

/* ПОКАЗ СКРЫТИЕ ВЫХОД ИЗ ЛК */

$(".header-lk__login").mousemove(function() {
  $(".header-lk__add").addClass("header-lk__add_active");
});

$(".header-lk__login").mouseleave(function() {
  $(".header-lk__add").removeClass("header-lk__add_active");
});

/* удаление пользователей админом */

$(".delete__button").click(function() {
  let idArr = [];
  $(".search__checkbox-user:checked").each(function() {
    idArr.push($(this).attr("data-id"));
  })
  let thisURL = $(location).attr('href');
  $.ajax({
    url: thisURL + "/delete",
    type: "DELETE",
    _method: "DELETE",
    data: {"users": idArr},
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      if(data.result) {
        location.reload();
      }
    },
    error: function (msg) {
      console.log("Для разработчика! Ошибка при запросе операций пользователя: ")
      console.log(msg);
    }
  });
});