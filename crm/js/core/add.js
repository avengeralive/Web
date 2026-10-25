var cFloadAlbums = 0,
	photoAlbum;

function add(param) {
	$('.dr2').remove();
	$('#list_form1').remove();
	$('#list_form2').remove();
	$('#list_form3').remove();
	var context = this;

	GLOBAL.current.list_id = param.id;

	renderer.get.listIfUndefined( {
		list_id:	param.id
	}, function( list ){
		GLOBAL.cache.lists[param.id] = list;
		formEditAdd({
			'param': param,
			'd': list
		})
	});
}

function formEditAdd(data) {
//console.log(data)
	var param = data.param;
	var d = data.d;
	var container = document.createElement("div");
	$(container).append(d.html5)
	$(param.formContent).append(container);
	//сохранение формы
	renderer.draw.onReady(
		renderer.cfg.selectors.form_action_save, function() {
			setTimeout(function(){
				// if (save_form = document.getElementById('save')) {
				if (save_form = $(renderer.cfg.selectors.form_action_save).get(0)) {
					var form_options = $(save_form).data('options') || {};
					// insert/edit
					var item_id = 0;
					try {
						if (form_options.data.id)
							item_id = form_options.data.ids;
					} catch (ex) {}
					$( renderer.cfg.selectors.form_action_save ).unbind('click').click(function(event) {
						//проверка на обязательные поля
						var compare = false;
						
						//формируем данные для отправки
						var json = {};
						json.user = JSCat.user;
						json.list_id = param.id;
						json.action = "add1";
						json.func = 'CEditCat';
						json.field = {};
						
						// GEO data save
						var $geo_container = $( save_form ).parent().parent().parent().find('.geo:first');
						json.field.geo = '';
						if( $geo_container.length ) {
							try {
								json.field.geo = $geo_container.attr( 'data-form' );
							} catch (ex) {
							console.log('error geo_container');
							}
						}
						//console.log(d.field);
						for (var key3 in d.field) {
							json.field[key3] = '';

							var $items = $( '.' + key3 + '[data-view="add"]' );
							if( $items.length > 1 ) {
								var filters = new Array( '[data-form]', 'input', 'select', 'textarea' );
								for( var k = 0;k < filters.length;k++ ) {

									var $search_field = $items.filter( filters[k] );

									if( $search_field.length ) {
										field = $search_field.get(0);
										break;
									}
								}

							} else {
								field = $items.get(0);
							}

							//проверка на обязательные поля//
							if( field ) {
								// Проверка наличия символа ' и пустого поля
								json.field[key3] = json.field[key3].replace(/'/g, ''); //не хавает

								if (typeof($(field).attr('data-form')) != 'undefined')
									json.field[key3] = $(field).attr('data-form');
								else
									json.field[key3] = '';

								if (d.field[key3].required == '1') {
									if (json.field[key3] == '') {
										var field_value = $(field).attr('value') || field.value;
										json.field[key3] = field.value;
									}
									var data = json.field[key3];
									if (
									((d.field[key3].type == 'text'      ||  
									d.field[key3].type == 'textarea'    || 
									d.field[key3].type == 'textint'     || 
									d.field[key3].type == 'youtube') && data.length <= 0      )||
									( d.field[key3].type == 'select'      && data == '0'      )||
									( d.field[key3].type == 'radiobtn'    && !data            )){
										$('.' + key3).addClass('required');
										compare = true;
									} else {
										$('.' + key3).removeClass('required');
									}
									//selectmenu
									if (d.field[key3].type == 'selectmenu' && data == '{}') {
										$('.' + key3 + ' select').addClass('required');
										compare = true;
									} else {
										$('.' + key3 + ' select').removeClass('required');
									}
									//yandex
									if (d.field[key3].type == 'yandex' && !data) {
										$('.' + key3 + ' #searchart' + key3).addClass('required');//для адреса
										$('.' + key3 + ' #canv').parent().addClass('required');//для полигона
										compare = true;
									} else {
										$('.' + key3 + ' #searchart' + key3).removeClass('required');
									}
									//fotoalbum
									if (d.field[key3].type == 'fotoalbum' && data == '{}') {
										$('.' + key3 + ' .listimg0').addClass('required');
										compare = true;
									} else {
										$('.' + key3 + ' .listimg0').removeClass('required');					
									}
								} else {
									if (json.field[key3] == '') {
										var field_value = $(field).attr('value') || field.value;
										json.field[key3] = field.value;
									}
								}
							}
						}
						//если поле не заполнено
						if (compare) {
							alert('Не все обязательные поля заполнены');
							return false;
						}
						//выполнение функции перед отправкой формы
						if( $(this).attr('action-before') ) {
							var func_name = $( this ).attr( 'action-before' );
							if( typeof(window[func_name]) != 'undefined' )
							window[func_name]({
								'IDbase': this.IDbase,
								'd': d,
								'id': item_id,
								'user_id': JSCat.user
							});
						}
						
						//продолжаем формировать данные для отправки
						json.item_id = item_id;
						json.token = JSCat.token;
						json.social = $('.social[data-view="add"]').attr('data-form');
						//console.log(json);
						$.ajax({
							url: '/json/',
							type: 'POST',
							dataType: 'json',
							data: json,

							context: {
								'param': param,
								'list_id': param.id
							},
							success: function(response) {
									 console.log('Опубликовано');
									 if ($(save_form).attr('action'))
									 this.param.FuncEnd = $(save_form).attr('action');
									 //console.log(save_form);
									if (typeof(this.param.FuncEnd) != 'undefined')
										if (typeof(window[this.param.FuncEnd]) != 'undefined')
											window[this.param.FuncEnd]({
												'list_id': this.list_id,
												'd': d,
												'user_id': JSCat.user
											});
								//console.log(response);
								//$(container).remove();

							}

						});
					});
				}
			},500);
		}
	);
};

var coords;
var myMap;
var myGeocoder;
var firstready = false;
var newCenter;

window.yandex_add = function(obj) {
//console.log(obj)
	var $el = $( obj.field );
	firstready = false;
	$el.empty().append('<div class="yandexmap"><input autofocus type="text" id="searchart'+ obj.key +'" placeholder="Например: Москва, ул. Пушкина, д. 4"><label></label><br><div class="yamap"><i id="index' + obj.key + '"></i><span id="cardyandex' + obj.key + '"></span><p id="full' + obj.key + '"><b class="mapcenter">Сначала <a id="mapfocus">укажите адрес</a></b></p></div></div>');

	var data_form = $el.attr('data-form');
	var edit = false;
	if( data_form ) {
		edit = true;
		data_form = JSON.parse( data_form );
		$el.children('div').children('#searchart' + obj.key).val( data_form.ycoradr.address );
		$el.find( '#full' + obj.key ).hide();

	} else {
	
		$el.children('div').children('#searchart' + obj.key).val( JSON.parse(JSCat.city).name );
		data_form = {
			ycoradr: {
				address:	JSON.parse(JSCat.city).name,
				coords:		JSON.parse(JSCat.city).coords
			}
		}
	}

	var functionYandex = function() {

		myGeocoder = ymaps.geocode( $('#searchart' + obj.key).val() );
		myGeocoder.then(
			function(res) {

				if (firstready == true) {
					$('.karta').empty();
					coords = res.geoObjects.get(0).geometry.getCoordinates();
					$('#' + obj.key).attr('data-form', '{"ycoradr":{"coords":"' + coords + '","address":"' + $('#searchart' + obj.key).val() + '"}}');
				} else {
					coords = data_form.ycoradr.coords.split(',');
				}

				myMap = new ymaps.Map('cardyandex' + obj.key, {
					center: coords,
					zoom: 16,
					controls: []
				}, {
					searchControlProvider: 'yandex#search'
				})
				myMap.events.add('boundschange', function(event) {

					function getAddress(ads) {
						ymaps.geocode(ads).then(function(res) {
							var firstGeoObject = res.geoObjects.get(0);
							newCenter = firstGeoObject.properties.get('text');
							
							//формируем объект со всей выдачей геокодера
							var kinds = firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.Address.Components');
							var kinder = kinds.reduce(function(prev, curr) {
								prev[curr.kind] = curr.name;
								return prev;
							}, {});
							kinder = JSON.stringify(kinder).replace(/\[|\]/g, '');
								//console.log(kinder)
							
							//определяем район города
							var raion = '';
							ymaps.geocode(ads, { kind: 'district' }).then(function(res2) {
								raion += res2.geoObjects.get(0).properties.get('name');
							});
										
							$('#index' + obj.key).html('<div class="yandextext">Маркер указывает на: ' + newCenter + '<a id="yandexcool' + obj.key + '">Это верный адрес</a></div>');

							//определяем район города и метро
							function rescool(obj, ads) {
								util.load_script(util.cfg.url.yandex_map, function() {
									ymaps.ready(function() {
										//определяем ближайшие метро
 										ymaps.geocode(ads, { kind: 'metro' }).then(function(res) {
											//i < 2; - количество станций метро
											for (var i = 0; i < 1; i++) {
												metroObj = res.geoObjects.get(i);
												coordsMetro = metroObj.geometry.getCoordinates();
												distance = Math.floor(ymaps.coordSystem.geo.getDistance(ads, coordsMetro));
												//console.log(distance)
												
												if (distance < 8001) {
													branch = metroObj.properties.get('description').split(', ')[2].split(' ')[0];
													if (branch == 'Сокольническая') branch = '1';
													else if (branch == 'Замоскворецкая') branch = '2';
													else if (branch == 'Арбатско-Покровская') branch = '3';
													else if (branch == 'Филёвская') branch = '4';
													else if (branch == 'Кольцевая') branch = '5';
													else if (branch == 'Калужско-Рижская') branch = '6';
													else if (branch == 'Таганско-Краснопресненская') branch = '7';
													else if (branch == 'Калининская') branch = '8';
													else if (branch == 'Калининско-Солнцевская') branch = '9';
													else if (branch == 'Серпуховско-Тимирязевская') branch = '10';
													else if (branch == 'Люблинско-Дмитровская') branch = '11';
													else if (branch == 'Каховская') branch = '12';
													else if (branch == 'Бутовская') branch = '13';
													else if (branch == 'Монорельс') branch = '14';
													else if (branch.split(' ')[0] == 'Московское') branch = '15';
													else branch = '15';
													metroName = metroObj.properties.get('name').replace('метро ', '');
													metroName = metroName.replace('станция ', '');
													var arr = [];
													arr[i] = '"metro":{"branch":"' + branch + '","metroName":"' + metroName + '","distance":"' + Math.round(distance / 100) * 100 + ' м"}';
													var metroadd = arr.toString();
												} else var metroadd = '"metro":{}';
											}
																						
  											$('#' + obj.key).attr('data-form', '{"ycoradr":{"coords":"' + ads + '","address":"' + newCenter + '","raion":"' + raion + '"},"kinds":' + kinder + ',' + metroadd + '}');
 										}).catch(function(metroadd) {
  											$('#' + obj.key).attr('data-form', '{"ycoradr":{"coords":"' + ads + '","address":"' + newCenter + '","raion":"' + raion + '"},"kinds":' + kinder + '}');
										});
									});
								});
								//сохраняем значения
								$('#searchart' + obj.key).val(newCenter);
								
								if (obj.list == '6' || obj.list == '15' || obj.list == '8') {
									
									//инициализируем для отправки
									if (obj.list == '8') var neuron = 'Buildingid';
									if (obj.list == '6' || obj.list == '15') var neuron = 'BusinessShoppingCenter';
									
									function building_id(id, kinder) {
									
										//записываем для отправки
										if (obj.list == '6' || obj.list == '15')
											$('.BusinessShoppingCenter[data-view="add"]').attr('data-form', id); 
										
										var json = {func:'CEditCat', domain:JSCat.domain, token:JSCat.token};
										json["action"] 		= neuron;
										json["param"] 		= 'set';
										json["id"] 			= id; 
										json["kinder"] 		= JSON.parse(kinder); 
										$.post("/json/", json, function(result) {
											$( '.bcjk' ).remove();
											//insert data
											if (typeof result !== 'object') result = JSON.parse(result);
											console.log(result)
										});
									}
									
									//запрашиваем данные для подстановки
									var json = {func:'CEditCat', domain:JSCat.domain, token:JSCat.token};
									json["action"] 		= neuron;
									json["kinder"] 		= JSON.parse(kinder); 
									json["param"] 		= 'get'; 
									$.post("/json/", json, function(result) {
										$('.bcjk').remove();
										if (typeof result !== 'object') result = JSON.parse(result);
										if (result != null) {
											$( '.yamap' ).after('<div class="bcjk"><i>Укажите нужный комплекс для автоматического заполнения параметров</i></div>');
											for (id in result) {
												$( '.bcjk').append('<div building="' + id + '"><b>' + result[id].type + ' ' + result[id].name + '</b>'+ result[id].adress +'</div>');
												$( '.bcjk [building="' + id + '"]').click(building_id.bind(this, id, kinder));
											}
										}
									});
								}
								
								
								
							}
							$('#yandexcool' + obj.key).click(rescool.bind(this, obj, ads));

						});
					}

					getAddress(event.get('newCenter'));

				});
			},
			function(err) {
				alert('Ошибка на стороне Яндекс Карт');
			}
		);
	}

	//util.load_script( util.cfg.url.yandex_map, function() {

		var scripts = {};
			scripts[ util.cfg.url.yandex_map ] = {
			state:		'loading',
			callbacks:	new Array({
				func:	function() {
					ymaps.ready(function(){
						functionYandex();
						if (es = document.getElementById('searchart' + obj.key)) {
							es.onkeypress = function(event) {
								if (event.keyCode == 13) {
									functionYandex(obj);
									firstready = true;
									lastready = false;
									$('#' + obj.key).removeAttr('data-form');
									$('#full' + obj.key).css('display', 'none');
								}
							}
						}

						if (ess = document.getElementById('mapfocus' + obj.key)) {
							ess.onclick = function(event) {
								$('#searchart' + obj.key).focus();
								if ($('#searchart' + obj.key).val() != '') {
									functionYandex(obj);
									firstready = true;
									lastready = false;
									$('#' + obj.key).removeAttr('data-form');
									$('#full' + obj.key).css('display', 'none');
								}
							}

							if ($('#searchart' + obj.key).val() != '')
							$('#mapfocus' + obj.key).click();
						}
					});
				}
			})
		};

		var script = document.createElement( 'script' );
		var done = false;
			
		script.src = util.cfg.url.yandex_map;
		script.type = 'text/javascript';
		script.language = 'javascript';
		script.onload = script.onerror = script.onreadystatechange = function()
		{
			if( !done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete'))
			{
				done = true;
					
				// Handle memory leak in IE
				script.onreadystatechange = null;
				script.parentNode.removeChild(script);

				// выполняем коллбеки
				scripts[ util.cfg.url.yandex_map ].state = 'loaded';
				for( var i = 0;i < scripts[ util.cfg.url.yandex_map ].callbacks.length;i++ )
				scripts[ util.cfg.url.yandex_map ].callbacks[i].func();

			}
		};

		// sync way of adding script tags to the page
		document.body.appendChild( script );
		

	//});

}
photoAlbum = {
	build: '1.0.1',
	options: {},
	actions: {
		dnd: function() {
			//drag-n-drop
					setTimeout(function(){
    					$( "#galler" ).sortable().disableSelection();
    					$( "#galler" ).sortable( "option", "cancel", ".listimg0, p, b" );
    					$( "#galler" ).on( "sortstop", function( event, ui ) {
    						var idsInOrder = $("#galler").sortable('toArray', {attribute: 'data-id'});
    						delete idsInOrder[0];
    						delete idsInOrder[1];
    						delete idsInOrder[2];
    						delete idsInOrder[3];
    						delete idsInOrder[4];
    						delete idsInOrder[5];
    						var ret = {};
    						for (key in idsInOrder) {
    							ret[idsInOrder[key]] = {'img': idsInOrder[key] + '.jpg'}
    						}
    						$('.galleryfield[data-view="add"]').attr('data-form', JSON.stringify(ret));	
    					});
	    			}, 2e3)
		},
		loadPhoto: function(field, files, div_content, IDbase) {
				
			link = '/json/';
			var form = new FormData(),
				xmlhttp = getXmlHttp();

			form.append('Web', JSCat.domain);
			form.append('token', JSCat.token);
			form.append('page', JSCat.page);
			form.append('func', 'CEditCat');
			form.append('action', 'AddFileAlbum');
			form.append('idbase', IDbase);
			form.append('field', field);

			// Если передана строка - отправить как data-url
			if(typeof(files) === 'string') {
				form.append('files_dataurl', files);
			} else {
				form.append('files', files);
			}

			xmlhttp.open('POST', link, true);
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4) {
					if (xmlhttp.status == 200) {
						cFloadAlbums--;

						var b = {};

						if ($('.' + field).attr('data-form') != '') {
							var o = JSON.parse($('.' + field).attr('data-form'));

							for (var key67 in o) {
								b[key67] = o[key67];
							}
						}

						var o2 = JSON.parse(xmlhttp.response);
						//console.log(o2)
						
						if ( o2 == false ) {
							alert('Превышен размер изображения, или неверный формат!');
							return false;
						}
						for (var key672 in o2) {
							b[key672] = o2[key672];
						}

						if (cFloadAlbums == 0) {
							modPhoto(field, JSON.stringify(b), div_content, IDbase);
						} else {
							$('.' + field).attr('data-form', JSON.stringify(b));
						}
					}
				}
			};
			xmlhttp.send(form);
		},
		//форма редактирования
		editPhoto: function(field, response, ELcontent, IDbase) {
			$('.' + field).attr('data-form', response);

			if(response != '') {
				response = JSON.parse(response);
				if(response == false) {
					alert('Превышен размер изображения или неверный формат');
					return false;
				}

				var avaId = undefined;
				for(var imageId in response) {
					if(response.hasOwnProperty(imageId)) {
						photoAlbum.actions.addPhoto(field, imageId, response[imageId], IDbase, ELcontent);
					}
				}
			
				photoAlbum.actions.dnd();
			}
		},

		//добавление изображений
		addPhoto: function(field, imageId, response1, IDbase, ELcontent) {
			var gallery = ELcontent;

			if(!gallery) {
				gallery = $('.gallery');
			}

			var src = JSCat.cdn + '/card/' + IDbase + '/' + response1.img;

			var $item = $('<div data-id="'+ imageId +'" class="listimg">');
			$item.append('<img src="'+ src +'" data-item="'+ imageId +'"/>');
			$item.append('<div data-remove="'+ imageId +'"><span>Удалить</span></div>');
			$(gallery).append($item);

			$item.find('[data-remove="'+ imageId +'"]').click(function() {
				//удаляем значение из data-form
				var $field = $('.' + field);
				var string = $field.attr('data-form');
				var object = JSON.parse(string);

				delete object[imageId];

				//записываем объект обратно
				$field.attr('data-form', JSON.stringify(object));
				$item.remove();
				
			});
		}
	}
}

function modPhoto(field, data, div_content, IDbase) {
	$(div_content).empty();
	// noinspection JSAnnotator
	var div = $('\
		<div id="galler" class="gallery gallery' + field + '">\
			<b>Выберите фотографии на компьютере</b>\
			<p style="color: #888;font-size:11px;">Первая фотография – главная, она будет показана в списке объявлений. Порядок следования фотографий можно менять, просто перетаскивая их. Вы можете добавить до 25 фотографий.</p>\
			<div class="listimg0">\
				<img id="img' + field + '" src="/cdn/lib/camera.svg" />\
				<span>Добавить фото</span>\
				<input id="addfile' + field + '" type="file" multiple accept="image/*" />\
				<input style="display:none;" id="addfiles' + field + '" type="file" multiple accept="image/*" />\
			</div>\
			\
			<img id="original-image" style="display:none;" />\
			<img id="small-image" style="display:none;" />\
			<img id="great-image" style="display:none;" />\
		</div>\
	 ');

	var input = div.children('.listimg0').children('input')[0];
	input.onchange = function(evt) {
		cFloadAlbums = evt.target.files.length;
		if ($('img#imggalleryfield').attr('src') == '/cdn/lib/camera.svg') 
			$('img#imggalleryfield').attr('src', '/cdn/lib/loading.gif');

		for (var i = 0; i < evt.target.files.length; i++) {
			var onSuccess = (function() {
				return function(file) {
					// Если удалось отресайзить - отправить data-uri
					photoAlbum.actions.loadPhoto(field, file, div_content, IDbase);
				}
			})();
			
			var onFailure = (function(originalFile) {
				return function(error) {
					// Если произошла ошибка - загрузить оригинал
					console.log('Unable to resize: sending original image', error);
					photoAlbum.actions.loadPhoto(field, originalFile, div_content, IDbase);
				}
			})(evt.target.files[i]);

			// console.log('resizeImageToSpecificWidth()');
			resizeImageToSpecificWidth(960, input, field, evt.target.files[i], div_content, IDbase, onSuccess, onFailure);
		}
	};

	div.children('.listimg0').children('img')[0].onclick = function() {
		input.click();
	};
	
	div_content.appendChild(div[0]);
	photoAlbum.actions.editPhoto(field, data, div[0], IDbase);
}

//изменение размера с помощью канвы
function resizeImageToSpecificWidth(maxWidth, input, field, file, div_content, IDbase, onSuccess, onFailure) {
	try {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(event) {
				var img = new Image();
				img.onload = function() {
					// В эту переменную нужно записать data-url итогового изображения для отправки на сервер
					var fileSrc;
					try {
						if (img.width > maxWidth) {
							var oc = document.createElement('canvas'), octx = oc.getContext('2d');
							oc.style.display = 'none';
							var w = img.width;
							var h = img.height;

							if (w > h) {
								if (w > maxWidth) {
									h *= maxWidth / w;
									w = maxWidth;
								}
							} else {
								if (h > maxWidth) {
									w *= maxWidth / h;
									h = maxWidth;
								}
							}
							oc.width = w;
							oc.height = h;
							octx.drawImage(img, 0, 0, w, h);
							fileSrc = oc.toDataURL("image/jpeg");
						} else {
							document.getElementById('small-image').src = img.src;
							fileSrc = img.src;
						}
						onSuccess(fileSrc);
					} catch(e) {
						console.error('resizeImageToSpecificWidth()::onload error', e);
						onFailure(e);
					}
				}
				//original
				document.getElementById('original-image').src = event.target.result;
				img.src = event.target.result;
			}
			reader.readAsDataURL(file);
		}
	} catch(e) {
		console.error('resizeImageToSpecificWidth() error', e);
		onFailure(e);
	}
}
