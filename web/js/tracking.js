$(document).ready(function () {
    let timeOpened = Date.now();
    const urlOpened = window.location.pathname;

    //Слежение за закрытием вкладки
    window.onbeforeunload = function () {
        tracker(urlOpened, timeOpened);
    };

    //Окно потеряло фокус
    window.onblur = function () {
        tracker(urlOpened, timeOpened);
    };

    //Пользователь вернулся на страницу
    window.onfocus = function () {
        timeOpened = Date.now();
    };

    //Слежение за нажатием на ссылку
    $("a").on("click",function () {
        //TODO
        alert('Переход по ссылке '+ $(this).attr('href'));
    });
});

function tracker(page, begin) {
    const time = Date.now() - begin;
    $.ajax({
        url: '/tracing',
        method: 'POST',
        data: {
            url: page,
            time: time
        },
        success: function () {
            //TODO
        },
        error: function () {
            //TODO
        }
    });
}