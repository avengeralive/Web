<html>
    <link rel=stylesheet href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css>
    <link rel=stylesheet href="/templates/default/css/jquery.formstyler.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/templates/default/js/jquery.formstyler.min.js"></script>

    <div class="container">

        <table width="100%" class="table">
            <tr>
                <td>Шаг1. Выбрать оферы</td>
                <td width="70%"><Select  name="offers[]" id="js-offers" >
                        <?php
                        foreach (Offer::getAll('id desc') as $offer) {
                            echo "<option data-offer=\"" . htmlspecialchars(json_encode(['id' => $offer->id, 'd' => strip_tags(htmlspecialchars_decode($offer->descr)), 'name' => $offer->name, 'geo' => $offer->geo, 'comission' => $offer->comission])) . "\" value={$offer->id}>{$offer->name}</option>";
                        }
                        ?>
                        &nbsp;
                        <input type="button" id="js-select-offer" value="Добавить в список" class="btn btn-info">
                    </Select>
                </td>
            </tr>
            <tr>
                <td>Шаг2. Список оферов</td>
                <td width="70%"><pre id="list">
                    </pre>

                </td>
            </tr>
            <tr>
                <td>
                    Шаг3. Выбрать действие
                </td>
                <td>
                    <input type="button" data-type="changeComission" class="btn btn-default tpl" value="Изменение отчислений"> <Br><Br>
                    <input type="button" data-type="newOffer" class="btn btn-default tpl" value="Новые оферы"><Br><Br>
                    <input type="button" data-type="stopOffer" class="btn btn-default tpl" value="Приостановка оферов"><Br><Br>
                    <input type="button" data-type="geo" class="btn btn-default tpl" value="Расширение ГЕО"><Br><Br>
                </td>
            </tr>

        </table>
    </div>
    <script>
        $(function () {
            $('select').styler({
                selectSearch: true,
                selectSearchLimit: 12,
                width: 500
            });
            var offers = [];
            function render() {
                $('#list').html('');
                var html = '';
                offers = offers.filter(function (e) {
                    return e;
                });
                for (i = 0; i < offers.length; i++) {
                    var line = '';
                    var data = $('#js-offers option[value="' + offers[i] + '"]').data();
                    console.log(data.offer)
                    line += '<span data-id=' + i + '>' + data.offer.name + " <a href=# class=js-delete>[x]</a></span><br>";
                    html += line;
                }
                $('#list').html(html);
            }
            $(document).on('click', '.js-delete', function () {
                var id = $(this).parent().data('id');
                delete offers[id];
                render();
                return false;
            })
            $(document).on('click', '.tpl', function () {
                // немного говнокода, сорри
                
                var type = $(this).data('type');
                var html = '';
                if (type == 'stopOffer') {
                    html += '<h2>Следующие оферы были временно остановлены</h2><table width=100% cellpadding=10 cellspacing=0>';
                    for (var i = 0; i < offers.length; i++) {
                        var offer = $('#js-offers option[value="' + offers[i] + '"]').data().offer;
                        html += '<tr><Td style="border-bottom:2px solid #f0f0f0" valign=top height=40 width=50><img width=50 src="https:///tmp/offer' + offer.id + '.png"></td><td>' + offer.name + '</td></tr>';
                    }
                    html += '</table>';
                }
                if (type == 'geo' || type == 'changeComission' || type == 'newOffer') {
                    if (type == 'geo') {
                        html += '<h2>Расширение ГЕО</h2><table width=100% cellpadding=10 cellspacing=0>';
                    }
                    if (type == 'changeComission') {
                        html += '<h2>Изменение отчислений</h2><table width=100% cellpadding=10 cellspacing=0>';
                    }
                    if (type == 'newOffer') {
                        html += '<h2>Новые оферы! </h2><table width=100% cellpadding=10 cellspacing=0>';
                    }
                    for (var i = 0; i < offers.length; i++) {
                        var offer = $('#js-offers option[value="' + offers[i] + '"]').data().offer;
                        html += '<tr><Td style="width:100px; padding:20px; border-bottom:2px solid #f0f0f0" valign=top height=40 width=100><img width=100 src="https:///tmp/offer' + offer.id + '.png"></td>';
                        html += '<td valign=top style="padding:20px; border-bottom:2px solid #f0f0f0"><h3><b><u>' + offer.name + '</u></b></h3><i>' + offer.d + '</i><br><br>';

                        if (type == 'geo') {
                            html += '<h4>Список текущих гео: </h4>';
                        }
                        if (type == 'changeComission') {
                            html += '<h4>Новые отчисления: </h4>';
                        }
                        if (type == 'newOffer') {
                            html += '<h4>Отчисления офера: </h4>';
                        }

                        var list = offer.geo.split('|')[0].split(':');
                        var comission = offer.comission.split('|');
                        for (var j = 0; j < list.length; j++) {
                            var fav = 'Все ГЕО &mdash; ';
                            if (list[j] && (list[j] !== '' && list[j]!=='0')) {
                                fav = '<img src="https:///modules/detectclient/SxGeo/img/' + list[j].toLowerCase() + '.png">';
                            }


                            html += fav + ' <b>' + comission[j] + ' руб. </b> <br>';
                        }
                        html += '<br><BR><a href="http:///offers.php?offer=' + offer.id + '" style="background: #00C8AD;color: #fff;font-size: 15px;padding: 7px 25px;border-radius: .25rem;line-height: 1.5;border: 1px solid transparent;display: inline-block;font-weight: 400;    text-align: center;    white-space: nowrap;    vertical-align: middle;    text-decoration: none;    cursor: pointer;" >Начать работу с офером</a></td></tr>';

                    }
                    html += '</table>';

                }
                window.opener.setHtml(html);
                window.close();
                $('body').append(html);
            })
            $(document).on('click', '#js-select-offer', function () {
                offers.push($('#js-offers').val());
                render();
            })
        })
    </script>