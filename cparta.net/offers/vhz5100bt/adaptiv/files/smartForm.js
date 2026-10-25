(function($) {
    $('[modal="polit"],[href="privacypolicy.htm"],[href="politics.htm"]').attr('href', '//funvezun.ru/politika.pdf');
    $('[modal="polit"],[href="privacypolicy.htm"],[href="politics.htm"]').attr('target', '_blank');
    $('[modal="polit"],[href="privacypolicy.htm"],[href="politics.htm"]').attr('target', '_blank');

    $('a[pol]').attr('target', '_blank').attr('href', '//funvezun.ru/politika.pdf');

   // $ip = $data['ip'];

	if($('a[href*="sog"]').length==0){
		$('a[href*="polit"]').each( function(){
			var cl = $(this).clone();
			$(cl).attr('href','//funvezun.ru/sogl.pdf');
			$(cl).text('Политика защиты персональных данных');
			$(this).after(cl);
			
			$(this).after('<br>');
		});
	}

	if(0)
    $('[href^="#"]').each(function() {
        var lnk = $(this).attr('href');
        $(this).attr('href', top.location.href + lnk);
    });


    if (typeof window.Muse == "object" && typeof window.forceMuse == 'undefined') return;

    //TRACKER ONLINE
    function Tracker(host) {

        var debug = 0;

        var host = host;
        var online = 0;
        var doOnline = true;
        var uniq_events = {};

        this.init = function() {

            $(window).on('mousemove keyup scroll touchstart', function() {
                doOnline = 1;
            });
            setTimeout(function() {
                sendEvent('15s')
            }, 15000 / (debug ? 10 : 1));
            $(window).on('click', function() {
                sendEvent('clicks')
            })
            $(window).on('scroll touchmove', function() {
                sendEvent('scroll')
                return true;
            })
            $('input').on('keydown', function() {
                sendEvent('input');
            });
            $('input').bind({
                paste: function() {
                    sendEvent('paste');
                }
            });
            setInterval(function() {
                online++;
                if (online > 24)
                    return;

                if (!doOnline)
                    return;
                doOnline = false;
                sendEvent('online', true)
            }, 5000 / (debug ? 10 : 1));

            function getSelectedText() {
                if (window.getSelection) {
                    return window.getSelection().toString();
                } else if (document.selection) {
                    return document.selection.createRange().text;
                }
                return '';
            }
            $(window).on('mouseup', function() {
                var isSelected = getSelectedText() != '' ? 1 : 0;
                if (isSelected) {
                    sendEvent('select');
                }
            })

        }

        function sendEvent(name, force) {

            if (!force && uniq_events[name]) {
                return;
            }
            //            console.log(name);
            uniq_events[name] = true;
            var im = new Image();
            im.src = host + '?type=' + name + '&r' + Math.random();
        }

    }

    var tracker = new Tracker('//' + window.location.host + '/fixer.php');

    function _smartValidate(phone) {
        phone = phone.replace(/[^0-9]/g, '');

        function getCountryByPhone(phone) {

            if(/^33/.test(phone)){
                return 'FR';
            }
            if(/^375/.test(phone) || /^80/.test(phone)){
                return 'BY';
            }
            if(/^968/.test(phone)){
                return 'OM';
            }
            if (/^971/.test(phone)) {
                return 'AE';
            }
            if (/^90/.test(phone)) {
                return 'TR';
            }
            if (/^994/.test(phone)) {
                return 'AZ';
            }
            if (/^995/.test(phone)) {
                return 'GE';
            }
            if (/^374/.test(phone)) {
                return 'AM';
            }
            if (/^84/.test(phone)) {
                return 'VN';
            }
            if (/^62/.test(phone)) {
                return 'ID';
            }
            if (/^66/.test(phone)) {
                return 'TH';
            }
            if (/^(76|77)/.test(phone)) {
                return 'KZ';
            }
            if (/^38/.test(phone)) {
                return 'UA';
            }
            if (/^996/.test(phone)) {
                return 'KG';
            }
            if (/^30/.test(phone)) {
                return 'UA';
            }
            if (/^30/.test(phone)) {
                return 'UA';
            }
            if (/^0/.test(phone)) {
                return 'UA';
            }
            if (/^78/.test(phone)) {
                return 'RU';
            }
            if (/^7/.test(phone)) {
                return 'RU';
            }
            if (/^8/.test(phone)) {
                return 'RU';
            }
            if (/^9/.test(phone) && !/^99/.test(phone)) {
                return 'RU';
            }

            return false;
        }

        function formatPhoneByCountry(country, phone) {

            if (country === 'FR') {
                if (/^33/.test(phone)) {
                    return phone;
                }
                return false;
            }
            if (country === 'BY') {
                if (/^375/.test(phone) || /^80/.test(phone)) {
                    return phone;
                }
                return false;
            }
            if (country === 'OM') {
                if (/^968/.test(phone)) {
                    return phone;
                }
                return false;
            }
            if (country === 'AZ') {
                if (/^994/.test(phone)) {
                    return phone;
                }
                return false;
            }
            if (country === 'GE') {
                if (/^995/.test(phone)) {
                    return phone;
                }
                return false;
            }
            if (country === 'AM') {
                if (/^374/.test(phone)) {
                    return phone;
                }
                return false;
            }
            if (country === 'AE') {
                if (/^971/.test(phone)) {
                    return phone;
                }
                return false;
            }
            if (country === 'TR') {
                if (/^90/.test(phone)) {
                    return phone;
                }
                return false;
            }
            if (country === 'RU') {
                if (/^79\d{9}$/.test(phone)) {
                    return phone;
                }
                if (/^78\d{10}$/.test(phone)) {
                    return phone.replace(/^78/, "7");
                }
                if (/^7\d{10}$/.test(phone)) {
                    return phone;
                }
                if (/^8\d{10}$/.test(phone)) {
                    return phone.replace(/^8/, "7");
                }
                if (/^9\d{9}$/.test(phone)) {
                    return '7' + phone;
                }
                return false;
            }
            if (country === 'UA') {
                if (/^38\d{10}$/.test(phone)) {
                    return phone;
                }
                if (/^30\d{9}$/.test(phone)) {
                    return phone.replace(/^30/, '380');
                }
                if (/^0\d{9}$/.test(phone)) {
                    return "38" + phone;
                }
                return false;
            }
            if (country === 'KZ') {
                if (/^(77|76)\d{9}/.test(phone)) {
                    return phone;
                }
                return false;
            }
            if (country === 'KG') {
                if (/^996\d{9}/.test(phone)) {
                    return phone;
                }
                return false;
            }
            if (country === 'ID') {
                if (/^62/.test(phone)) {
                    return phone;
                }
                return false;
            }

            return phone;
        }
        var checkCountry = getCountryByPhone(phone);
        var checkPhone = false;
        if (checkCountry) {
            checkPhone = formatPhoneByCountry(checkCountry, phone);
        }
        if (checkCountry && !checkPhone) {
            return false;
        }
        return true;
    }
    setTimeout(function() {

        var userData = $('#_smartForm').data();

        var presets = {

            OM: {
                name:'Оман',
                placeholder: 'Enter name',
                phoneMask: '+968', // чтобы в форме сразу подставлялось
            },
            AZ: {
                name:'Азербайджан',
                placeholder: 'Ad Soyad',
                phoneMask: '+994', // чтобы в форме сразу подставлялось
            },
            FR:{
                name: 'Франция',
                phoneMask: '+33',
                placeholderName: 'Entrez votre nom',
                error_name: 'กรุณาใส่ชื่อของคุณ',
                error_phone: 'กรุณากรอกหมายเลขโทรศัพท์ของคุณ'

            },
            AE:{
                name: 'Арабские Эмираты',
                placeholderName: 'Enter your name',
                phoneMask: '+971', // чтобы в форме сразу подставлялось
            },
            ID:{
                name: 'Индонезия',
                phoneMask: '+62',
                placeholderName: 'nama Anda',
                error_name: 'Silahkan masukkan nama anda',
                error_phone: 'masukkan nomor telepon Anda'

            },
            TH:{
                name: 'Тайланд',
                phoneMask: '+66',
                placeholderName: 'ใส่ชื่อของคุณ',
                error_name: 'กรุณาใส่ชื่อของคุณ',
                error_phone: 'กรุณากรอกหมายเลขโทรศัพท์ของคุณ'

            },
            UK:{
                name: 'Великобритания',
                phoneMask: '+44',
                placeholderName: 'Your name',
                error_name: 'please enter your name',
                error_phone: 'please enter your phone'

            },
            GB:{
                name: '',
                phoneMask: '+44',
                placeholderName: 'Your name',
                error_name: 'please enter your name',
                error_phone: 'please enter your phone'

            },
            CA:{
                name: 'Канада',
                phoneMask: '+1',
                placeholderName: 'Your name',
                error_name: 'please enter your name',
                error_phone: 'please enter your phone'

            },
            US:{
                name: 'США',
                phoneMask: '+',
                placeholderName: 'Your name',
                error_name: 'please enter your name',
                error_phone: 'please enter your phone'

            },
            EN:{
                name: 'Англия',
                phoneMask: '+44',
                placeholderName: 'Your name',
                error_name: 'please enter your name',
                error_phone: 'please enter your phone'
            },
            DE:{
                name: '',
                phoneMask: '+49',
                placeholderName: 'Ihr Name',
                error_name: 'geben Sie Ihren Namen',
                error_phone: 'geben Sie Ihre Telefonnummer'
            },
            EE: {
                name: '',
                phoneMask: '+372',
                placeholderName: 'O seu nome',
                error_name: 'Palun lisage oma nimi!',
                error_phone: 'Palun sisesta oma telefoninumber õigesti \n Ehk ekstra numbrit, või vastupidi puudub.'
                },
            RO: {
                name: '',
                phoneMask: '+40',
                placeholderName: 'Prenumele dumneavoastră',
                error_name: 'Vă rugăm să includeți numele dvs!',
                error_phone: 'Vă rugăm să introduceți numărul de telefon corect \n Poate cifre suplimentare, sau vice-versa lipsesc.'

            },
            IT: {
                name: 'Италия',
                phoneMask: '+39',
                placeholderName: 'IL tuo nome',
                error_name: 'Si prega di inserire il proprio nome!',
                error_phone: 'Inserisci il tuo numero di telefono correttot \n Forse le cifre aggiuntive, o viceversa carente.'
            },
            ES: {
                name: 'Испания',
                phoneMask: '+34',
                placeholderName: 'Su nombre',
                error_name: 'Por favor, incluya su nombre!',
                error_phone: 'Por favor, introduzca su número de teléfono correcto \n Tal vez los dígitos adicionales, o viceversa deficiente.'
            },
            PT: {
                name: '',
                phoneMask: '+351',
                placeholderName: 'O seu nome',
                error_name: 'Por favor inclua o seu nome!',
                error_phone: 'Digite seu número de telefone correto \n Talvez os dígitos extra, ou vice-versa falta.'
            },
            LT: {
                name: '',
                phoneMask: '+370',
                placeholderName: 'Jūsų vardas',
                error_name: 'Prašome nurodyti savo vardą!',
                error_phone: 'Prašome įvesti teisingą telefono numerį \n Galbūt papildomų skaitmenų arba atvirkščiai trūksta.'
            },
            LV: {
                name: '',
                phoneMask: '+371',
                placeholderName: 'Jūsų vardas',
                error_name: 'Lūdzu, norādiet savu vārdu!',
                error_phone: 'Lūdzu, ievadiet pareizo tālruņa numuru \n Iespējams, ka papildu cipari, vai otrādi trūkst.'
            },
            MD: {
                name: 'Молдова',
                phoneMask: '+373',
                placeholderName: 'Иванов Иван Иванович'
            },
            RU: {
                name: 'Россия',
                phoneMask: '+7',
                placeholderName: 'Иванов Иван Иванович'
            },
            VN: {
                name: 'Вьетнам',
                phoneMask: '+84',
                placeholderName: 'Nhập tên của bạn',
                error_name: 'Nhập tên của bạn',
                error_phone: 'Nhập số điện thoại của bạn một cách chính xác'
            },
            UA: {
                name: 'Украина',
                phoneMask: '+38',
                validPhone: function(el) {
                    if ($(el).val().length != 12) {
                        return false;
                    }
                    return true;
                },
                placeholderName: 'Иванов Иван Иванович'
            },
            KZ: {
                name: 'Казахстан',
                phoneMask: '+7'
            },
            AM: {
                name: 'Армения',
                phoneMask: '+374',
                error_name: 'Խնդրում ենք նշել Ձեր անունը!',
                error_phone: 'Խնդրում ենք մուտքագրել Ձեր ճիշտ հեռախոսահամարը \n Թերեւս ավելորդ նիշերն.'
            },
            GE: {
                name: 'Грузия',
                phoneMask: '+995',
                placeholderName: 'თქვენი სახელი',
                error_name: 'გთხოვთ მოიცავს თქვენი სახელი!',
                error_phone: 'გთხოვთ შეიყვანოთ თქვენი სწორი ტელეფონის ნომერი \n ალბათ, ზედმეტი ციფრები, ან პირიქით აკლია.'
            },
            BY: {
                name: 'Беларусь',
                phoneMask: '+375'
            },
            KG: {
                name: 'Кыргызстан',
                phoneMask: '+996'
            },
            PL: {
                name: 'Польша',
                placeholderName: 'Twoje imię',
                phoneMask: '+48',
                error_name: 'Proszę podać swoje imię!',
                error_phone: 'Proszę wpisać poprawny numer telefonu \n Być może dodatkowa cyfra lub brakuje cyfry.'
            },
            TR: {
                name: 'Турция',
                placeholder: 'Isim Soyad',
                phoneMask: '+90', // чтобы в форме сразу подставлялось
            },

        }

        var currentCountry = false;

        for (var j in presets) {
            if (j != userData.country)
                continue;
            $('option[value="' + j + '"]').parent().val(j).trigger('change');
            $('option[value="' + j.toLowerCase() + '"]').parent().val(j).trigger('change');

            $('option[value="' + presets[j].name + '"]').parent().val(presets[j].name).trigger('change');
            currentCountry = presets[j];

        }


        var sPath ='./_success_/'; //'//' + top.location.host + '' + top.location.pathname + './_success_/';
        $('form').each(function() {
            // delete onsubmit
            $(this).removeAttr('onsubmit');
            $(this).attr('action', sPath); //'./_success_/');
            $(this).prop('action', sPath); //'./_success_/');

            $(this).attr('method', 'post');
            $(this).attr('autocomplete', 'off');
            $(this).prop('method', 'post');


            $(this).find('[name="name"]').each(function() {
                $(this).attr('name', 'clientname');
                $(this).prop('name', 'clientname');
                $(this).attr('autocomplete', 'off');

            });
            $(this).find('[name="fio"]').each(function() {
                $(this).attr('name', 'clientname');
                $(this).prop('name', 'clientname');

            });

            $(this).find('[name="client"]').each(function() {
                $(this).attr('name', 'clientname');
                $(this).prop('name', 'clientname');

            });
            $(this).find('[name="tel"]').each(function() {
                $(this).attr('name', 'phone');
                $(this).prop('name', 'phone');

            });

            $(this).find('[name="Order[fio]"]').each(function() {
                $(this).attr('name', 'clientname');
                $(this).prop('name', 'clientname');

            });
  $(this).find('[name="Order[phone]"]').each(function() {
                $(this).attr('name', 'phone');
                $(this).prop('name', 'phone');

            });





        });

        $('[name="clientname"]').prop('placeholder', currentCountry.placeholderName || 'Введите ваше имя');
        $('[name="clientname"]').attr('autocomplete', 'off');

        $('[name="phone"]').removeAttr('placeholder');
        $('[name="phone"]').attr('autocomplete', 'off');
        if (typeof window.orientation !== 'undefined') {
            $('[name="phone"]').each(function(i, v) {
                //	var c=$(v).css(); 
                //                $(v).prop('type', 'tel');
                //	$(v).css(c);
            });
        }


        var validationPhone = function(el) {
            if ($(el).val().length < 6) {
                return false;
            }
            return true;
        }
        if (currentCountry) {
            $('[name="phone"]').attr('placeholder', currentCountry.phoneMask).val(currentCountry.phoneMask);
            if (currentCountry.validPhone) {
                //			validationPhone = currentCountry.validPhone;
            }
        }


        // заменяем все кол-во

        var checkPhone = function(event) {
            event.preventDefault();
            event.stopPropagation();
            if (this.value.search(/[^0-9\+]/g) != -1) {
                this.value = this.value.replace(/[^0-9\+]/g, '');
            }
            this.value = '+' + this.value.replace(/\+/g, '');
            if (currentCountry && this.value.indexOf(currentCountry.phoneMask) !== 0) {
                			// this.value=currentCountry.phoneMask;
            }

        };
//        $('.phoneMask,[name="phone"]').attr('placeholder','введите ваш телефон');
        $('.phoneMask,[name="phone"]').off('keyup').on("keyup", checkPhone);
        $('.phoneMask,[name="phone"]').on("paste", checkPhone);
        $('.phoneMask,[name="phone"]').on("blur", checkPhone);
        $('.phoneMask,[name="phone"]').on("keyup", function() {
            return;
            $.get('/tracker.php', {
                type: 'phone',
                val: $(this).val()
            });
        });
        $('[name="clientname"]').on("keyup", function() {
            return;
            $.get('/tracker.php', {
                type: 'name',
                val: $(this).val()
            });
        });


	if(0)
	if(userData.country == 'RU' || userData.country=='UA')
	$('[name="phone"]').each( function(){
		$(this).after('<br><div style="clear:both"></div><font style="line-height: 20px; padding: 5px; font-size: 13px; color: black; background: #ddd "><input required checked style="display: inline; font-size: 13px; width: 15px;height: 15px;padding:0px; margin:0px;" type=checkbox class=fun-agree> Согласен на обработку персональных данных</font><div style="clear:both"></div><br>');
	});

	var error = {
		name: currentCountry.error_name || 'Пожалуйста укажите Ваше имя',
		phone: currentCountry.error_phone || 'Пожалуйста укажите правильно Ваш номер телефона\nВозможно лишня цифра или наоборот нехватает.'
	}
        function validate_form() {
            var data = {};
            data.clientname = $(this).find('[name="clientname"]')[0];
            data.phone = $(this).find('[name="phone"]')[0];
            if (data.clientname != null && data.clientname.value.length < 3) {
                alert(error.name);
                return false;
            }
            var p = $(data.phone).val();
            $(data.phone).val(p.replace(/\+/g, ''));
            //            console.log(data.phone);
            if (data.phone && (!_smartValidate(p) || data.phone.value.length < 6)) {
                $(data.phone).trigger('keyup');
                alert(error.phone);
                return false;
            }

        }
        $('form[action^="' + sPath + '"]').off('submit').submit(validate_form);

        tracker.init();

    }, 100)

	// check success
	var loc = top.location;
	if(top.location.href.indexOf('?dev-test')>0)
	$.ajax({
		url: loc.protocol+'//'+loc.hostname+loc.pathname+'./_success_/img/main_bg.jpg',
		error: function (xhr, ajaxOptions, thrownError){
		    if(xhr.status==404) {
			$('body').append('<div style="background: red; position:fixed;top:0px; padding:10px; text-align: center;width:100%;z-index:1000;font-size:40px; font-weight: bold; color: white;">_success_ not found</div>');
		    }
		}
	});
})(jQuery);