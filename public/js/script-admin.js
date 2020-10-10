


/* Модальные окна */

emailGlobal = "";

$(function(){
  $(document).on("click", ".client__addition", function(e) {
    $(".modal").addClass("modal_active");
    $(".modal__bg").addClass("modal__bg_active");
    $(".modal__client").addClass("modal__client_active");
  });
});


$(".modal__bg, .client-luck__button, .client-luck__close").click(function() {
	deactiveAll();
});



$(".modal__button").click(function(event) {
  event.preventDefault();
  $(".modal__input_error").removeClass("modal__input_error");
  $(".modal__prompt").html("");
  let resultValid = validationForm($(this).parent());
  if(resultValid[0]) {
  
    ajaxGive("operations.php", resultValid, true);
    
  }else {
    giveErrors(resultValid, "modal");
  }  
})


let deactiveAll = () => {
  $(".modal__client").removeClass("modal__client_noactive");
  $(".modal").removeClass("modal_active");
  $(".modal__bg").removeClass("modal__bg_active");
  $(".modal__bg").removeClass("modal__bg_active-double");
  $(".modal__client").removeClass("modal__client_active");
  $(".client-luck").removeClass("client-luck_active");
}

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
      $(".office__table").html(data);
    },
    error: function (msg) {
      console.log("Для разработчика! Ошибка при запросе операций пользователя: ")
      console.log(msg);
    }
  });
}

$(".office__link_first").click();

/* ВАЛИДАЦИЯ ФОРМЫ ДОБАВЛЕНИЯ КЛИЕНТОВ */
let validationForm = (element) => {
  let inputs = $(element).children(".input");
  let info = {
    name: "",
    phone:"",
    email: "",
    password:""
  };
  let error = [false];
  for(let input of inputs) {
    error[0] = true;
    if(input.value == "" && input.name !== "phone") {
      error[0] = false;
      error.push([input.name, "заполните поле"]);
    }
    info[input.name] = input.value;
    if(input.name == "email") {
      emailGlobal = input.value;
    }
  }
  if(!error[0]) {
    return error;
  }else {
    if(inputs[3].value !== inputs[4].value) {
      error[0] = false;
      error.push([inputs[3].name, "введенные пароли не совпадают"]);
      error.push([inputs[4].name, "введенные пароли не совпадают"]);

      return error;
    }
  }
  return JSON.stringify(info);
}

/* поиск пользователей по имени */

$(".search__input").change(function() {
  let thisURL = $(location).attr('href');
  $.ajax({
    url: thisURL + "/result/" + $(this).val(),
    type: "GET",
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (data) {
      console.log(data);
      $(".search__table").html(data);
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

/* Удаление содержимого инпутов при удачной отправке данных */

let clearInputs = (inputs) => {
  for(let i = 0; i < inputs.length; i++) {
    inputs[i].value = "";
  }
}




/* AJAX запросы */


/* AJAX добавления новых клиентов */

let ajaxGive = (path, give, isFromAdmin = false) => {
  $.post(path, {client: give}, function (data) {
      console.log(data);
      if(data) {
        clearInputs($(".modal__input"));
        if(isFromAdmin) {
          $(".modal__client").addClass("modal__client_noactive");
          $(".client-luck").addClass("client-luck_active");
          $(".modal__bg").addClass("modal__bg_active-double");
          $(".clien-luck__email").html(emailGlobal);
        }
      }else {
        let resultValid = [false, ["email", "пользователь с данным email уже существует"]];
        giveErrors(resultValid, "modal");
        console.log("Ошибка ajax: " + data);//для прогера
      }
    })
};


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
})