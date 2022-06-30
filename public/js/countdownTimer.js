$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "/count-down-timer",
        success: function (response) {
            
            if (response.error === false) {
                
                countDownTimer(response.settings.register_start_at, response.isRegisterEnd);
                
                // console.log(response.settings.register_start_at);

            } else {

                console.log(response.message.script);
                
            }

        }
    });

    $.ajax({
        type: "GET",
        url: "/register-end-at",
        success: function (response) {
            
            if (response.error === false) {
                
                registerEnd(response.data.isRegisterEnd, response.data.register_end_at_formated, response.data.register_end_at);

            } else {

                console.log(response.message.script);
                
            }

        }
    });

});

function countDownTimer(register_start_at, isRegisterEnd) {

    const mainContent = document.querySelectorAll('#main-content');

    const textDays = document.querySelectorAll('#days');
    const textHours = document.querySelectorAll('#hours');
    const textMinutes = document.querySelectorAll('#minutes');
    const textSeconds = document.querySelectorAll('#seconds');
    
    let countDownDate = new Date(register_start_at).getTime();

    let x = setInterval(function () {

        let now = new Date().getTime();

        let distance = countDownDate - now;

        let days = Math.floor(distance / (1000 * 60 * 60 * 24));

        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        $(textDays).text(`${days} Hari`);
        $(textHours).text(`${hours} Jam`);
        $(textMinutes).text(`${minutes} Menit`);
        $(textSeconds).text(`${seconds} Detik`);

        if (distance < 0 && isRegisterEnd == true) {

            clearInterval(x);

            $('#countdown-timer').addClass('d-none');

        } else if (distance < 0 && isRegisterEnd == false) {

            clearInterval(x);

            $('#countdown-timer').addClass('d-none');

            $(mainContent).removeClass('d-none');

        }

    }, 1000);

}

function registerEnd(isRegisterEnd, register_end_at_formated, register_end_at) {

    if (isRegisterEnd === true) {
        
        $('#registerEndAt').text(register_end_at_formated);
        $('#registerEnd').removeClass('d-none');
        $('#countdown-timer').addClass('d-none');
        $('#main-content').addClass('d-none');

    } else {

        $('#registerEnd').addClass('d-none');
        $('#countdown-timer').removeClass('d-none');
        
    }
    
    let countDownDate = new Date(register_end_at_formated).getTime();

    let x = setInterval(function () {

        let now = new Date().getTime();

        let distance = countDownDate - now;

        if (distance < 0) {

            clearInterval(x);

            $('#registerEndAt').text(register_end_at_formated);
            $('#registerEnd').removeClass('d-none');
            $('#countdown-timer').addClass('d-none');
            $('#main-content').addClass('d-none');

        }

    }, 1000);

}