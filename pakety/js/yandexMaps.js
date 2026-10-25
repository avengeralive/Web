//!--------------------------------Яндекс Карты-----------------------------------
function getMap(mapObjects){
	if(typeof ymaps == "undefined"){
		$.getScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU", function(){
			processMap(mapObjects);
		});
	}else{
		processMap(mapObjects);
	}
}


function processMap(mapObjects){
	var map = {};

	//Создание карт
	ymaps.ready(function(){
		for(mapKey in mapObjects){
			var object = mapObjects[mapKey];

			//Инициализация карты
			map[mapKey] = new ymaps.Map(object.toId, {
				center: object.center
				,zoom: object.zoom
				,controls: ['smallMapDefaultSet']
			});
			map[mapKey].behaviors.disable('scrollZoom');


			//Объекты на карте
			placemarksCollection = new ymaps.GeoObjectCollection(null, {
				iconLayout:		"default#image"
				//,iconImageHref:	"marker_red.png"
				//,iconImageSize:	[30, 48]
			});
			for(placemarkKey in object.placemarks){
				var placemark = object.placemarks[placemarkKey];
				placemarksCollection.add(new ymaps.Placemark(placemark.coordinates, {
					id:						placemark.id
					,hintContent:			placemark.title
					,balloonContentBody:	[placemark.description].join('')

				}));
			}
			map[mapKey].geoObjects.add(placemarksCollection);
		}
		
		
		//Открытие пункта на карте по клику на ссылке
		$('body').on('click', 'a.mapShow', function(e){
			e.preventDefault();
			var data = $(this).data();
			
			map[data.map].geoObjects.each(function(geoObject){
				for(i=0; i<geoObject.getLength(); i++){
					if(geoObject.get(i).properties.get('id') === data.placemark){
						//Центровка карты
						map[data.map].setCenter(geoObject.get(i).geometry.getBounds()[0], 11, {
							duration: 500
						});
						
						//Открытие описания
						geoObject.get(i).balloon.open();
						$('html:not(:animated),body:not(:animated)').animate({scrollTop:$("#"+data.map).offset().top-50}, 500);
						break;
					}
				}
			});
		});
	});
}