


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