$(function () {

 $('#js-form-create').submit(function () {
        $(this).ajaxSubmit({
            success: function (html) {
                $('#js-form').submit();
                $('#js-form-create').trigger('reset');
            }
        })
        return false;
    });
    $('#js-form').submit(function () {
        $(this).ajaxSubmit({
            success: function (html) {
                $('#js-result').html( html )
            }
        })
        return false;
    });
    $(document).on('change', '.autosubmit', function () {
        $('#js-form').submit();
    })
     $('#users-create').typeahead({
        val: 'id',
        preProcess: function () {
            $('#users-value-create').val('')
        },
        onSelect: function (item) {
            $('#users-value-create').val(item.value)
        },
        ajax: {
            url: '?action=getUsers',
            triggerLength: 1
        }
    });
    $('#users').typeahead({
        val: 'id',
        preProcess: function () {
            $('#users-value').val('')
        },
        onSelect: function (item) {
            $('#users-value').val(item.value).trigger('change')
            $('[name="type"]').val('0');
        },
        ajax: {
            url: '?action=getUsers',
            triggerLength: 1
        }
    });
    $("#datepicker").daterangepicker({
        ranges: {
            'Сегодня': [moment(), moment()],
            'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
            'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
            'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
            'Прошлый месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "locale": {
            "format": "DD.MM.YYYY",
            "separator": " - ",
            "applyLabel": "Применить",
            "cancelLabel": "Отмена",
            "fromLabel": "С",
            "toLabel": "по",
            "customRangeLabel": "Произвольно",
            "daysOfWeek": [
                "Вс",
                "Пн",
                "Вт",
                "Ср",
                "Чт",
                "Пт",
                "Сб"
            ],
            "monthNames": [
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь"
            ],
            "firstDay": 1
        },
        startDate: moment().startOf('month'),
        endDate: moment()
    });

    $("#datepicker2").daterangepicker({
        ranges: {
            'Сегодня': [moment(), moment()],
            'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
            'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
            'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
            'Прошлый месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "locale": {
            "format": "DD.MM.YYYY",
            "separator": " - ",
            "applyLabel": "Применить",
            "cancelLabel": "Отмена",
            "fromLabel": "С",
            "toLabel": "по",
            "customRangeLabel": "Произвольно",
            "daysOfWeek": [
                "Вс",
                "Пн",
                "Вт",
                "Ср",
                "Чт",
                "Пт",
                "Сб"
            ],
            "monthNames": [
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь"
            ],
            "firstDay": 1
        },
        startDate: moment().startOf('month'),
        endDate: moment()
    });
    
})