/**
 * Получение данных с формы
 * @param obj_form
 */

/**
 * Регистрация нового пользователя
 *
 *
 */
$(document).ready(function() {
// Модальное окно

// открыть по кнопке
$("#showAuthPopup").click(function() {
    if($('.popup__auth').hasClass('disabled')) {
        $('.popup__auth').css('display', 'block');
        $('.popup__reg').css('display', 'none');
    }
    $('.js-overlay-campaign').fadeIn();
    $('.js-overlay-campaign').addClass('disabled');
});

// закрыть на крестик
$('.js-close-campaign').click(function() {
    $('.js-overlay-campaign').fadeOut();

});

// закрыть по клику вне окна
$(document).mouseup(function (e) {
    var popup = $('.js-popup-campaign');
    if (e.target!=popup[0]&&popup.has(e.target).length === 0){
        $('.js-overlay-campaign').fadeOut();
    }
});

// Показать регистрацию
$('.popup__title-link').click(function(event) {
    $('.popup__auth').fadeOut('500', function() {
        $(this).addClass('disabled');
        $('.popup__reg').fadeIn('500');
    });
});

function getData(obj_form) {
    var hData = {};
    $('input, textarea, select', obj_form).each(function () {
        if(this.name && this.name != '') {
            hData[this.name] = this.value;
            console.log('hData[' + this.name + '] = ' + hData[this.name]);
        }
    });
    return hData;
}


$('#user__auth-logout').click(function logout() {
    $.get( "/user/logout/", function( data ) {
        alert( "Load was performed." );
    });
});

    $('#register').click(function registerNewUser() {
        var postData = getData('.form__reg');
        $.ajax({
            type: "POST",
            url: '/user/register/',
            data: postData,
            dataType: 'json',
            success : function (data) {
                if(data['success']) {
                    alert('Регистрация пользователя прошла успешно');
                    console.log("Прибыли данные: " + data);
                    //> блок в левом столбце
                    $('.js-overlay-campaign').fadeOut(500);

                    $('.user__auth').show();
                    $('.user__auth-link').attr('href', '/user/')
                        .html(data['userName']);
                    window.location.reload();
                    // <
                } else {
                    alert(data['message']);
                }
            },
            error: function (data, request, status, error) {
                console.log(status);
                console.log(error);
                console.log(data);
            }

        });

    });

    /**
     * Авторизация пользователя
     */

    $('#auth').click(function login() {
        // var email = $('#loginEmail').val(),
        //     pwd = $('#loginPwd').val(),
        var postData = getData('.form__auth');
        console.log(postData);
        $.ajax({
            type: "POST",
            url: '/user/login/',
            data: postData,
            dataType: 'json',
            success : function (data) {
                if(data['success']) {
                    alert('Авторизация успешна');
                    $('.js-overlay-campaign').fadeOut(500);

                    $('.user__auth').show();
                    $('.user__auth-link').attr('href', '/user/')
                        .html(data['userName']);
                    window.location.reload();
                } else {
                    alert(data['message']);
                }
            },
            error: function (request, status, error) {
                console.log(status);
                console.log(error);
            }

        })
    });
    /**
     * Обновление данных пользователя
     *
     */

    $('#updateData').click(function updateUserData() {
        console.log("js - updateUserData");
        var postData = getData('.form__user');
        $.ajax({
            type: "POST",
            url: '/user/update/',
            data: postData,
            dataType: 'json',
            success : function (data) {
                if(data['success']) {
                    alert('Данные успешно изменены');
                    //> блок в левом столбце
                    $('.user__auth-link').html(data['displayName']);
                    window.location.reload();
                } else {
                    alert(data['message']);
                }
            },
            error: function (request, status, error) {
                console.log(status);
                console.log(error);
            }

        });
    });
});


// регистрация события загрузки документа.
if (window.addEventListener) window.addEventListener("load", init, false);

// установка обработчиков для форм и элементов форм.
function init() {
    for (var i = 0; i < document.forms.length; i++) {
        var form = document.forms[i];
        var pasAr = [];
        var formValidation = false;

        for (var j = 0; j < form.elements.length; j++) {
            var e = form.elements[j];

            // пропускаем все что не поле ввода.
            if (e.type != "text") {
                continue;
            }
            if (e.type === 'password') {
                pasAr.push(form.elements[i]);
            }

            // проверка имеются ли атрибуты требующие проверки.
            var pattern = e.getAttribute("data-val");

            if (pattern) {
                e.onchange = validateInput; // обработчик на изменение.
                formValidation = true; // форма требует проверку.
            }
        }
        if (formValidation) {
            form.onsubmit = validateForm; // установка обработчика для формы на submit
        }

    }
    console.log(formValidation);
}


// обработчик на изменение содержимого полей ввода.
function validateInput() {
    var pattern = this.dataset.val,
        msg = this.dataset.valMsg,
        msgId = this.dataset.valMsgId,
        value = this.value;

    var res = value.search(pattern);
    if (res == -1) {
        document.getElementById(msgId).innerHTML = msg;
        this.className = "error";
    }
    else {
        document.getElementById(msgId).innerHTML = "";
        this.className = "valid";
    }
}

// обработчик на submit формы.
function validateForm() {

    var invalid = false;


    for (var i = 0; i < this.elements.length; ++i) {
        var e = this.elements[i];
        if (e.type === "text" && e.onchange !== null) {
            e.onchange();
            if (e.className === "error") invalid = true;
        }
    }

    if (invalid) {
        alert("Допущены ошибки при заполнении формы.");
        return false;
    }
}
