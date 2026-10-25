function phone(data) {
    var ih = data.ih;
    var IDbase = data.IDbase;
    var ID = data.ID;
    var Value = data.Value;
    var Key = data.Key;
    var id = data.KeyID;
    var i = data.i;
    var user = data.user;
    var obgAll = {};

    var $el = $( '<span></span>' );

    $nophone = $( '<span class="nophone" id="nophone' + Key + '' + IDbase + 'g' + i + '">Показать контакты</span>' );
    $nophone.css('display', 'block');

    $el.append( $nophone );

    $('#phoneviev' + Key + '' + IDbase + 'g' + i).css('display', 'none');

    function loadphoned(IDbase, ID, Value, Key, id, i, user, obgAll, ih) {

        var JsonDATA = {};
        JsonDATA.func = 'user';
        JsonDATA.action = 'users_phones';
        JsonDATA.domain = JSCat.domain;
        JsonDATA.token = JSCat.token;
        JsonDATA.user_id = user;

        $.ajax({
            url: '/json/',
            context: {
                'Key': Key,
                'IDbase': IDbase,
                'i': i,
                'ID': ID,
                'user': user,
                'ih': ih
            },
            type: 'POST',
            dataType: 'json',
            data: JsonDATA,
            success: function(s) {

                var Key = this.Key;
                var IDbase = this.IDbase;
                var i = this.i;
                var ID = this.ID;
                var user = this.user;

                if (s.phone != '') {
                    $nophone.css('display', 'none');

                    $phoneviev = $('<span class="phoneviev" id="phoneviev' + Key + '' + IDbase + 'g' + i + '">' + s.phone + '</span>')
                    $phoneviev.css('display', 'block');
                    $el.append( $phoneviev );

                } else {
                    $nophone.css('display', 'none');

                    $phoneviev = $('<span class="phoneviev" id="phoneviev' + Key + '' + IDbase + 'g' + i + '">Телефон не указан</span>')
                    $phoneviev.css('display', 'block');
                    $el.append( $phoneviev );

                }
            }
        });

    }

    $nophone.click(loadphoned.bind(this, IDbase, ID, false, Key, false, i, user, false, ih));

    data.callback( $el );
}