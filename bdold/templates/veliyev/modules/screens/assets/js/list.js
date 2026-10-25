$(function () {
    $(document).on('change', '#js-landings', function () {
        var html = $('#js-result');
        html.html('Загрузка...');
        $.post('?', {
            action: 'getScreens',
            id: $(this).val()
        }, function (res) {
            if (res.length === 0) {
                html.html('Ничего нет');
                return;
            }
            html.html('<pre><code>');
            for (var i = 0; i < res.length; i++) {
                html.append('<a href="' + res[i].url + '">Скриншот ' + res[i].device + '</a> / ' + res[i].status + '<br>');
            }


        }, 'json')

    })

    $(document).on('change', '#js-offers', function () {
        var options = $('#js-landings');
        options.css({background: '#e0e0e0'});
        $.post('?', {
            action: 'getLandings',
            id: $(this).val()
        }, function (res) {

            options.empty();
            options.append('<option value=0>Выбрать</option>');
            for (var i = 0; i < res.length; i++) {
                options.append('<option value=' + res[i].id + '>' + res[i].name + '</option>');
            }

            setTimeout(function () {
                options.css({background: 'white'});
            }, 100);
        }, 'json')
    })
})