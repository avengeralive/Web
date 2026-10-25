function SearchAll() {
    var id = document.querySelector("#id").value;
    var fio = document.querySelector("#fio").value;;
    var product = document.querySelector("#product").value;
    var externalWebmaster = document.querySelector("#externalWebmaster").value;
    var externalId = document.querySelector("#externalId").value;

    var apr_date_from = document.querySelector("#apr_date_from").value;
    var apr_date_before = document.querySelector("#apr_date_before").value;

    var buy_date_from = document.querySelector("#buy_date_from").value;
    var buy_date_before = document.querySelector("#buy_date_before").value;

    var shippedAt_from = document.querySelector("#shippedAt_from").value;
    var shippedAt_before = document.querySelector("#shippedAt_before").value;

    var canceledAt_from = document.querySelector("#canceledAt_from").value;
    var canceledAt_before = document.querySelector("#canceledAt_before").value;

    var refundedAt_from = document.querySelector("#refundedAt_from").value;
    var refundedAt_before = document.querySelector("#refundedAt_before").value;

    var phone = document.querySelector("#phone").value;
    var post_track = document.querySelector("#post_track").value;
    var webmasterId = document.querySelector("#webmasterId").value;
    var total_goods = 0; 
    var approved = 0;

    if($("tbody tr")){
        $("tbody tr").remove();
    }
    if($("thead tr")){
        $("thead tr").remove();
    }

    if(document.querySelector("#list2")){
        var list2 = document.querySelector("#list2");
        list2.remove();
    }
    var preload = $('#main_preload');

    $.ajax({
        type: 'post',
        url: '/json/',
        data: {
            func: 'CEditCat',
            action: 'getAll',
            fio: fio,
            product: product,
            apr_date_from: apr_date_from,
            apr_date_before: apr_date_before,
            buy_date_from: buy_date_from,
            buy_date_before: buy_date_before,
            shippedAt_from: shippedAt_from,
            shippedAt_before: shippedAt_before,
            canceledAt_from: canceledAt_from,
            canceledAt_before: canceledAt_before,
            refundedAt_from: refundedAt_from,
            refundedAt_before: refundedAt_before,
            phone: phone,
            post_track: post_track,
            id: id,
            webmasterId: webmasterId,
            externalId: externalId,
            externalWebmaster: externalWebmaster
    },
        beforeSend : function(){ 
            preload.show();
            preload.css({"display":"flex"})
        },
        complete : function(){ preload.hide() },
        success: function(data){
            $("table thead").append('<tr class="table_content"><th style="min-width:65px;">Сброс</th><th label="ids" style="min-width:60px;"><span>ID</span></th><th label="operator" style="min-width:100px;"><span>Оператор</span></th><th label="goods_names" style="min-width:250px;"><span>Товары</span></th><th label="st" style="min-width:250px;"><span>Статус</span></th><th label="comment"><span>Комментарий</span></th><th label="russianpostTrack" style="min-width:200px;"><span>RP: Track</span></th><th label="russianpostStatus" style="min-width:150px;"><span>RP: cтатус посылки</span></th><th label="name" style="min-width:200px;"><span>ФИО</span></th><th label="phone" style="min-width:200px;"><span>Телефон</span></th><th label="statustime" style="min-width:100px;"><span>Статус изменен</span></th><th label="lastUpdate" style="min-width:100px;"><span>Изменен</span></th><th label="time_call"><span>Время перезвона</span></th><th label="timeClient"><span>Время клиента</span></th><th label="postIndex"><span>Индекс</span></th><th label="region" style="min-width:200px;"><span>Регион</span></th><th label="city" style="min-width:200px;"><span>Город</span></th><th label="address" style="min-width:200px;"><span>Адрес</span></th><th label="house"><span>Дом</span></th><th label="flat"><span>Квартира</span></th><th label="price"><span>Цена</span></th><th label="approvedAt"><span>Дата подтверждения</span></th><th label="shippedAt"><span>Дата отправки</span></th><th label="canceledAt"><span>Дата отмены</span></th><th label="buyoutAt"><span>Дата выкупа</span></th><th label="refundedAt"><span>Дата возврата</span></th><th label="liveinformId" style="min-width:100px;"><span>Liveinform ID</span></th><th label="liveinform" style="min-width:100px;"><span>Liveinform</span></th><th label="size"><span>Размер</span></th><th label="completely"><span>Дожим</span></th><th label="dop1"><span>Доп.поле 1</span></th><th label="domain2" style="min-width:100px;"><span>Домен</span></th></tr>');
            data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                var count = i + 1;
                if(count == data.length){
                    if(data[i].err) {
                        total_goods = total_goods + data[i].err;
                        var err = data[i].err;
                    }else var err = 0;
                    if(data[i].return) {
                        total_goods = total_goods + data[i].return;
                        var ret = data[i].return;
                    }else var ret = 0;
                    if(data[i].cancel) {
                        total_goods = total_goods + data[i].cancel;
                        var cancel = data[i].cancel;
                    }else var cancel = 0;
                    if(data[i].processing) {
                        total_goods = total_goods + data[i].processing;
                        var processing = data[i].processing;
                    }else var processing = 0;
                    if(data[i].accepted) {
                        total_goods = total_goods + data[i].accepted;
                        approved = approved + data[i].accepted;
                        var accepted = data[i].accepted;
                    }else var accepted = 0;
                    if(data[i].sent) {
                        total_goods = total_goods + data[i].sent;
                        approved = approved + data[i].sent;
                        var sent = data[i].sent;
                    }else var sent = 0;
                    if(data[i].paid) {
                        total_goods = total_goods + data[i].paid;
                        approved = approved + data[i].paid;
                        var paid = data[i].paid;
                    }else var paid = 0;

                    if(searchstat == 1){
                        if(!document.querySelector("#countingvalues")){
                            $("[class = tablecontainer]").prepend('<div id="countingvalues" style="width:100%"><label id="total_goods">Всего:&nbsp;'+total_goods+'</label><label id="approved" style="margin-left: 15%;">Апрув:&nbsp;'+approved+'</label><label id="sent" style="margin-left: 15%;">Оправлено:&nbsp;'+sent+'</label><label id="paid" style="margin-left: 15%;">Выкуплено:&nbsp;'+paid+'</label><label id="ret" style="margin-left: 15%;">Возврат:&nbsp;'+ret+'</label></div>');
                        }else{
                            document.querySelector("#total_goods").innerHTML    = 'Всего:&nbsp;'+total_goods;
                            document.querySelector("#approved").innerHTML       = 'Апрув:&nbsp;'+approved;
                            document.querySelector("#sent").innerHTML           = 'Оправлено:&nbsp;'+sent;
                            document.querySelector("#paid").innerHTML           = 'Выкуплено:&nbsp;'+paid;
                            document.querySelector("#ret").innerHTML            = 'Возврат:&nbsp;'+ret;
                        }
                    }
                    
                }else {
                    var goods_names                 =  goodsNames(data[i].goods_names);
            
                    if(admin == 1 || manager == 1){
                        var fio_h                       = data[i].name;
                        var russianpostTrack_h          = data[i].russianpostTrack;
                        var postIndex_h                 = data[i].postIndex;
                        var region_h                    = data[i].region
                        var city_h                      = data[i].city;
                        var address_h                   = data[i].address;
                        var house_h                     = data[i].house;
                        var flat_h                      = data[i].flat;
                        var phone_h                     = data[i].phone;
                        var size_h                      = data[i].size;
                        var dop1_h                      = data[i].dop1;
                        var domain2_h                   = data[i].domain2;
                    }else {
                        if(data[i].name                 != '')  {var fio_h                                  =   '<code>********</code>';}
                        else                                    {var fio_h                                  =   ''}
                        if(data[i].russianpostTrack     != '')  {var russianpostTrack_h                     =   '<code>********</code>';}
                        else                                    {var russianpostTrack_h                     =   ''}
                        if(data[i].postIndex            != '')  {var postIndex_h                            =   '<code>********</code>';}
                        else                                    {var postIndex_h                            =   ''}
                        if(data[i].region               != '')  {var region_h                               =   '<code>********</code>';}
                        else                                    {var region_h                               =   ''}
                        if(data[i].city                 != '')  {var city_h                                 =   '<code>********</code>';}
                        else                                    {var city_h                                 =   ''}
                        if(data[i].address              != '')  {var address_h                              =   '<code>********</code>';}
                        else                                    {var address_h                              =   ''}
                        if(data[i].house                != '')  {var house_h                                =   '<code>********</code>';}
                        else                                    {var house_h                                =   ''}
                        if(data[i].flat                 != '')  {var flat_h                                 =   '<code>********</code>';}
                        else                                    {var flat_h                                 =   ''}
                        if(data[i].phone                != '')  {if( supervisor == 1){var phone_h           =  data[i].phone;}
                        else                                    {var phone_h                                = '<code>********</code>';}}
                        else                                    {var phone_h                                =   ''}
                        if(data[i].size                 != '')  {var size_h                                 =   '<code>********</code>';}
                        else                                    {var size_h                                 =   ''}
                        if(data[i].dop1                 != '')  {var dop1_h                                 =   '<code>********</code>';}
                        else                                    {var dop1_h                                 =   ''}
                        if(data[i].domain2              != '')  {var domain2_h                              =   '<code>********</code>';}
                        else                                    {var domain2_h                              =   ''}
                    }
                    $("tbody").append('<tr class="request"><td><a target="_blank" rel="noopener noreferrer" title="Редактировать в новом окне " href="/edit?'+data[i].list+'-'+data[i].id+'" class="editLink" data-view="listing"></a><a target="_blank" rel="noopener noreferrer" title="История изменений заказа №'+data[i].id+'" href="/history?id='+data[i].id+'" class="historyLink" data-view="listing"></a></td><td label="ids"><span><span ids="'+data[i].id+'" class="ids" data-view="listing">'+data[i].id+'</span></span></td><td label="operator"><span><span class="operatorName" data-view="listing"><i time="">Не назначен</i></span></span></td><td label="goods_names"><span>'+goods_names+'</span></td><td label="st"><span><span class="st" data-view="listing">'+data[i].st+'</span></span></td><td label="comment"><span><span class="comment" data-view="listing">'+data[i].comment+'</span></span></td><td label="russianpostTrack"><span>'+russianpostTrack_h+'</span></td><td label="russianpostStatus"><div><i time="" class="russianpostStatus" data-view="listing">'+data[i].russianpostStatus+'</i></div></td><td label="name"><span>'+fio_h+'</span></td><td label="phone"><span>'+phone_h+'</span></td><td label="statustime"><span><span class="statustime" data-view="listing"><i time="">'+timeConverter(data[i].statustime)+'</i></span></span></td><td label="lastUpdate"><span><span class="lastUpdate" data-view="listing"><i time="">'+timeConverter(data[i].lastUpdate)+'</i></span></span></td><td label="time_call"><span><span class="time_call" data-view="listing"><i time="">'+timeConverter(data[i].time_call)+'</i></span></span></td><td label="timeClient"><span><span class="timeClient" data-view="listing"></span></span></td><td label="postIndex"><span>'+postIndex_h+'</span></td><td label="region"><span>'+region_h+'</span></td><td label="city"><span>'+city_h+'</span></td><td label="address"><span>'+address_h+'</span></td><td label="house"><span>'+house_h+'</span></td><td label="flat"><span>'+flat_h+'</span></td></td><td label="total"><span>'+data[i].total+'</span></td><td label="approvedAt"><div>'+timeConverter(data[i].approvedAt)+'</div></td><td label="shippedAt"><span>'+timeConverter(data[i].shippedAt)+'</span></td><td label="canceledAt"><span>'+timeConverter(data[i].canceledAt)+'</span></td><td label="buyoutAt"><span>'+timeConverter(data[i].buyoutAt)+'</span></td><td label="refundedAt"><span>'+timeConverter(data[i].refundedAt)+'</span></td><td label="liveinformId"><span>'+data[i].liveinformId+'</span></td><td label="liveinform"><span>'+data[i].liveinform+'</span></td><td label="size"><span>'+size_h+'</span></td><td label="completely"><span>'+data[i].completely+'</span></td><td label="dop1"><span>'+dop1_h+'</span></td><td label="domain2"><span>'+domain2_h+'</span></td></tr>');
                }
            //     // var data_length = Object.keys( data[i] ).length;

            }
            
        }
      });
}

function goodsNames(goods_names){
    if(goods_names.length == 0){return ''}
    var buf = JSON.parse(goods_names);
    var data = '<span class="goods_names" data-view="listing">';
    for (var key in buf) {
        data += '<b good="">' + buf[key].name + '</b>';
    }
    data += '</span>';

    return data;
}

function timeConverter(UNIX_timestamp){
    if(UNIX_timestamp){
        var a = new Date(UNIX_timestamp * 1000);
        var months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = (a.getMinutes()<10?'0':'')+a.getMinutes();
        var sec = a.getSeconds();
        var time = date + '.' + month + '.' + year + ' ' + hour + ':' + min;
        return time;
    }else{
        return '<i time>Нет данных</i>';
    }
  }

  function timeConverterHH(UNIX_timestamp){
    var a = new Date(UNIX_timestamp * 1000);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
    return time;
  }