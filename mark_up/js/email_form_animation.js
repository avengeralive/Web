function showEmailForm(view_counter) {
    // let footer = $('footer');
    // let contacts_height = footer.position().top ;
    $(window).scroll(function (event) {
        if ($(window).scrollTop() >= ($('body').height()/2) && view_counter == 0) {
            view_counter++;
            $('#email_form').modal('show')
            animateElements();
        }
        event.preventDefault();
    });
}

function animateElements() {
    let input = anime({
        targets: ".email-form-input input",
        translateX: -100,
        easing: "easeOutQuad"
    });

    let button = anime({
        targets: ".email-form-input button",
        translateX: 100,
        easing: "easeOutQuad"
    });
    let red_text = anime({
        targets: '.email_form_red',
        translateY: 50,
        easing: 'easeOutQuad',
    });

    let text = anime({
        targets: ".top_text_before",
        translateY: -50,
        easing: "easeOutQuad"
    });

    let book = anime({
        targets: '.email_form img',
        translateX: function () {
            return 600
        },
        loop: false,
        easing: 'easeOutQuad',
    });

    let whiteSquare = anime({
        targets: '.whiteSquare',
        translateX: function () {
            return 13 + 'rem';
        },
        rotate: function () {
            return 167;
        },
        duration: function () {
            return 1000;
        },
        loop: false,
        easing: 'easeOutQuad',
    });

    let blueSquare = anime({
        targets: '.blueSquare',
        translateX: function () {
            return 13 + 'rem';
        },
        rotate: function () {
            return 157;
        },
        duration: function () {
            return 1000;
        },
        loop: false,
        easing: 'easeOutQuad',
    });

    let greenSquare = anime({
        targets: '.greenSquare',
        translateX: function () {
            return -13 + 'rem';
        },
        rotate: function () {
            return 140;
        },
        duration: function () {
            return 1000;
        },
        loop: false,
        easing: 'easeOutQuad',
    });
}

$(function() {

    $('#form-book').on('submit', function () {
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            beforeSend: function() {
                $('.download_button').prop('disabled', true);
                $('.download_button').text('Отправляем...');
            },
            success: function(response) {
                if (response.result) {
                    $('.email_form').css('display', 'none');
                    $('.agreement').css('display', 'none');
                    $('.form_after_email').css('display', 'block');
                    $(".email_form_text_book").css("display", "block");

                    let socials = ['.bh', '.dr', '.fb', '.vk'];
                    var translatex = 615;
                    var easing_2 = 100;

                    socials.forEach(social => {
                        translatex = translatex - 7
                        easing_2 = easing_2 - 12;
                        anime({
                            targets: '.social-links .social-icon' + social,
                            translateX: translatex,
                            easing: 'spring(1,' + easing_2 + ', 10, 10)',
                        });
                    });

                    let book = anime({
                        targets: '.form_after_email .email_form_text',
                        translateX: 600,
                        loop: false,
                        easing: 'easeOutQuad',
                    });
                }
            },
            complete: function() {
                $('.download_button').prop('disabled', false);
                $('.download_button').text('Скачать');
            },
            statusCode: {
                500: function () { // выполнить функцию если код ответа HTTP 200
                    alert('Что то пошло не так');
                }
            }
        });

        return false;
    });

});
