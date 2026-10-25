ymaps.ready(init);
var myMap;
var _window_w=jQuery(window).width();

if (_window_w < 768) {
    var t_width = 59.946552;
    var t_height = 30.314054;
} else {
    var t_width = 57.55021917782294;
    var t_height = 30.62156824568671;
}

function init () {
    var myMap = new ymaps.Map('map', {
        center: [t_width, t_height],
        zoom: 6,
        controls: ['zoomControl']
    }, {
        searchControlProvider: 'yandex#search'
    });

    MyBalloonLayout = ymaps.templateLayoutFactory.createClass(
        '<div class="popover top wow heartBeat">' +
        '<div class="popover-marker"><img src="http://new.infoshell.ru/wp-content/themes/mark_up/img/infoshell2/card/point.svg"></div>' +
        '<div class="arrow"></div>' +
        '<div class="popover-inner">' +
        '$[[options.contentLayout observeSize minWidth=250 maxWidth=300  minHeight=70 maxHeight=350]]' +
        '</div>' +
        '</div>', {
            /**
             * Строит экземпляр макета на основе шаблона и добавляет его в родительский HTML-элемент.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/layout.templateBased.Base.xml#build
             * @function
             * @name build
             */
            build: function () {
                this.constructor.superclass.build.call(this);

                this._$element = $('.popover', this.getParentElement());

                this.applyElementOffset();

                this._$element.find('.close')
                    .on('click', $.proxy(this.onCloseClick, this));
            },

            /**
             * Метод будет вызван системой шаблонов АПИ при изменении размеров вложенного макета.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
             * @function
             * @name onSublayoutSizeChange
             */
            onSublayoutSizeChange: function () {
                MyBalloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);

                if(!this._isElement(this._$element)) {
                    return;
                }

                this.applyElementOffset();

                this.events.fire('shapechange');
            },

            /**
             * Сдвигаем балун, чтобы "хвостик" указывал на точку привязки.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/IBalloonLayout.xml#event-userclose
             * @function
             * @name applyElementOffset
             */
            applyElementOffset: function () {
                this._$element.css({
                    left: -(this._$element[0].offsetWidth / 2),
                    top: -(this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight)
                });
            },

            /**
             * Используется для автопозиционирования (balloonAutoPan).
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ILayout.xml#getClientBounds
             * @function
             * @name getClientBounds
             * @returns {Number[][]} Координаты левого верхнего и правого нижнего углов шаблона относительно точки привязки.
             */
            getShape: function () {
                if(!this._isElement(this._$element)) {
                    return MyBalloonLayout.superclass.getShape.call(this);
                }

                var position = this._$element.position();

                return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                    [position.left, position.top], [
                        position.left + this._$element[0].offsetWidth,
                        position.top + this._$element[0].offsetHeight + this._$element.find('.arrow')[0].offsetHeight
                    ]
                ]));
            },

            /**
             * Проверяем наличие элемента (в ИЕ и Опере его еще может не быть).
             * @function
             * @private
             * @name _isElement
             * @param {jQuery} [element] Элемент.
             * @returns {Boolean} Флаг наличия.
             */
            _isElement: function (element) {
                return element && element[0] && element.find('.arrow')[0];
            }
        }),

        // Создание вложенного макета содержимого балуна.
        MyBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div class="popover-content">$[properties.balloonContent]</div>'
        ),

        // Создание метки с пользовательским макетом балуна.
        myPlacemark = window.myPlacemark = new ymaps.Placemark([59.962552, 30.314054], {
            balloonContent: '<img src="http://new.infoshell.ru/wp-content/themes/mark_up/img/infoshell2/main.svg" width="72" height="76">' + '<span><b>Saint-Petersburg:</b> Kamennoostrovskiy Avenue, 26-28</span>'
        }, {
            balloonShadow: false,
            balloonLayout: MyBalloonLayout,
            balloonContentLayout: MyBalloonContentLayout,
            balloonPanelMaxMapArea: 0,
            // Не скрываем иконку при открытом балуне.
            // hideIconOnBalloonOpen: false,
            // И дополнительно смещаем балун, для открытия над иконкой.
            // balloonOffset: [505, -140]
        });
		

        // Создание метки с пользовательским макетом балуна.
        myPlacemarkMoscow = window.myPlacemarkMoscow = new ymaps.Placemark([55.77304557422884, 37.59158522718112], {
            balloonContent: '<img src="http://new.infoshell.ru/wp-content/themes/mark_up/img/infoshell2/main.svg" width="72" height="76">' + '<span><b>Moscow:</b> 1st Tverskaya-Yamskaya Street, 16/23, office 8'
        }, {
            balloonShadow: false,
            balloonLayout: MyBalloonLayout,
            balloonContentLayout: MyBalloonContentLayout,
            balloonPanelMaxMapArea: 0,
            // Не скрываем иконку при открытом балуне.
            // hideIconOnBalloonOpen: false,
            // И дополнительно смещаем балун, для открытия над иконкой.
            // balloonOffset: [505, -140]
        });

    myMap.geoObjects.add(myPlacemarkMoscow).add(myPlacemark);
	
    Map_Width(myMap);
    $(window).resize(function(){Map_Width(myMap)});
}


function Map_Width(myMap){
    var _window_w=jQuery(window).width();
    // document.getElementById('map').scrollIntoView();


    if (_window_w < 768) {
        myMap.panTo([59.940552, 30.314054]);
    } else {
        myMap.panTo([57.55021917782294, 30.62156824568671]);
    }

}

