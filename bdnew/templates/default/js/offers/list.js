$(function () {
    // stat view
    $(document).on('click', '.stat-bg', function () {
        $(this).remove();
        $('.stat-popup').empty();
        $('.stat-popup').css({padding: 0})
    })
    $(document).on('click', 'img[data-stat]', function () {
        var div = $(this).parent().find('div');
        div.addClass('stat-popup');
        $('body').append('<div class=stat-bg style="position:fixed;top:0px;lefT:0px;width:100%;height:100%;background:rgba(0,0,0,0.4);z-Index:100"></div>')

        $(div).css({
            position: 'absolute',
            width: 800,
            background: 'rgba(245,255,245,1)',
            borderRadius: '10px',
            zIndex: '9999',
            padding: '10px',
            paddingRight: '50px',
            maxHeight: '430px'

        })
        var offer = $(this).data('id');
        var stat = $(this).data('stat');

        $(div).empty().append('<center><div style="height:150px;width:50%;float:left"><H4>Топ источников </h4><div class=stat-traf-' + offer + '></div></div><div style="float:left;width:50%"><H4>Устройства</h4><div class=stat-device-' + offer + '></div></div><div style="clear:both"></div><div style="height:200px; width:50%;float:left"><h4>Пол</h4><div class="stat-sex stat-sex-' + offer + '"></div> </div><h4>Апрувы</h4><div style="float:left;height:300px" class="stat-approve stat-approve-' + offer + '"></div>').hide();
        var trafUrl = [];
        trafUrl.push(stat.traffic1.split(',')[0]);
        trafUrl.push(stat.traffic2.split(',')[0]);
        trafUrl.push(stat.traffic3.split(',')[0]);
        trafUrl.push(stat.traffic4.split(',')[0]);
        trafUrl.push(stat.traffic5.split(',')[0]);

        var trafData = [];
        trafData.push(stat.traffic1.split(',')[1])
        trafData.push(stat.traffic2.split(',')[1])
        trafData.push(stat.traffic3.split(',')[1])
        trafData.push(stat.traffic4.split(',')[1])
        trafData.push(stat.traffic5.split(',')[1])
        var t = new Chartist.Bar('.stat-traf-' + offer, {
            labels: trafUrl,
            series: trafData
        }, {
            distributeSeries: true
        });
        function colorize(t) {
            t.on('draw', function (context) {
                // First we want to make sure that only do something when the draw event is for bars. Draw events do get fired for labels and grids too.

                if (context.type === 'bar') {
                    context.element.attr({
                        style: 'stroke: hsl(' + (Math.floor(Math.round(Math.random() * 5000)) - 0) + ', 50%, 50%);'
                    });
                }
            });
        }
        colorize(t)

        // 
        var total = Math.round(stat.device_pc) + Math.round(stat.device_phone) + Math.round(stat.device_tablet);
        var data = {
            labels: ['ПК (' + Math.round(100 * Math.round(stat.device_pc) / total) + '%)', 'Телефоны (' + Math.round(100 * Math.round(stat.device_phone) / total) + '%)' ],
            series: [[Math.round(stat.device_pc), Math.round(stat.device_phone)]]
        };



        t = new Chartist.Bar('.stat-device-' + offer, data, {
            seriesBarDistance: 10,
            reverseData: true,
            horizontalBars: true,
            axisY: {
                offset: 70
            }
        });
        colorize(t)

        // sex
        var total = Math.round(stat.sex_male) + Math.round(stat.sex_female)
        var sex = new Chartist.Pie('.stat-sex-' + offer, {
            labels: ['Мужчины (' + Math.round(Math.round(stat.sex_male) / total * 100) + '%)', 'Женщины (' + Math.round(Math.round(stat.sex_female) / total * 100) + '%)'],
            series: [Math.round(stat.sex_male), Math.round(stat.sex_female)]
        }, {
            donut: true,
            donutWidth: 30,
            startAngle: 0,
            total: (Math.round(stat.sex_male) + Math.round(stat.sex_female)),
            showLabel: true
        });
        sex.on('draw', function (context) {
            return;
            if (context.type === 'slice') {
                console.log(context);
                context.element.attr({
                    style: 'stroke: ' + (context.index == 1) ? 'red' : 'blue'
                });
            }
        })


        //approve
        var total = Math.round(stat.approve_ok) + Math.round(stat.approve_waiting) + Math.round(stat.approve_reject);
        var ap = new Chartist.Pie('.stat-approve-' + offer, {
            labels: ['Одобрено (' + Math.round(Math.round(stat.approve_ok) / total * 100) + '%)', 'Ожидание (' + Math.round(Math.round(stat.approve_waiting) / total * 100) + '%)', 'Отмена (' + Math.round(Math.round(stat.approve_reject) / total * 100) + '%)'],
            series: [Math.round(stat.approve_ok), Math.round(stat.approve_waiting), Math.round(stat.approve_reject)]
        }, {
            donut: true,
            donutWidth: 60,
            startAngle: 270,
            total: 2 * (Math.round(stat.approve_ok) + Math.round(stat.approve_reject) + Math.round(stat.approve_waiting)),
            showLabel: true
        });
        ap.on('draw', function (context) {

        })
        $(div).slideDown(200);
    })

    //
    var baloonTimer = false;
    $(document).on('click', '.js-trands', function () {
        return false;
    });
    $(document).on('mouseleave', '.js-trands', function () {
        $(this).parent().find('.baloon').hide();
    });
    $(document).on('mouseenter', '.js-trands', function () {
        $('.baloon').hide();
        if (baloonTimer) {
            clearTimeout(baloonTimer);
        }

        var baloon = $(this).parent().find('.baloon');
        baloonTimer = setTimeout(function () {
            baloon.hide()
        }, 5000);

        var keyword = $(this).data('keyword');
        $.get('?', {
            action: 'getTrands',
            type: $(this).data('type'),
            offer_id: $(this).data('offer')
        }, function (res) {
            baloon.find('div').empty();
            var max = Math.round(Math.max.apply(Math, res.stat) * 1.6);
            var type = {
                publer: 'Publer',
                yandex: 'Яндекс Wordstat',
                google: 'Google Trends'
            }
            baloon.find('div').append('<style>table.t td{font-size: 12px;padding:5;text-align: initial}</style><span style="margin:0;font-size: 14px;line-height: 20px"><table class=t width=100%><tr><td width=40%  bgcolor=#f0f0f0 style="text-align:right" align=right>Источник:</td><td>' + type[res.type] + '</td></tr><tr><td width=40%  bgcolor=#f0f0f0 style="text-align:right" align=right>Период:</td><td>12 месяцев</td></tr><tr><td width=40%  bgcolor=#f0f0f0 style="text-align:right" align=right>Кейворд:</td><td>' + keyword + '</td></tr></table><br></span><img src="https://chart.googleapis.com/chart?chxr=0,20,' + max + '%7C1,180,20000&chds=0,' + max + '&chls=2.0&chxt=y&cht=lc&chs=260x165&&chg=9,20,1,0,0&chd=t:' + res.stat.join(',') + '">');
            baloon.show();
        }, 'json')

    })
    function loadTable(req) {
        $('#js-ajax-content').css({
            opacity: 0.5
        });
        $('#js-ajax-content').load(req + ' #js-ajax-content', function () {
            $('#js-ajax-content').css({
                opacity: 1
            });
        });
    }
    $(document).on('submit', '.js-ajax-filter', function () {
        var req = $(this).serialize();
        loadTable('?' + req);
        return false;
    })

    var timer = false;
    $(document).on('click', 'a.navigation-page', function () {


        loadTable('' + $(this).attr('href'));
        return false;
    })
    $(document).on('keyup', '.js-ajax-filter input[type="text"]', function () {
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(function () {
            $('.js-ajax-filter').submit();
        }, 300);
    })
    $(document).on('change', '.js-ajax-filter select', function () {
        $('.js-ajax-filter').submit();
    })
})