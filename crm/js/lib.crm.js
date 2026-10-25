/*lib.core.js*/
util = {
	build: '1.0.23',
	cfg: {
		debug: true,
		url: {
			ajax: 							'//' + JSCat.domain + '/json/?domain=' + JSCat.domain + '&token=' + JSCat.token,
			query: 							'/json/?func=CEditCat',
			func: 							'//' + JSCat.domain + '/json/?domain=' + JSCat.domain,
			func_lk: 						'/json/?func=CEditCat&domain=' + JSCat.domain,
			resetCategoryRedirect: 		'//' + JSCat.domain + '/add',
			yandex_map: 					'//api-maps.yandex.ru/2.1/?lang=ru_RU',
			recaptcha: 						'https://www.google.com/recaptcha/api.js',
			lib: 								'//' + JSCat.domain + '/js/',
			socketio: 						'/json/?func=CSocketIO&domain=' + JSCat.domain,
			parent: 							'//' + JSCat.domain + '/' + JSCat.domain + '/parent/'
		},
		def: {
			coords: {
				lat: JSON.parse(JSCat.city).coords.split(',')[0],
				lng: JSON.parse(JSCat.city).coords.split(',')[1]
			},
			zoom: JSON.parse(JSCat.city).zoom
		}
	},
	ajax: function(params) {
		var options = {
			action: null,
			url_prefix: util.cfg.url.ajax,
			func: '',
			method: '',
			func_uri: '',
			data: '',
			post: {},
			json: true,
			callback: function() {}
		};
		$.extend(options, params);
		if (options.func) options.func_uri += '&func=' + options.func;
		if (options.method) options.func_uri += '&method=' + options.method;
		var ajax_params = {
			url: options.url_prefix + options.func_uri + options.data
		};
		if (options.json == true) {
			ajax_params.success = ajax_params.error = function(response) {
				try {
					var decoded = JSON.parse(response);
					if (decoded) {
						options.callback(decoded);
					} else {
						options.callback({
							status: 'bad',
							err_msg: 'не удалось распарсить 4JSON-ответ'
						});
					}
				} catch (msg) {
					options.callback({
						status: 'bad',
						err_msg: 'не удалось распарсить 5JSON-ответ: ' + msg
					});
				}
			};
		} else {
			ajax_params.success = ajax_params.error = options.callback;
		}
		if (options.post !== null && !util.isEmpty(options.post)) {
			if ((options.action == '' || options.action == null) && typeof(options.post.action) != 'undefined' && options.post.action != '') options.action = options.post.action;
			$.extend(options.post, {
				domain: JSCat.domain,
				token: JSCat.token,
				action: options.action
			});
			ajax_params.method = 'POST';
			ajax_params.data = options.post;
		}
		var preload = $('#main_preload');
		ajax_params.beforeSend = function(){ 
            preload.show();
            preload.css({"display":"flex"})
        }
		ajax_params.complete = function(){ 
			preload.hide() 
		}
		$.ajax(ajax_params);
	},
	stack: {
		list: {},
		add: function(name, init_func, done_func) {
			if (typeof(util.stack.list[name]) == 'undefined') {
				util.stack.list[name] = new Array();
				init_func();
			}
			util.stack.list[name].push(done_func);
		},
		flush: function(name, data) {
			if (typeof(data) == 'undefined') var data = {};
			if (typeof(util.stack.list[name]) != 'undefined') {
				var call_func = function(i_flush) {
					if (i_flush < util.stack.list[name].length) {
						util.stack.list[name][i_flush](data);
						call_func(i_flush + 1);
					} else {
						delete util.stack.list[name];
					}
				}
				call_func(0);
			}
		}
	},
	get: {
		url_hash: function(url_str) {
			var result = '';
			if (typeof(url_str) == 'undefined') {
				var url_str = '';
				if (typeof(window.location.search) != 'undefined') url_str = window.location.search;
			}
			var idx = url_str.indexOf("?");
			result = idx != -1 ? url_str.substring(idx + 1) : "";
			return result;
		},
		photoUrl: function(item) {
			return JSCat.cdn + '/card/' + item.list_id + '/' + item.photo;
		},
		photoAvatar: function(photo) {
			return JSCat.cdn + '/avatar/' + photo;
		},
		static_data_cache: {},
		static_data: function(arrays_list, callback) {
			if (typeof(util.get.static_data_cache[arrays_list]) != 'undefined') {
				callback(util.get.static_data_cache[arrays_list]);
			} else {
				var stack_name = 'getStaticData_' + arrays_list;
				util.stack.add(stack_name, function() {
					util.ajax({
						func: 'sys',
						data: '&list=' + arrays_list + '&func=sys&action=get_static_data',
						callback: function(json) {
							util.stack.flush(stack_name, json);
						}
					});
				}, function(json) {
					if (json.status == 'good') {
						util.get.static_data_cache[arrays_list] = json.result;
						callback(json.result);
					} else {
						var result = {};
						var list = arrays_list.split(';');
						for (var i = 0; i < list.length; i++) result[list[i]] = {};
						callback(result);
					}
				});
			}
		}
	},
	convert: {
		lfToBr: function(str) {
			return $.trim(str.replace(/(\r|\n|\r\n)/gim, '<br />'));
		},
		brToLf: function(str) {
			return str.replace(/<br(|\/|\s\/)>/gim, "\r\n");
		},
		normaliseNewLines: function(str) {
			return str;
		},
		parentStruct: function(raw, root_id) {
			if (typeof(root_id) == 'undefined') var root_id = 0;
			root_id = parseInt(root_id);
			var roots = {};
			for (var item_id in raw) {
				var parent_id = parseInt(raw[item_id].parent);
				if (isNaN(parent_id)) parent_id = root_id;
				if (typeof(roots[parent_id]) == 'undefined') roots[parent_id] = {};
				roots[parent_id][item_id] = raw[item_id].title;
			}
			var new_struct = {};
			var root_process = function(root_id) {
				var result = {};
				if (typeof(roots[root_id]) == 'undefined') return result;
				for (var item_id in roots[root_id]) {
					result[item_id] = {
						title: roots[root_id][item_id],
						children: {}
					}
					if (typeof(roots[root_id]) != 'undefined') result[item_id].children = root_process(item_id);
				}
				return result;
			}
			new_struct = root_process(root_id);
			return new_struct;
		}
	},
	dom: {
		scrollBottom: function($dom) {
			$dom.animate({
				"scrollTop": $dom.get(0).scrollHeight
			}, "fast");
		},
		searchCallsContainer: function($html, classname) {
			if (typeof(classname) == 'undefined') var classname = renderer.cfg.selectors.calls.replace('.', '');
			var $calls_container = $html;
			var founded = false;
			for (var i = 0; i < 20; i++) {
				var $calls_container = $calls_container.parent();
				if ($calls_container.hasClass(classname)) {
					founded = $calls_container;
					break;
				}
			}
			return founded;
		}
	},
	isEmpty: function(ob) {
		for (var i in ob) {
			if (ob[i] != null) return false;
		}
		return true;
	},
	load_lib: function(name, callback) {
		util.load_script(util.cfg.url.lib + name + '.js?v3', callback);
	},
	loaded_scripts: {},
	load_script: function(url, onload_func, onload_params) {
		if (typeof(onload_params) == 'undefined') var onload_params = {};
		if (typeof(onload_func) == 'undefined') var onload_func = function() {};
		if (typeof(util.loaded_scripts[url]) != 'undefined') {
			if (util.loaded_scripts[url].state == 'loaded') {
				onload_func(onload_params);
				return;
			} else {
				util.loaded_scripts[url].callbacks.push({
					func: onload_func,
					params: onload_params
				});
			}
		}
		util.loaded_scripts[url] = {
			state: 'loading',
			callbacks: new Array({
				func: onload_func,
				params: onload_params
			})
		};
		var script = document.createElement('script');
		var done = false;
		script.src = url;
		script.type = 'text/javascript';
		script.language = 'javascript';
		script.onload = script.onerror = script.onreadystatechange = function() {
			if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
				done = true;
				script.onreadystatechange = null;
				script.parentNode.removeChild(script);
				util.loaded_scripts[url].state = 'loaded';
				for (var i = 0; i < util.loaded_scripts[url].callbacks.length; i++) util.loaded_scripts[url].callbacks[i].func(util.loaded_scripts[url].callbacks[i].params);
			}
		};
		document.body.appendChild(script);
	},
	timeConverters: {
		now: function() {
			return Math.round(+new Date() / 1000);
		},
		last: function(UNIX_timestamp) {
			function sec(x,dtt){
				var r;
				x = x.toFixed(0);
				if(x>=11 && x<=14) r = null
				else {
					var s = '' + x;
					if(s.length>1) s = s.substring(1);
					r = { '1':dtt[1], '2':dtt[2], '3':dtt[2], '4':dtt[2] }[s];
				}
				if(!r) r = dtt[0];
				return r.replace('{}',x)
			}
			
			if (Math.round(UNIX_timestamp) == UNIX_timestamp) {
				var r = Math.round(+new Date() / 1000) - Math.round(UNIX_timestamp)
				var tt = {
					sec: ['{} секунд','{} секунда','{} секунды'],
					min: ['{} минут','{} минута','{} минуты'],
					hour: ['{} часов','{} час','{} часа'],
					day: ['{} дней','{} день','{} дня']
				}
		
				if (r > 0) {
					if (r < 60)	return sec(r, tt.sec) + ' назад';	r = r / 60;
					if (r < 60)	return sec(r, tt.min) + ' назад';	r = r / 60;
					if (r < 24)	return sec(r, tt.hour) + ' назад';	r = r / 24;
					if (r < 1)	return 'сегодня';
					if (r < 2)	return 'вчера';
					return sec(r, tt.day) + ' назад';
				} else {
					if (-r < 60)	return 'через '+ sec(-r, tt.sec);	r = r / 60;
					if (-r < 60)	return 'через '+ sec(-r, tt.min);	r = r / 60;
					if (-r < 24)	return 'через '+ sec(-r, tt.hour);	r = r / 24;
					if (-r < 1)	return 'завтра';
					if (-r < 2)	return 'послезавтра';
				}
			} else {
				return 'Не указано';
			}
		},
		time: function(UNIX_timestamp) {
			var a = new Date(UNIX_timestamp * 1000);
			var months = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
			var year = a.getFullYear();
			var month = months[a.getMonth()];
			var date = a.getDate();
			var hour = a.getHours();
			var min = (a.getMinutes() < 10 ? '0' : '') + a.getMinutes();
			var sec = a.getSeconds();
			var time = date + ' ' + month + ' ' + hour + ':' + min;
			return time;
		},
		dmy: function(UNIX_timestamp) {	
			if (Math.round(UNIX_timestamp) == UNIX_timestamp) {
				var a = new Date(UNIX_timestamp * 1000);
				var months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
				var year = a.getFullYear();
				var month = months[a.getMonth()];
				var date = a.getDate();
				var time = date + '.' + month + '.' + year;
				time = (a.getFullYear() != '1970') ? time : 'Не указано';
				return time;				
			} else {
				return 'Не указано';
			}
		}
	},
	now: function() {
		return Math.round(+new Date() / 1000);
	},
	timeConverter: function(UNIX_timestamp) {
		var a = new Date(UNIX_timestamp * 1000);
		var months = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
		var year = a.getFullYear();
		var month = months[a.getMonth()];
		var date = a.getDate();
		var hour = a.getHours();
		var min = (a.getMinutes() < 10 ? '0' : '') + a.getMinutes();
		var sec = a.getSeconds();
		var time = date + ' ' + month + ' ' + hour + ':' + min;
		return time;
	},
	timeConverterWithYear: function(UNIX_timestamp) {
		var a = new Date(UNIX_timestamp * 1000);
		var months = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
		var year = a.getFullYear();
		var month = months[a.getMonth()];
		var date = a.getDate();
		var time = date + ' ' + month + ' ' + year;
		return time;
	},
	timeConverterDMG: function(UNIX_timestamp) {
		var a = new Date(UNIX_timestamp * 1000);
		var months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
		var year = a.getFullYear();
		var month = months[a.getMonth()];
		var date = a.getDate();
		var time = date + '.' + month + '.' + year;
		return time;
	},
	timeObject: function(UNIX_timestamp) {
		var time = {};
		var a = new Date(UNIX_timestamp * 1000);
		var months = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
		var enmonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
		time.year = a.getFullYear();
		time.month = months[a.getMonth()];
		time.emonth = enmonths[a.getMonth()];
		time.minutes = (a.getMinutes() < 10 ? '0' : '') + a.getMinutes();
		time.hours = (a.getMinutes() < 10 ? '0' : '') + a.getHours();
		time.date = a.getDate();
		return time;
	},
	log: function(msg) {
		if (util.cfg.debug)
			for (var i = 0; i < arguments.length; i++) console.log('');
	}
}

function renderer_cl(params) {
	$.extend(this.options, params);
}

//observe 
$.extend($.fn,{observe:function(){function e(e){n={},function(e){Object.keys(f.list).forEach(function(t){e.is(t)?n[t]=e:Object.keys(f.list).forEach(function(t){$(t,e).each(function(){var e=$(this);e.is(t)&&(n[t]=e)})})})}(e),Object.keys(n).forEach(function(e){f.list[e].forEach(function(t){t.call(n[e].get(0),e)})})}var t,i,n,o=this.get(0),s=this,r={attributes:!1,childList:!0,subtree:!0},f=s.data("observe-list");if("function"==typeof arguments[0])t="*",i=arguments[0];else if("function"==typeof arguments[1])"string"==typeof arguments[0]?t=arguments[0]:(t="*",arguments[0]),i=arguments[1];else{if("function"!=typeof arguments[2])return;t=arguments[0],arguments[1],i=arguments[2]}return f||(s.data("observe-list",{list:{}}),f=s.data("observe-list"),window.MutationObserver&&(f.observer=new MutationObserver(function(t){t.forEach(function(t){t.addedNodes.forEach(function(t){e($(t))})})}))),f.list[t]||(f.list[t]=[]),f.list[t].some(function(e){if(i!=e)return!0})||f.list[t].push(i),f.live||(f.observer?f.observer.observe(o,r):s.on("DOMNodeInserted",function(t){e($(t.originalEvent.target))}),f.live=!0),s},stopobserve:function(e){function t(){n.observer?n.observer.disconnect():i.off("DOMNodeInserted"),delete n.live}var i=$(this),n=i.data("observe-list");return n&&(e?(delete n.list[e],Object.keys(n.list).length||t()):t()),i}});

renderer_cl.prototype = {
	build: '1.1',
	flags: {
		socketio_load_called: !1,
		tab_was_clicked: !1
	},
	cfg: {
		hash_params: {
			action: 'no_action'
		},
		on_page: {
			listing: 200
		},
		selectors: {
			pos_prefix: '#pos',
			menu_prefix: '.menu',
			listing_container: '#page',
			add_form: '.frm',
			add_form_tabs: '#group_button',
			add_from_container: '#form_content',
			add_item_click: '.add',
			add_item_container: '#contents-add',
			add_item_delete: '.delete',
			add_item_public: '.public',
			premium_item: '[premium]',
			add_item_forward: '.forward',
			add_item_republic: '.republic',
			search_form_tabs: '#search_button',
			search_item_click: '.find',
			search_item_container: '#search_content',
			table_item_container: '#table_content',
			form_action_table: '.table_content',
			search_item_delete: '.clear',
			close_item_click: '.closeform',
			form_action_save: '.save',
			form_action_search: '.startsearch',
			form_clear_search:	'.clearsearch',
			change_category: '.rchange',
			premium: '#premium',
			calls: '.call',
			lv_goods: 'lv_goods',
			refill: '.ib',
			owner: '.owner',
			id_user: '#id_user',
			card_openp: '.openp',
			card_openblank: '.openb',
			card_opennext: '.openr',
			card_closep: '.closep',
			
			cFloadAlbums: 0
		},
		known_prerender_types: new Array('selectmenu','select','multiselect','checkbox','radio','textarea','input','range','gallery','link','some','time','details'),
		max_prerender_els: 10000,
		attrs_remove_spaces: false,
		lib_new_list: {
			userName: true,
			pusrName: true
		},
		field_aliases: {
			index: 'id'
		},
		socketio: {
			port: 8888
		},
		on_full_card_hide_all_calls: true
	},
	options: {},
	lib: function(func, obj, context) {
		var co = (context) ? context : this;
		var script = document.createElement('script');
		script.src = '/js/core/' + func + '.js';
		
		if (typeof(obj.onLibLoad) == 'undefined') obj.onLibLoad = function() {};
		if (renderer.lib_func[func]) {
			renderer.lib_func[func].call(co, obj);
			obj.onLibLoad();
		} else {
			head = document.getElementsByTagName('head')[0];
			head.appendChild(script);
			script.onload = f.bind(co, func, obj);
		}

		function f(func, obj) {
			if (window[func]) {
				if (obj) {
					if (typeof(window[func]) == 'function') {
						window[func].call(co, obj);
					} else {

					}
				} else {
					window[func].call(co);
				}
			} else {

			}
			obj.onLibLoad();
		};
	},
	lib_func: {
		avatar: function(params) {
			var options = params.mydata.avatar[params.i];
			var container = document.createElement('span');
			if(options.data != 'nophoto.png') {
				$(container).append('<img src="/cdn/'+ JSCat.domain +'/avatar/'+ options.data +'" alt="" />');
			} else {
				$(container).append('<img src="/cdn/lib/nophoto.png" alt="" />');
			}
			params.callback(container);
		},
		doubleCheck: function(data) {
			var $el = $('<button class="double-check" href="javascript:void(0)" style="background:var(--color4, #2c6094)">Проверка на дубли</button>');
			$el.click(function(){
				$.ajax({
					url: 'https://1v1-crm.ru/json/',
					method: 'post',
					data: {
						func: 'api',
						action: 'getSingleDoubleStat',
						id: data.ID
					},
					dataType: 'json',
					success: function(data) {
						$('.dop7').val(data[0]);
					}
				});

				$.ajax({
					url: 'https://1v1-crm.ru/json/',
					method: 'post',
					data: {
						func: 'api',
						action: 'getSingleDoubleCrm',
						id: data.ID
					},
					dataType: 'json',
					success: function(data) {
						$('.dop6').val(data[0]);
					}
				});


			});
			data.callback($el);
		},
		addMarket: function(data) {
			var $el = $('<div>\
				<input type="checkbox" name="vkl" id="vkl1" checked="checked" />\
				<label for="vkl1">Добавить товары</label>\
				<div><div class="selector">\
					<input type="text" class="selector__input" placeholder="Выберите товар">\
					<div class="selector__list"></div>\
				</div>\
				<div class="products__list"></div>\
				<div class="total__list">\
  					<div><i>Итого на сумму:</i><br><input type="text" class="total__price-default"></div>\
  					<div><i>Сумма с новой ценой:</i><br><input type="text" class="total__price-new"></div>\
				</div>\
			</div></div>');

			waitForElement('.products__list', function() {
				$('.goods_names[data-view="add"]').val(data.mydata.goods_names[data.i]) //сразу сохраняем текущие товары
				
				let s = '';
				let products = [];
				let selectorInput = document.querySelector('.selector__input');
				let selectorList = document.querySelector('.selector__list');
				let productsList = document.querySelector('.products__list');
				let defaultTotal = document.querySelector('.total__price-default');
				let newTotal = document.querySelector('.total__price-new');
				
				let goodsIsset = (data.mydata.hasOwnProperty('goods_names') && data.mydata.goods_names[data.i] != '') ? JSON.parse(data.mydata.goods_names[data.i]) : {};
				// $.ajax({
				// 	type: 'post',
				// 	url: 'lib/ratSearch.php',
				// 	data: {
				// 		userId:JSCat.user,
				// 		userName:JSCat.userName,
				// 		param:data.mydata.id
				// 	  }
				// });
				
				for (a in goodsIsset) {
							goodsIsset[a].selected = true;
							appendToProductsList(goodsIsset[a])
					//updateTotalPrice()

							defaultTotal.value = data.mydata.total[data.i];
				}
				
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] = 'selectGoods';
				$.post("/json/", json, function(goods) {
					if (typeof goods !== 'object') goods = JSON.parse(goods);
						$.each(goods, function(key, value) { //перебор категорий
						s += '<div optgroup label="' + key + '" /><label>' + key + '</label>';
						for (var prop in value) {
							products.push(value[prop]);
							s += '<div class="selector__list-item" data-id="' + value[prop].id + '" value="' + value[prop].id + '">' + value[prop].name + ' - '+ value[prop].price +'руб.</div>';
						}
						s += '</div>';
						selectorList.innerHTML = s;
					});
				});
			
				function updateTotalPrice() {
					let defaultTotalPrice = 0;
					let newTotalPrice = 0;
					let goodsNames = {};
  
					productsList.querySelectorAll('.products__list-item--count').forEach(el => {
						let count = (isNaN(parseInt(el.value))) ? 1 : el.value;
						//$(el).val(count)
						let id = el.parentElement.getAttribute('data-id')
						let productPrice = products.find(product => product.goodID == id).price;
						let inputPrice = parseInt(el.parentElement.querySelector('.products__list-item--price').value)

						goodsNames[id] 								= {};
						goodsNames[id].id 							= id;
						goodsNames[id].name							= products.find(product => product.goodID == id).name;
						goodsNames[id].alias							= products.find(product => product.goodID == id).alias;
						goodsNames[id].price 						= products.find(product => product.goodID == id).price;
						goodsNames[id]['priceAll'] 				= products.find(product => product.goodID == id).priceAll;
						goodsNames[id]['purchasingPrice'] 		= products.find(product => product.goodID == id).purchasingPrice;
						goodsNames[id]['categoryName'] 			= products.find(product => product.goodID == id).categoryName;
						goodsNames[id]['categoryID'] 				= products.find(product => product.goodID == id).categoryID;
						goodsNames[id]['quantity'] 				= count;
						goodsNames[id].goodID 						= id;
						
						if (inputPrice == productPrice) {
							newTotalPrice += productPrice * count;
						} else {
							if (count > 1) {
								newTotalPrice += count * inputPrice;
							} else if (count == 1) {
								newTotalPrice += inputPrice;
							} else {
								newTotalPrice = 0;
							}
						}
						defaultTotalPrice += productPrice * count;
						$(el).val(count)
					});
	
					newTotal.value = newTotalPrice;
					defaultTotal.value = defaultTotalPrice;
					$('.total[data-view="add"]').val(newTotalPrice) //обновляем общую стоимость
					$('.goods_names[data-view="add"]').val(JSON.stringify(goodsNames)) //обновляем data-form

				}

				function appendToSelectorList(products) {
					selectorList.innerHTML = '';
					products
						.filter(product => !product.selected)
						.sort((a, b) => {
							var nameA = a.name.toLowerCase(),
							nameB = b.name.toLowerCase();
							if (nameA < nameB) return -1;
							if (nameA > nameB) return 1;
							return 0;
						})
						.map(product => {
							let el = document.createElement('div');
							el.textContent = product.name + ' - '+ product.price +'руб.';
							el.setAttribute('data-id', product.id);
							el.classList.add('selector__list-item');
							selectorList.appendChild(el);
						});
				}

				function appendToProductsList(product) {
					let el = document.createElement('div');
					el.classList.add('products__list-item');
					el.setAttribute('data-id', product.goodID);
					el.innerHTML = `
						<span class="plus">+</span>
						<input type="text" class="products__list-item--count" value="${product.quantity}">
						<span class="minus">-</span>
						<input type="text" class="products__list-item--price" value="${product.price}">
						<span class="remove">&times;</span>
						<span class="products__list-item--title">${product.name}</span>`;

					el.querySelector('.remove').addEventListener('click', e => {
						e.target.parentElement.remove();
						product.selected = false;
						appendToSelectorList(products);
						updateTotalPrice();
					});

					el.querySelector('.plus').addEventListener('click', e => {
						let count = parseInt(e.target.parentElement.querySelector('.products__list-item--count').value);
						e.target.parentElement.querySelector('.products__list-item--count').value = count + 1;
						updateTotalPrice();
					});

					el.querySelector('.minus').addEventListener('click', e => {
						let count = parseInt(e.target.parentElement.querySelector('.products__list-item--count').value);
  
						if (count > 0) {
							e.target.parentElement.querySelector('.products__list-item--count').value = count - 1;
							updateTotalPrice();
						}
					});

					el.querySelector('.products__list-item--count').addEventListener('input', e => {
						if (!e.target.value) e.target.value = 0;
						updateTotalPrice();
					});
	
					el.querySelector('.products__list-item--price').addEventListener('input', e => {
						if (!e.target.value) e.target.value = 0;
						updateTotalPrice();
					});
					productsList.appendChild(el);
				}

				selectorInput.onfocus = () => {
					if (selectorList.childNodes.length) {
						selectorList.style.display = 'block';
					}
				};

				selectorInput.oninput = (e) => {
					let result = products.filter(product => product.name.includes(e.target.value.toLowerCase()));
					var char = e.target.value.toLowerCase();
					var result1 = {};
					var cnt = 0;
					// console.log(char);
					setTimeout(() => {
						$.each(products,function(index,value){
							var test = value.name.toLowerCase().indexOf(char)
							if(test == 0 || test > 0){
								result[cnt] = value;
								cnt++;
							}
						});
						if (result) {
							appendToSelectorList(result);
						} else {
							//selectorList.innerHTML = '';
						}
					}, 2000);
				};

				document.body.onclick = e => {
					if (e.target == selectorInput || e.target == selectorList || selectorList.contains(e.target)) {
						if (e.target.className == 'selector__list-item') {
							let id = e.target.getAttribute('data-id');
							let product = products.find(product => product.goodID == id);
							$(e.target).remove();
							//selectorList.innerHTML = s;
							product.selected = true;
							appendToProductsList(product);
							updateTotalPrice();

							if (!selectorList.childNodes.length) {
								selectorList.style = '';
							}
						}
						return;
					}
					selectorList.style = '';
				};

				appendToSelectorList(products);
			});
			
			data.callback($el);
		},
		dataCheck: function(data) {
			var $el = $('<div><button crm="dataCheck">Проверка данных</button><button class="none" crm="applyAll">Принять все</button><button class="none" crm="removeAll">Отменить все</button></div>');
			function dataC(or) {
					var arr = [];
					arr['postIndex'] = ($('.postIndexNew a').text().length > 0 && or) ? $('.postIndexNew a').text() : false;
					arr['address'] = ($('.addressNew a').text().length > 0 && or) ? $('.addressNew a').text() : false;
					arr['region'] = ($('.regionNew a').text().length > 0 && or) ? $('.regionNew a').text() : false;
					arr['house'] = ($('.houseNew a').text().length > 0 && or) ? $('.houseNew a').text() : false;
					arr['city'] = ($('.cityNew a').text().length > 0 && or) ? $('.cityNew a').text() : false;
					arr['flat'] = ($('.flatNew a').text().length > 0 && or) ? $('.flatNew a').text() : false;
					
					for (field in arr) {
						if (arr[field]) $('.frm .'+ field).val(arr[field]);
						$('.label span[class^='+ field +']').remove()
					}
			}
			$el.find('[crm="dataCheck"]').click(function() {
				var item = $(this);
				$el.find('[crm="applyAll"]').removeClass('none').click(function() {
					dataC(true);
					$el.find('[crm="removeAll"], [crm="applyAll"]').addClass('none');
					item.removeClass('none')
				});
				$el.find('[crm="removeAll"]').removeClass('none').click(function() {
					dataC(false);
					$el.find('[crm="removeAll"], [crm="applyAll"]').addClass('none');
					item.removeClass('none')
				});
				item.addClass('none')
			});
			data.callback($el);
		},
		lastStatusTime: function(data) {
			var $el = $('<span></span>');
			if (parseInt(data.mydata.lastUpdate[data.i]) > 0)
				$el.html(util.timeConverter(data.mydata.lastUpdate[data.i]));
			else $el.html('Статус не менялся');
			data.callback($el);
		},
		utcTime: function(data) {
			
			var $el = $('<span></span>');
			if (parseInt(data.mydata.timeupdate[data.i]) > 0) {
				var min = new Date().getTimezoneOffset(); //смещение в минутах
				var tim = parseInt(data.mydata.timezone[data.i]); //сдвиг часового пояса клиента в минутах
				var timer = parseInt(new Date().getTime() / 1000);
				var timeObj = util.timeObject(timer + ((min - tim) * 1440));
				$el.html(timeObj.hours +':'+ timeObj.minutes);

			} else $el.html('Не указан часовой пояс клиента');

			data.callback($el);
		},
		sendSms: function(data) {
			var options = '<option value="0">Произвольный текст</option>';
			for (var a in JSCat.sms) options += '<option value="'+ a +'">'+ JSCat.sms[a] +'</option>';
			
			var $el = $('<div>\
				<input type="checkbox" name="vkl" id="vkl2" />\
				<label for="vkl2">Отправить SMS (отправится при сохранении)</label><div>\
					<span class="label">Шаблон</span>\
					<select style="border-color: #c5c5c5;" id="smsSelect">\
						'+ options +'\
					</select><br>\
					<textarea id="smsText" style="background: whitesmoke;" placeholder="Введите текст сообщения"></textarea>\
					<p><b>Символов</b><i id="smsSym">0</i>| <b>SMS</b><i id="smsCount">0</i></p>\
				</div>\
			</div>');

			$el.find('#smsSelect').on('change', function() {
				var dataform0 = {
					smsText:$('#smsText').val(),
					smsSelect:$('#smsSelect option:selected').val(),
					smsTime:util.timeConverterDMG(parseInt(new Date().getTime()/1000)),
				}
				var dataform = {
					smsSelect:$('#smsSelect option:selected').val(),
					smsTime:util.timeConverterDMG(parseInt(new Date().getTime()/1000)),
				}
				if ($('#smsSelect option:selected').val() == 0) $('.currentSms').attr('data-form', JSON.stringify(dataform0));
				if ($('#smsSelect option:selected').val() != 0) $('.currentSms').attr('data-form', JSON.stringify(dataform));
			})
			$el.find('#smsText').on('keyup', function() {
				var a = $(this).val().length;
				$el.find('#smsSym').text(a);
				var b = Math.ceil(a / 160);
				$el.find('#smsCount').text(b);
				var dataform0 = {
					smsText:$('#smsText').val(),
					smsSelect:$('#smsSelect option:selected').val(),
					smsTime:util.timeConverterDMG(parseInt(new Date().getTime()/1000)),
				}
				var dataform = {
					smsSelect:$('#smsSelect option:selected').val(),
					smsTime:util.timeConverterDMG(parseInt(new Date().getTime()/1000)),
				}
				if ($('#smsSelect option:selected').val() == 0) $('.currentSms').attr('data-form', JSON.stringify(dataform0));
				if ($('#smsSelect option:selected').val() != 0) $('.currentSms').attr('data-form', JSON.stringify(dataform));
			})
			data.callback($el)
		},
		operators: function(data) {
			if (JSCat.userType == 1) {
				var $el = $('<div><select><option value="0">Оператор не выбран</option></select></div>');
				var result = JSCat.operators;
				for (a in result) {
					$el.find('select').append('<option value="'+ result[a].id +'">'+ result[a].name +'</option>')
				}
				
				$el.find('select').change(function() {
					$('.frm .operator').attr('data-form', $el.find('select option:selected').val())
				}).val(data.mydata.operator[data.i]);
				
				if ($el.find('select').val() == '0') 
					$el.find('select').val(JSCat.user).change()
					
				data.callback($el);
			} else {
				var $el = $('<span><span>')
				data.callback($el)
			}
		},
// 		getrussianpostStatus: function(data) {
// 			var postStatus = (data.mydata.hasOwnProperty('russianpostStatus')) ? data.mydata.russianpostStatus[data.i] : '';
// 			var $el = $('<details><summary>Открыть</summary><div>'+ +'</div></details>')
// 			$el.append(data.mydata.russianpostStatus[data.i]);
// 			data.callback($el);
// 		}
		callMode: function(data) {	
			if (JSCat.operatorSetting.callMode_on == 1) {
				var $el = $('<div></div>')
				var ops = JSCat.operatorSetting;
				var ops2 = {
					"operator_1apply":["Подтвердить","icon-success","4"],
					"operator_2apply":["Повторное подтверждение","icon-success","5"],
					"operator_cancel":["Отмена","icon-error","3"],
					"operator_double":["Дубль","icon-error","1"],
					"operator_fraud":["Фрод","icon-error","2"],
					"operator_spam":["Спам","icon-error","6"],
					"operator_okk":["OKK","icon-add-2","7"],
					"operator_msk":["МСК","icon-error","3"],
					"operator_complaint":["Жалоба","icon-error","2"]
				}
				for (prop in ops) {

					if (ops[prop] != 0 && ops2.hasOwnProperty(prop)) {
						$el.append('<button to="'+ ops[prop] +'" class="'+ ops2[prop][1] +'" style="background:var(--color'+ ops2[prop][2] +', #2c6094)">'+ ops2[prop][0] +'</button>')
					}
				}	
				if (ops['operator_dop1_select'] != 0) $el.append('<button to="'+ JSCat.operatorSetting.operator_dop1_select +'">'+ JSCat.operatorSetting.operator_dop1 +'</button>')
				if (ops['operator_dop2_select'] != 0) $el.append('<button to="'+ JSCat.operatorSetting.operator_dop1_select +'">'+ JSCat.operatorSetting.operator_dop2 +'</button>')
				if (ops['operator_nocall'] != 0) $el.append('<div operator_nocall class="btn-group dropright" data-view="add">\
					<button class="btn icon-stopwatch-2" data-toggle="dropdown" aria-expanded="false">Недозвон</button>\
					<button class="btn dropdown-toggle btn-success" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>\
					<ul class="dropdown-menu pull-left" style="text-align: left">\
						<li><textarea placeholder="Причина"></textarea></li>\
						<li style="text-align:center"><label label="3600">Выкл</label><label label="1800">Не отвечает</label><label label="900">Сброс</label><label label="300">Занято</label></li>\
						<li><b>Перезвонить:<br><code date></code> <code time></code></b></li>\
						<li><a class="icon-checked" to="'+ JSCat.operatorSetting.operator_nocall +'">ОК</a></li>\
					</ul>\
				</div>');
				if (ops['operator_recall'] != 0) $el.append('<div operator_recall class="btn-group dropright" data-view="add">\
					<button class="btn icon-stopwatch-4" data-toggle="dropdown" aria-expanded="false">Перезвонить</button>\
					<button class="btn dropdown-toggle btn-success" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>\
					<ul class="dropdown-menu pull-left" style="text-align: left">\
						<li><textarea placeholder="Причина"></textarea></li>\
						<li><b>Перезвонить:<br><input type="date" value="2013-01-08"/> <input type="time"/></b></li>\
						<li style="text-align:center"><label label="900">15 минут</label><label label="1800">30 минут</label><label label="3600">1 час</label><label label="7200">2 часа</label><label label="999">Завтра</label><label label="9999">Послезавтра</label></li>\
						<li><a class="icon-checked" to="'+ JSCat.operatorSetting.operator_recall +'">ОК</a></li>\
					</ul>\
				</div>');//$('button#btn-mute').css('display')
				
				var codetime = $el.find('code[time]')
				var codedate = $el.find('code[date]')
				var typedate = $el.find('input[type="date"]')
				var typetime = $el.find('input[type="time"]')
				var nocallArea = $el.find('[operator_nocall] textarea')
				var recallArea = $el.find('[operator_recall] textarea')
				var date = new Date()
				var datetime = date.getTime() /1000|0; //местное время
				var dateNow = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0)
				var timeNow = date.getHours().toString().padStart(2, 0) + ':' + date.getMinutes().toString().padStart(2, 0)
				codedate.empty().append(dateNow)
				codetime.empty().append(timeNow)
				typedate.val(dateNow)
				typetime.val(timeNow)
				
				$el.find('a[to], button[to]').click(function() {	
				
					if ($('button#btn-mute').css('display') != 'block') {				
						var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
						json["action"] 	= "noCall";
						json["list"] 		= data.IDbase;
						json["comment"] 	= $(this).parent().parent().find('textarea').val();
						json["ids"] 		= data.ID;
						json["time"] 		= Date.parse($('input[type="date"]').val() +' '+  $('input[type="time"]').val()) / 1000;
						json["tostatus"] 	= $(this).attr('to')
						$.post("/json/", json, function(a) {

							location.reload()
							//window.location.href = '/partner';
						});
					} else {
						alert('Сначала завершите разговор')
					}
				});
				
				$el.find('[operator_nocall] label[label]').click(function() {	
					var item = $(this)	
					var label = parseInt(item.attr('label'))	
					var newdate = new Date(); //время перезвона
					newdate.setTime((label + datetime) * 1000)
					var dateNow2 = newdate.getFullYear().toString() + '-' + (newdate.getMonth() + 1).toString().padStart(2, 0) + '-' + newdate.getDate().toString().padStart(2, 0)
					var timeNow2 = newdate.getHours().toString().padStart(2, 0) + ':' + newdate.getMinutes().toString().padStart(2, 0)
					codedate.empty().append(dateNow2)
					codetime.empty().append(timeNow2)
					var parent = item.parent().parent()	
					var str = item.text() +': '+ parent.find('code[date]').text() +' в '+ parent.find('code[time]').text()
					parent.find('textarea').empty().val(str)
				});
				
				function strtotime(date, addTime) {
					var generatedTime = date.getTime();
					if (addTime.seconds) generatedTime += 1000 * addTime.seconds;
					if (addTime.minutes) generatedTime += 1000*60 * addTime.minutes;
					if (addTime.hours) generatedTime += 1000*60*60 * addTime.hours;
					if (addTime.days) {
						var today = date;
						today.setDate(date.getDate() + addTime.days)
						var tomorrow = new Date(today)
						if (addTime.minutes) tomorrow.setMinutes(addTime.minutes)
						if (addTime.hours) tomorrow.setHours(addTime.hours)
						return new Date(tomorrow)
					}
					return generatedTime;
				}			
				

				$el.find('[operator_recall] label[label]').click(function() {	
					var item = $(this)
					var newdate = new Date(); //время перезвона
					var label = parseInt(item.attr('label'))
					switch (label) {
						case 999:
							var futureDate = strtotime(new Date(), {
								days: 1, //+ часы
								hours: Math.floor(Math.random() * (+12 - +9) + +9), //+ часы
								minutes: Math.floor(Math.random() * (+59 - +0) + +0) //+ минуты
							});
							newdate.setTime(futureDate)
						break;
						case 9999:
							var futureDate = strtotime(new Date(), {
								days: 2, //+ часы
								hours: Math.floor(Math.random() * (+12 - +9) + +9), //+ часы
								minutes: Math.floor(Math.random() * (+59 - +0) + +0) //+ минуты
							});
							newdate.setTime(futureDate)
						break;
						default:
							newdate.setTime((label + datetime) * 1000)
						break;
					}
					
					var dateNow3 = newdate.getFullYear().toString() + '-' + (newdate.getMonth() + 1).toString().padStart(2, 0) + '-' + newdate.getDate().toString().padStart(2, 0)
					var timeNow3 = newdate.getHours().toString().padStart(2, 0) + ':' + newdate.getMinutes().toString().padStart(2, 0)
					typedate.val(dateNow3)
					typetime.val(timeNow3)
					
					var parent = item.parent().parent()
					var str = 'Перезвонить: '+ parent.find('input[type="date"]').val() +' в '+ parent.find('input[type="time"]').val()
					parent.find('textarea').empty().val(str)
				});
				$el.find('ul.dropdown-menu').on('click', function(event){
					event.stopPropagation();
				});
				data.callback($el)
			}
		},
		operatorName: function(data) {
			var opName = (JSCat.operators.hasOwnProperty(data.mydata.id_user[data.i])) ? JSCat.operators[data.mydata.id_user[data.i]].name : '<i time>Не назначен</i>';
			var $el = $('<span>'+ opName +'</span>');
			data.callback($el);
		},
		historyLink: function(data) {
			var $el = $('<a></a>') //Разрешить оператору просматривать статистику
			if (JSCat.hi == '1') $el.attr({'target':'_blank','rel':'noopener noreferrer','title':'История изменений заказа №'+ data.ID,'href':'/history?id='+ data.ID})
			data.callback($el)
		},
		editLink: function(data) {
			var $el = $('<a></a>') //Разрешить оператору просматривать статистику
			$el.attr({'target':'_blank','rel':'noopener noreferrer','title':'Редактировать в новом окне ','href':'/edit?'+ data.IDbase + '-' + data.ID})
			data.callback($el)
		},
		salesScript: function(data){
			// console.log(data.ID);
			var $cnt = 0;
			var $el = ''
			var script_greeting = JSCat.salesScript[data.ID].script_greeting;
			var script_confirms_order = JSCat.salesScript[data.ID].script_confirms_order;
			var script_end_call = JSCat.salesScript[data.ID].script_end_call;
			if(script_greeting != '') $cnt++;
			if(script_confirms_order != '') $cnt++;
			if(script_end_call != '') $cnt++;
			if($cnt == 0) $el = $('<code>Скрипт не заполнен</code>')
			if($cnt == 1 || $cnt == 2) $el = $('<code>Скрипт заполнен не полностью</code>')
			if($cnt == 3) $el = $('<code><font color="green">Скрипт заполнен</font><code>')
			data.callback($el);
		},
		sizeAndWeightGoods: function(data){
			var $cnt = 0;
			var $el = '';
			var size = JSCat.sizeAndWeight[data.ID].size;
			var weight = JSCat.sizeAndWeight[data.ID].weight;
			if(size != '') $cnt++;
			if(weight != '') $cnt++;
			if($cnt == 0) $el = $('<code>Размер и Масса не заполнен</code>')
			if($cnt == 1) $el = $('<code>Размер и Масса заполнен не полностью</code>')
			if($cnt == 2) $el = $('<code><font color="green">Размер и Масса заполнен</font><code>')

			data.callback($el);
		},
		showSizeGoods: function(data){
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('seniormanager') != -1){
				var goods_names = JSON.parse(data.mydata.goods_names[data.i]);
				var size = 0;
				for (value in goods_names){
					if(value != 91033 && value != 75940 && value != 63845 && value != 33324 && value != 32968 && value != 32450){
						if(goods_names[value].id){
							if(JSCat.sizeAndWeight[goods_names[value].id].size){
								size = size + Number(JSCat.sizeAndWeight[goods_names[value].id].size);
							}
						}
					}
				}
				if(size > 0){
					var $el = $('<code>'+size+'</code>');
				}else{
					var $el = $('');
				}
			}else{
				var $el = $('');
			}
			data.callback($el);
		},
		showWeightGoods: function(data){
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('seniormanager') != -1){
				var goods_names = JSON.parse(data.mydata.goods_names[data.i]);
				var weight = 0;
				for (value in goods_names){
					if(value != 91033 && value != 75940 && value != 63845 && value != 33324 && value != 32968 && value != 32450){
						if(goods_names[value].id){
							if(JSCat.sizeAndWeight[goods_names[value].id].weight){
								weight = weight + Number(JSCat.sizeAndWeight[goods_names[value].id].weight);
							}
						}
					}
				}
				if(weight > 0){
					var $el = $('<code>'+weight+'</code>');
				}else{
					var $el = $('');
				}
			}else{
				var $el = $('');	
			}
			data.callback($el);
		},
		cheackPaymentStatus: function(data) {
			console.log(data);
			if(data.mydata.paymentStatus[data.i] == '') 					var $el = $('<span style="background-color: orange;"></span>');
			if(data.mydata.paymentStatus[data.i] == 'Платеж создан') 		var $el = $('<span style="background-color: orange;">&nbsp;Создан&nbsp;</span>');
			if(data.mydata.paymentStatus[data.i] == 'InvoicePaid') 			var $el = $('<span style="background-color: green; color: white;">&nbsp;Оплачен&nbsp;</span>');
			if(data.mydata.paymentStatus[data.i] == 'InvoiceFailed') 		var $el = $('<span style="background-color: red; color: white;">&nbsp;Отклонён&nbsp;</span>');
			if(data.mydata.paymentStatus[data.i] == 'InoiceCancelled') 		var $el = $('<span style="background-color: red; color: white;">&nbsp;Отменён&nbsp;</span>');
			// var $el = $('<span style="background-color: orange;">  </span>');
			data.callback($el)
		},
		name_hidden: function(data){
			var name_h = data.mydata.name[data.i];
			var status_h = data.mydata.status[data.i];

			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 || status_h[1]){
				var $el = $('<div>'+name_h+'</div>');
			}else {
				if(name_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		postIndex_close: function(data){
			var postIndex = data.mydata.postIndex[data.i];
			var $el = $('<input type="text" placeholder="0" value="'+postIndex+'" class="postIndex" data-view="add" onchange="closePostIndex(this.value, '+postIndex+')">');
			data.callback($el)
		},
		postIndex_hidden: function(data){
			var postIndex_h = data.mydata.postIndex[data.i];
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 ){
				var $el = $('<div>'+postIndex_h+'</div>');
			}else {
				if(postIndex_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		region_hidden: function(data){
			var region_h = data.mydata.region[data.i];
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 ){
				var $el = $('<div>'+region_h+'</div>');
			}else {
				if(region_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		city_hidden: function(data){
			var city_h = data.mydata.city[data.i];
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 ){
				var $el = $('<div>'+city_h+'</div>');
			}else {
				if(city_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		address_hidden: function(data){
			var address_h = data.mydata.address[data.i];
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 ){
				var $el = $('<div>'+address_h+'</div>');
			}else {
				if(address_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		house_hidden: function(data){
			var house_h = data.mydata.house[data.i];
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 ){
				var $el = $('<div>'+house_h+'</div>');
			}else {
				if(house_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		flat_hidden: function(data){
			var flat_h = data.mydata.flat[data.i];
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 ){
				var $el = $('<div>'+flat_h+'</div>');
			}else {
				if(flat_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		russianpostTrack_hidden: function(data){
			var russianpostTrack_h = data.mydata.russianpostTrack[data.i];
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 ){
				var $el = $('<div>'+russianpostTrack_h+'</div>');
			}else {
				if(russianpostTrack_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		size_hidden: function(data){
			var size_h = data.mydata.size[data.i];
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 ){
				var $el = $('<div>'+size_h+'</div>');
			}else {
				if(size_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		dop1_hidden: function(data){
			var dop1_h = data.mydata.dop1[data.i];
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 ){
				var $el = $('<div>'+dop1_h+'</div>');
			}else {
				if(dop1_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		domain2_hidden: function(data){
			var domain2_h = data.mydata.domain2[data.i];
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 ){
				var $el = $('<div>'+domain2_h+'</div>');
			}else {
				if(domain2_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		phone_hidden: function(data){
			var phone_h = data.mydata.phone[data.i];
			if(JSCat.Group.indexOf('admin') != -1 || JSCat.Group.indexOf('manager') != -1 ){
				var $el = $('<div>'+phone_h+'</div>');
			}else {
				if(phone_h != ''){
					var $el = $('<div><code>********</code></div>');
				}else{
					var $el = $('');
				}
			}
			data.callback($el)
		},
		status_select_hidden: function(data){
			if(JSCat.Group.indexOf('selectstatus') != -1 || JSCat.Group.indexOf('admin') != -1){
				var $el = $('<span class="label">Статус<i required>*</i></span>{{{status.select}}}');
			}else{
				var $el = $('');
			}
			data.callback($el)
		},
		status_text_hidden: function(data){
			if(JSCat.Group.indexOf('selectstatus') != -1 || JSCat.Group.indexOf('admin') != -1){
				var $el = $('<span class="label">Статус<i required>*</i></span>');
			}else{
				var $el = $('');
			}
			data.callback($el)
		},
		script_greeting: function(data){
			var goods = JSON.parse(data.mydata.goods_names[data.i]);
			var $el = $('<code>Нету скрипта к данному товару</code>');
			for(var Value in goods){
				if(Value != 33324){
					// console.log(goods[Value].name);
					for(var script in JSCat.salesScript){
						if(JSCat.salesScript[script].id == Value && JSCat.salesScript[script].script_greeting != ''){
							$el = $('<span>'+JSCat.salesScript[script].script_greeting+'</span>');
							// console.log(JSCat.salesScript[script]);
						}

					}
				}
			}
			data.callback($el)
		},
		script_confirms_order: function(data){
			var goods = JSON.parse(data.mydata.goods_names[data.i]);
			var $el = $('<code>Нету скрипта к данному товару</code>');
			for(var Value in goods){
				if(Value != 33324){
					// console.log(goods[Value].name);
					for(var script in JSCat.salesScript){
						if(JSCat.salesScript[script].id == Value && JSCat.salesScript[script].script_greeting != ''){
							var $el = $('<span>'+JSCat.salesScript[script].script_confirms_order+'</span>');
							// console.log(JSCat.salesScript[script]);
						}

					}
				}
			}
			
			data.callback($el)
		},
		script_end_call: function(data){
			var goods = JSON.parse(data.mydata.goods_names[data.i]);
			var $el = $('<code>Нету скрипта к данному товару</code>');
			for(var Value in goods){
				if(Value != 33324){
					// console.log(goods[Value].name);
					for(var script in JSCat.salesScript){
						if(JSCat.salesScript[script].id == Value && JSCat.salesScript[script].script_greeting != ''){
							var $el = $('<span>'+JSCat.salesScript[script].script_end_call+'</span>');
							// console.log(JSCat.salesScript[script]);
						}

					}
				}
			}
			
			data.callback($el)
		},
		getDouble: function(data) {
			var all = data.mydata.all[data.i];
			try {
				all = JSON.parse(all)
				var $el = $('<details><summary>Показать</summary><div><div><b>Заказы с этим номером телефона:</b></div></div></details>') 
				for (a in all)
					$el.find('div div').append('<a href="/partner?'+ all[a] +'&ids='+ a +'" target="_blank" rel="noopener noreferrer">'+ a +'</a>')
			} catch {
				var $el = $('<i time>Нет данных</i>')
			}
			data.callback($el)
		},
		timeClient: function(data) {
			var $el = $('<span></span>')
			function two(num) { return ("0" + num).slice(-2)} // подставляет недостающий ноль 
			// var time = new Date((util.now() - data.mydata.timezone[data.i]*60)*1000)

			if(data.mydata.timezone[data.i] != ''){
				var time = new Date((util.now() + data.mydata.timezone[data.i]*60)*1000);
			}else {
				var time = new Date((util.now() - data.mydata.timezone[data.i]*60)*1000);
			}
			var text = (time == 'Invalid Date') ? '<i time>Не указан часовой пояс</i>' : two(time.getUTCHours())+':'+ two(time.getUTCMinutes());
			
			$el.html(text)
			data.callback($el)
		},
		datashow: function(data) {
			var $el = $('<span></span>');
			$el.html(util.timeConverter(data.mydata.timeupdate[data.i]));
			data.callback($el);
		},
		dataspost: function(data) {
			var $el = $('<span></span>');
			$el.html(util.timeConverter(data.mydata.time[data.i]));
			data.callback($el);
		},
		datapod: function(data) {
			var $el = $('<span></span>');
			$el.html(util.timeConverter(data.mydata.time[data.i]));
			data.callback($el);
		},
		viewfunc: function(data) {
			var $el = $('<span></span>');
			data.callback($el);
		},
		pusrName: function(data) {
			var $el = $('<span></span>');
			data.callback($el);
		},
		useronline: function(data) {
			var $el = $('<span></span>');
			data.callback($el);
		},
		dmg: function(data) {
			var $el = $('<span></span>');
			$el.html(util.timeConverterWithYear(data.mydata.timeupdate[data.i]));
			data.callback($el);
		},
		calendar: function(data) {
			var $el = $( '<div><div id="picker"></div><input type="hidden" id="result" value="" /><div id="pickers"></div></div>' );
			$(document).ready(function() {
				$('#picker').dateTimePicker([data.IDbase, data.ID]);
			});
			data.callback( $el );
		},
		thead: function(data) {

			var $el = $('<td class="co"><a>1</a></td>\
			<td class="co"><a>1</a></td>\
			<td class="co"><a>1</a></td>\
			<td class="co"><a>1</a></td>\
			<td class="co"><a>1</a></td>\
			<td class="co"><a>1</a></td>');
// <th class="table_content"><td>1</td></th>\
// <th class="table_content"><td>1</td></th>\
// <th class="table_content"><td>1</td></th>\
// <th class="table_content"><td>1</td></th>\
// <th class="table_content"><td>1</td></th>');
			data.callback( $el );
		},
		history: function(data) {
			var $el = $('<div id="pickerhistory"><div>Нет последних событий</div></div>');
			if (data.ID) {
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] = "get_calendar_ad";
				json["list"] = data.IDbase;
				json["item"] = data.ID;
				$.post("/json/", json, function(result) {
					if (typeof result != 'object') result = JSON.parse(result);
					if (result != null) $el.empty();
					for (a in result)
						$el.append('<div><u style="background:' + result[a].backgroundColor + '"></u><span>'+ util.timeConverter(result[a].start) +'</span><span>'+ result[a].title +'</span><span>'+ result[a].description +'</span></div>');
				});
			}
					
			data.callback( $el );
		},
		write: function(data) {
	
			var $el = $( '<span><a crm="write">Комментарий</a></span>' );
			function writecontainer(list, item) {
				
				var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
				json["action"] = "writecontainer";
				json["list"] = list;
				json["item"] = item;
				$.post("/json/", json, function(a) {
					if (typeof a != 'object') a = JSON.parse(a);
					if (a == null) {
						alert('Отказано в доступе'); 
						return false;
					}
					$el.find('a[crm="write"]').after('<alert id="writecontainer"><span crm="writecontainer"><i class="close"></i><textarea placeholder="Комментарий (виден только вам)">'+ a.description +'</textarea><button crm="writedone">Сохранить</button></span></alert>');
					$el.find('.close').click(function(){
						$('#writecontainer').remove();
						return false;
					});
					$el.find('[crm="writedone"]').click(function(){
						var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
						json["action"] = "writecontainersave";
						json["list"] = list;
						json["item"] = item;
						json["description"] = $('#writecontainer textarea').val();
						$.post("/json/", json, function(a) {
							$('#writecontainer').remove();
							return false;
						});
					});
				});
			}
		
			$el.find('[crm="write"]').click(writecontainer.bind(this, data.IDbase, data.ID));
			data.callback( $el );
		},
		noob: function(data) {
			var link = 'https://'+ JSCat.domain +'/card?'+ data.IDbase +'-'+ data.ID;
			var $el = $( '<a target="_blank" href="'+ link +'">'+ link +'</a>' );
			data.callback( $el );
		},
		ids: function(data) {
			var id = (parseInt(data.ID) == data.ID) ? data.ID : '';
			var $el = $( '<span ids="'+ id +'">'+ id +'</span>' );
			data.callback( $el );
		},
		sip: function(data) {
			var id = (data.ID) ? data.ID : '';
			var $el = $( '<div class="btn-group"></span>' );
		
			$el.append('<button class="btn btn-warning" id="btn-mute" type="button" style="display:none;"><i class="icon-microphone"></i></button>\
				<button class="btn btn-danger" id="btn-hangup" style="display:none;" type="button">\
		  <i class="icon-muted"></i>\
		  <span class="call-log"></span>\
		  <span class="call-timer"><span id="call-duration-min">00</span>:<span id="call-duration-sec">00</span></span>\
		</button>\
		<button class="btn btn-success" type="button" id="btn-call-prefer" style="display: inline-block;"><a class="btns-prefer" data-num="+'+ data.mydata.phone[data.i] +'" href="sip:+'+ data.mydata.phone[data.i] +'" data-call="sip-direct">Позвонить (Intelcom)</a></button>\
				<button class="btn dropdown-toggle btn-success" data-toggle="dropdown" style="display: inline-block;"><span class="caret"></span></button>\
				<ul class="dropdown-menu pull-right" style="text-align: left">\
					<li><a class="btns-prefer" href="sip:+'+ data.mydata.phone[data.i] +'" id="sip-direct" data-call="sip-direct">Прямой звонок по ссылке sip</a></li>\
					<li><a class="btns-prefer" href="tel:+'+ data.mydata.phone[data.i] +'" id="tel-direct" data-call="tel-direct">Прямой звонок по ссылке tel</a></li>\
					<li><a class="btns-prefer" href="callto:+'+ data.mydata.phone[data.i] +'" id="callto-direct" data-call="callto-direct">Прямой звонок по ссылке callto</a></li>\
				</ul>\
				<audio id="audio-remote" style="display:none;" autoplay="autoplay"></audio>\
			</div>');

			$el.append('<button class="btn btn-warning" id="btn-mute2" type="button" style="display:none;"><i class="icon-microphone"></i></button>\
				<button class="btn btn-danger" id="btn-hangup2" style="display:none;" type="button">\
		  <i class="icon-muted"></i>\
		  <span class="call-log"></span>\
		  <span class="call-timer"><span id="call-duration-min2">00</span>:<span id="call-duration-sec2">00</span></span>\
		</button>\
		<button class="btn btn-success" type="button" id="btn-call-prefer2" style="display: inline-block;"><a class="btns-prefer" data-num="+'+ data.mydata.phone[data.i] +'" href="sip:+'+ data.mydata.phone[data.i] +'" data-call="sip-direct">Позвонить (Sipnet)</a></button>\
				<button class="btn dropdown-toggle btn-success" data-toggle="dropdown" style="display: inline-block;"><span class="caret"></span></button>\
				<ul class="dropdown-menu pull-right" style="text-align: left">\
					<li><a class="btns-prefer" href="sip:+'+ data.mydata.phone[data.i] +'" id="sip-direct2" data-call="sip-direct">Прямой звонок по ссылке sip</a></li>\
					<li><a class="btns-prefer" href="tel:+'+ data.mydata.phone[data.i] +'" id="tel-direct2" data-call="tel-direct">Прямой звонок по ссылке tel</a></li>\
					<li><a class="btns-prefer" href="callto:+'+ data.mydata.phone[data.i] +'" id="callto-direct2" data-call="callto-direct">Прямой звонок по ссылке callto</a></li>\
				</ul>\
				<audio id="audio-remote2" style="display:none;" autoplay="autoplay"></audio>\
			</div>');

			$el.append('<button class="btn btn-warning" id="btn-mute3" type="button" style="display:none;"><i class="icon-microphone"></i></button>\
				<button class="btn btn-danger" id="btn-hangup3" style="display:none;" type="button">\
		  <i class="icon-muted"></i>\
		  <span class="call-log"></span>\
		  <span class="call-timer"><span id="call-duration-min3">00</span>:<span id="call-duration-sec3">00</span></span>\
		</button>\
		<button class="btn btn-success" type="button" id="btn-call-prefer3" style="display: inline-block;"><a class="btns-prefer" data-num="+'+ data.mydata.phone[data.i] +'" href="sip:+'+ data.mydata.phone[data.i] +'" data-call="sip-direct">Позвонить (Newvats)</a></button>\
				<button class="btn dropdown-toggle btn-success" data-toggle="dropdown" style="display: inline-block;"><span class="caret"></span></button>\
				<ul class="dropdown-menu pull-right" style="text-align: left">\
					<li><a class="btns-prefer" href="sip:+'+ data.mydata.phone[data.i] +'" id="sip-direct3" data-call="sip-direct">Прямой звонок по ссылке sip</a></li>\
					<li><a class="btns-prefer" href="tel:+'+ data.mydata.phone[data.i] +'" id="tel-direct3" data-call="tel-direct">Прямой звонок по ссылке tel</a></li>\
					<li><a class="btns-prefer" href="callto:+'+ data.mydata.phone[data.i] +'" id="callto-direct3" data-call="callto-direct">Прямой звонок по ссылке callto</a></li>\
				</ul>\
				<audio id="audio-remote3" style="display:none;" autoplay="autoplay"></audio>\
			</div>');
			data.callback( $el );
		},
		wrong: function(data) {
			var $el = $('<details wrong><summary>Жалоба</summary>\
					<label><input type="radio" name="reason" id="w1' + data.IDbase + '' + data.ID + '' + data.i + '">Не актуально</label>\
					<label><input type="radio" name="reason" id="w2' + data.IDbase + '' + data.ID + '' + data.i + '">Неверная цена</label>\
					<label><input type="radio" name="reason" id="w3' + data.IDbase + '' + data.ID + '' + data.i + '">Не дозвониться</label></details>');
			
			function sendwrong(data) {
				var json = {func:'CWrongs', domain:JSCat.domain, token:JSCat.token};
				json["action"] = "creat_wrongs";
				json["list_id"] = data.IDbase;
				json["card_id"] = data.ID;
				json["param"] = $("input[name='reason']:checked").parent().text();
				$.post("/json/", json, function() {
					$('details[wrong] summary').text('Жалоба отправлена');
					$('details[wrong]').removeAttr('open');
				});
			}
			$el.find("input[name='reason']").change(sendwrong.bind(this, data));
			data.callback( $el );
		},
		current: function(data) {
			var $el = $( '<span></span>' );
			$el.append($('title').text());
			data.callback( $el );
		},
		add: function(param) {
			var coords;
			var myMap;
			var myGeocoder;
			var firstready = false;
			var newCenter;
			
			GLOBAL.current.list_id = param.id;
			
			renderer.get.listIfUndefined( {
				list_id:	param.id
			}, function( list ) {
				GLOBAL.cache.lists[param.id] = list;
				var container = document.createElement("div");
				$(container).append(list.html9)
				$(param.formContent).append(container);
				//сохранение формы
				renderer.draw.onReady(
					renderer.cfg.selectors.form_action_save, function() {
						
						setTimeout(function() {

							if (save_form = $(renderer.cfg.selectors.form_action_save).get(0)) {
								var form_options = $(save_form).data('options') || {};
								var item_id = (form_options.data.ids) ? form_options.data.ids : 0;
								$( renderer.cfg.selectors.form_action_save ).unbind('click').click(function(event) {
									//проверка на обязательные поля
									var compare = false;
						
									//формируем данные для отправки									
									var json = {func:'CEditCat', domain:JSCat.domain, token:JSCat.token, user:JSCat.user};
									json["action"] = "add1";
									json["item_id"] = item_id;
									json["list_id"] = param.id;
									json["field"] = {};

									for (var fieldname in list.field) {
										
										json["field"][fieldname] = '';
										var $items = $( '.' + fieldname + '[data-view="add"]' );
										if( $items.length > 1 ) {
											var filters = ['[data-form]', 'input', 'select', 'textarea'];
											for( var k = 0; k < filters.length; k++ ) {
												var $search_field = $items.filter( filters[k] );
												if( $search_field.length ) {
													field = $search_field.get(0);
													break;
												}
											}
										} else field = $items.get(0);
										
										if ( field ) {
											var data = json["field"][fieldname];
											data = (typeof($(field).attr('data-form')) != 'undefined') ? $(field).attr('data-form') : field.value;
											
											// Если статус 2 
											// if(fieldname == 'operator' && json["field"].status == 2){
											// 	data = 0;
											// 	console.log(data);
											// }
											//проверка на обязательные поля
											if (list.field[fieldname].required == '1') {
												var fieldtype = list.field[fieldname].type;
												
												var fieldarr = ['text', 'textarea', 'textint'];
												if ((fieldarr.includes(fieldtype) && data.length <= 0 ) || ( fieldtype == 'select' && data == '0' )|| ( fieldtype == 'radiobtn' && !data )) {
													$('.' + fieldname).addClass('required'), compare = true;
												} else $('.' + fieldname).removeClass('required');
												
												//selectmenu
												if (fieldtype == 'selectmenu' && data == '{}') {
													$('.' + fieldname + ' select').addClass('required'), compare = true;
												} else $('.' + fieldname + ' select').removeClass('required');
												
												//fotoalbum
												if (fieldtype == 'fotoalbum' && data == '{}') {
													$('.' + fieldname + ' .listimg0').addClass('required'), compare = true;
												} else $('.' + fieldname + ' .listimg0').removeClass('required');
											}
											
											json["field"][fieldname] = (typeof($(field).attr('data-form')) != 'undefined') ? $(field).attr('data-form') : field.value;
										}
									}
									
									//если поле не заполнено
									if (compare) {
										alert('Не все обязательные поля заполнены')
										$('.save[action]').text('Сохранить')
										return false;
									}

									var decline = false;

									if (typeof($('.postIndex').val()) != 'undefined') {
										if ($('.postIndex').val().length != 6 || !Number.isInteger(Number($('.postIndex').val()))) decline = '.postIndex';
										if ($('.postIndex').val().length == 0) decline = false;
									}
									
									if ($('button#btn-mute').css('display') != 'block') {
										$('.save[action]').text('Ожидайте...')	

										if (decline == false) {
											if(json.field.status == 2){
												json.user = 0;
												json.field.operator = 0;
											}
											//продолжаем формировать данные для отправки
											$.post("/json/", json, function(result) {//.filter(word => word.length > 6)
												if (typeof result !== 'object') result = JSON.parse(result);
												$('#smsText').val('')
												$('.currentSms[data-view="add"]').removeAttr('data-form').val('')
		
												alert('Сохранено')
												$('input').removeClass('danger')
												$('.save[action]').text('Сохранить')
												if (result != '0') {
													setTimeout(function(){
														//location.reload()
														//$('.closeform').click()
													}, 1e3)
												} else if (result == '0') {
													alert('Запись не добавлена. Обратитесь в поддержку')
												}
											});
										} else {
											$('.save[action]').text('Сохранить')
											$(decline).addClass('danger')
											alert('Не все поля заполнены корректно')
										}
									} else {
										alert('Сначала завершите разговор')
									}
								});
							}
						}, 500);
					}
				);
			});
		}
	},
	process: {
		known_elements: function() {
			this.add();
			this.search();
			this.table();
			this.calls();
			this.stuff();
		},
		hash_links: {
			init: function() {
				var hash = util.get.url_hash();
				if (hash) {
					var try_card = hash.match(new RegExp('^([0-9]+)-([0-9]+)$', 'ig'));
					if (try_card != null && try_card.length > 0) {
						var params = try_card[0].split('-');
						if (params.length == 2) {
							if (window.location.href.match(new RegExp('edit', 'ig')).length > 0) renderer.cfg.hash_params.action = 'edit_card';
							else renderer.cfg.hash_params.action = 'full_card';
							renderer.cfg.hash_params.list_id = params[0];
							renderer.cfg.hash_params.item_id = params[1];
						}
					}
					renderer.process.hash_links.full_card()
				}
			},
			full_card: function() {

				if (renderer.cfg.hash_params.action == 'edit_card') {
					//setTimeout(function() {
					renderer.get.query({
						action: 'listing',
						post: {
							method: 'get',
							list_id: renderer.cfg.hash_params.list_id,
							item_id: renderer.cfg.hash_params.item_id,
							price:	 'new',
							count:	 '1'
						},
						callback: function() {
							var json = this;
							if (json.status == 'good' && json.result.length == 1) {
								var options = $.extend({}, {
									selector_add_form: renderer.cfg.selectors.add_form,
									use_parent_container: true,
									list_id: GLOBAL.current.list_id,
									list: GLOBAL.cache.lists[GLOBAL.current.list_id],
									mode: 'inner_html'
								}, {
									selector_add_form: renderer.cfg.selectors.add_item_container,
									list_id: renderer.cfg.hash_params.list_id,
									mode: 'append',
									use_parent_container: false
								});
								renderer.draw.formAdd({
									$container: $(options.selector_add_form),
									selector_add_form: options.selector_add_form,
									list: GLOBAL.cache.lists[renderer.cfg.hash_params.list_id],
									list_id: renderer.cfg.hash_params.list_id,
									data: json.result[0],
									mode: options.mode,
									use_parent_container: options.use_parent_container
								});
							}
							/*if (json.status == 'good' && json.result.length == 1) {
								renderer.get.listIfUndefined({
									list_id: renderer.cfg.hash_params.list_id
								}, function(list) {
									var $root_container = $('div#detail');
									$(renderer.cfg.selectors.calls).each(function() {
										var $container = $(this);
										if ($container.attr('list') && $container.attr('list') == renderer.cfg.hash_params.list_id) {
											$root_container = $container;
											return false;
										}
									});
									
								});
							}*/
						}
					});
					//}, 2000);
				}
				else {
					renderer.get.query({
						action: 'listing',
						post: {
							method: 'get',
							list_id: renderer.cfg.hash_params.list_id,
							item_id: renderer.cfg.hash_params.item_id,
							price:	 'new',
							count:	 '1'
						},
						callback: function() {
							var json = this;
							if (json.status == 'good' && json.result.length == 1) {
								renderer.get.listIfUndefined({
									list_id: renderer.cfg.hash_params.list_id
								}, function(list) {
									var $root_container = $('div#detail');
									$(renderer.cfg.selectors.calls).each(function() {
										var $container = $(this);
										if ($container.attr('list') && $container.attr('list') == renderer.cfg.hash_params.list_id) {
											$root_container = $container;
											return false;
										}
									});
									renderer.draw.el({
										view: 'listing',
										container: $root_container,
										mode: 'append',
										tpl: list.html7,
										data: json.result[0],
										list: list,
										list_id: renderer.cfg.hash_params.list_id,
										callback: function($html) {
											renderer.process.cardActions($html, function() {
												var $html = $(this);
												if (renderer.cfg.on_full_card_hide_all_calls) {
													$(renderer.cfg.selectors.calls).hide();
												} else {
													if ($calls_container) {
														$calls_container.hide();
													}
												}
												renderer.draw.card.call($html.get(0));
											});
										}
									});
								});
							}
						}
					});
				}
			}
		},
		add_render_form_item: function(params) {
			$(document).stopobserve(renderer.cfg.selectors.add_form);
			var options = $.extend({}, {
				selector_add_form: renderer.cfg.selectors.add_form,
				use_parent_container: true,
				list_id: GLOBAL.current.list_id,
				list: GLOBAL.cache.lists[GLOBAL.current.list_id],
				mode: 'inner_html',
				data: null
			}, params);
			$(options.selector_add_form).hide();
			renderer.get.list_columns(options.list_id, function(data) {
				if (!util.isEmpty(options.data) && typeof(options.data.html) != 'undefined' && typeof(options.data.html.options) != 'undefined' && typeof(options.data.html.options.data) != 'undefined') {
					data = options.data.html.options.data;
				}
				renderer.draw.formAdd({
					$container: $(options.selector_add_form),
					selector_add_form: options.selector_add_form,
					list: GLOBAL.cache.lists[options.list_id],
					list_id: options.list_id,
					data: data,
					mode: options.mode,
					use_parent_container: options.use_parent_container
				});

			});
		},
		search_render_form_item: function(params) {
			$(document).stopobserve(renderer.cfg.selectors.search_item_container);
			var options = $.extend({}, {
				selector_search_form: renderer.cfg.selectors.search_item_container,
				use_parent_container: true,
				list_id: GLOBAL.current.list_id,
				list: GLOBAL.cache.lists[GLOBAL.current.list_id],
				mode: 'inner_html',
				data: null
			}, params);
			$(options.selector_search_form).empty().hide();

			renderer.get.list_columns(options.list_id.id, function(data) {
				if (!util.isEmpty(options.data) && typeof(options.data.html) != 'undefined' && typeof(options.data.html.options) != 'undefined' && typeof(options.data.html.options.data) != 'undefined') {
					$.extend(data, options.data.html.options.data);
				}
				renderer.draw.formSearch({
					$container: $(options.selector_search_form),
					selector_search_form: options.selector_search_form,
					list: GLOBAL.cache.lists[options.list_id],
					list_id: options.list_id,
					data: data,
					mode: options.mode,
					use_parent_container: options.use_parent_container
				});
			});
		},
		table_render_form_item: function(params) {
			$(document).stopobserve(renderer.cfg.selectors.table_item_container);
			var options = $.extend({}, {
				selector_table_form: renderer.cfg.selectors.table_item_container,
				use_parent_container: true,
				list_id: GLOBAL.current.list_id,
				list: GLOBAL.cache.lists[GLOBAL.current.list_id],
				mode: 'inner_html',
				data: null
			}, params);
			$(options.selector_table_form).empty().hide();

			renderer.get.list_columns(options.list_id.id, function(data) {
				if (!util.isEmpty(options.data) && typeof(options.data.html) != 'undefined' && typeof(options.data.html.options) != 'undefined' && typeof(options.data.html.options.data) != 'undefined') {
					$.extend(data, options.data.html.options.data);
				}
				renderer.draw.formTable({
					$container: $(options.selector_table_form),
					selector_table_form: options.selector_table_form,
					list: GLOBAL.cache.lists[options.list_id],
					list_id: options.list_id,
					data: data,
					mode: options.mode,
					use_parent_container: options.use_parent_container
				});
			});
		},
		cardActions: function($html, callback) {
			var $calls_container = util.dom.searchCallsContainer($html);
			if ($calls_container) {
				$html.data('calls_container', $calls_container);
			}
			var html_data = $html.data();
			if (typeof(callback) == 'undefined') var callback = function() {};
			$html.find(renderer.cfg.selectors.add_item_click).data('html', html_data);
			$html.find(renderer.cfg.selectors.add_item_delete).click(function() {
				confirm({
					text: 'Выбранная запись будет удалена, продолжить?',
					ok: function() {
						util.ajax({
							url_prefix: util.cfg.url.func_lk,
							post: {
								action: 'deleteCard',
								dellArr: new Array({
									ID: html_data.options.data.ids,
									IDbase: html_data.options.list_id
								})
							},
							callback: function(response) {
								$html.remove();
							}
						});
					},
					cancel: function() {}
				});
				return false;
			});
			$html.find(renderer.cfg.selectors.add_item_public).click(function() {
				confirm({
					text: 'Опубликовать объявление?',
					ok: function() {
						util.ajax({
							url_prefix: util.cfg.url.func_lk,
							post: {
								action: 'publicCard',
								publicArr: new Array({
									ID: html_data.options.data.ids,
									IDbase: html_data.options.list_id
								})
							},
							callback: function(response) {
								$html.remove();
							}
						});
					},
					cancel: function() {}
				});
				return false;
			});
			$html.find(renderer.cfg.selectors.add_item_republic).click(function() {
				confirm({
					text: 'Снять объявление с публикации?',
					ok: function() {
						util.ajax({
							url_prefix: util.cfg.url.func_lk,
							post: {
								action: 'republicCard',
								republicArr: new Array({
									ID: html_data.options.data.ids,
									IDbase: html_data.options.list_id
								})
							},
							callback: function(response) {
								$html.remove();
							}
						});
					},
					cancel: function() {}
				});
				return false;
			});
			$html.find(renderer.cfg.selectors.premium_item).click(function() {
				
				var type = $(this).attr('premium'),
					left = '0',
					color = '0';
				
				renderer.get.query({
					action: 'dbsettings',
					post: {
						method: 'get',
						list: 'premium_color;premium_left'
					},
					callback: function() {
						var json = this;
						if (json.status == 'good') {
							left = json.result.premium_left;
							color = json.result.premium_color;
							if ( type == '1' ) {
								var text = 'Применить услугу? ';
								if ( color == '' || color == '0' ) text = 'Применить услугу?';
							}
							
							if ( type == '2' ) {
								var text = 'Применить услугу? ';
								if ( left == '' || left == '0' ) text = 'Применить услугу?';
							}
												
							confirm({
								text: text, 					
								ok: function() {
									util.ajax({
										url_prefix: util.cfg.url.func_lk,
										post: {
											action: 'premiumCard',
											premiumArr: new Array({
												ID: 	html_data.options.data.ids,
												IDbase: html_data.options.list_id,
												Type: 	type
											})
										},
										callback: function(response) {
											alert(response);
										}
									});
								},
								cancel: function() {}
							});
						}
					}
				});
				return false;
			});
			$html.find(renderer.cfg.selectors.card_openp).click(function() {
				$('body').addClass('noscroll');
				renderer.draw.card.call($html.get(0));
				return false;
			});
			$html.find(renderer.cfg.selectors.card_opennext).click(function() {
				document.location.href = $(this).attr("href");
				localStorage.setItem('user', html_data.options.data.id_user)
			});
			$html.find(renderer.cfg.selectors.card_openblank).click(function() {
				window.open($(this).attr("href"));
			});
			$html.find(renderer.cfg.selectors.add_item_click).click(function() {
				var htmldata = {};
				htmldata.html = html_data;
				renderer.process.add_render_form_item({
					selector_add_form: renderer.cfg.selectors.add_item_container,
					list_id: $(this).attr('list'),
					mode: 'append',
					use_parent_container: false,
					data: htmldata
				});
				return false;
			});
			callback.call($html.get(0));
		},
		add: function() {
			renderer.draw.onReady(renderer.cfg.selectors.add_form, function() {
				var $here = $(this).data();
				if (!$here.options.data) {
					var $param = data.mydata.id
				}else {
					var $param = $here.options.data.id
				}
				$.ajax({
					type: 'post',
					url: 'lib/ratSearch.php',
					data: {
						userId:JSCat.user,
						userName:JSCat.userName,
						param:$param,
						btn:"New"
					  }
				});
				if (!$(renderer.cfg.selectors.add_item_container).length) renderer.process.add_render_form_item();
			});
			renderer.draw.onReady(renderer.cfg.selectors.change_category, function() {
				$(this).click(function() {
					return false;
				});
			});
			renderer.draw.onReady(renderer.cfg.selectors.add_form_tabs, function() {
				$(this).click(function() {
					$(document).stopobserve(renderer.cfg.selectors.add_form);
					$(document).observe(renderer.cfg.selectors.add_form, renderer.process.add_render_form_item);
				});
			});
			renderer.draw.onReady(renderer.cfg.selectors.add_item_click, function() {
				/*
					* TO-DO <a crm="edit" list="17" class="add" title="Редактировать"></a>
				*/
				$(this).unbind('click').click(function() {
					// var $here = $(this).data();
					
					renderer.process.add_render_form_item({
						selector_add_form: renderer.cfg.selectors.add_item_container,
						list_id: $(this).attr('list'),
						mode: 'append',
						use_parent_container: false,
						data: $(this).data()
					});
					return false;
				});
			});
		},
		table:  function() {
			
			if ($(renderer.cfg.selectors.table_item_container).attr('list'))		
			renderer.get.listIfUndefined({
				list_id: $(renderer.cfg.selectors.table_item_container).attr('list')
			}, function(list) {
				GLOBAL.cache.lists[list] = list;
				$(renderer.cfg.selectors.table_item_container).empty().append(list.html4);
				
				renderer.process.table_render_form_item({
					selector_table_form: renderer.cfg.selectors.table_item_container,
					list_id: list,
					mode: 'append',
					use_parent_container: false,
					data: $(this).data()
				});

				renderer.draw.onReady( renderer.cfg.selectors.form_action_table, function() {	
					if ($(renderer.cfg.selectors.form_action_table).get(0)) {
						$('#table_content th[label]').unbind('click').click(function(event) {
							var item = $(this)
							var ascdesc = 'asc';

							var list = localStorage.list;
							var name = item.attr('label')
							if (item.hasClass('top')) {
								$('#table_content th[label]').removeClass('top').removeClass('bottom')
								item.addClass('bottom')
								ascdesc = 'desc'
							} else {
								$('#table_content th[label]').removeClass('top').removeClass('bottom')
								item.addClass('top')
								ascdesc = 'asc'
							}
							
							$('thead#table_content[list="'+ list +'"], tbody.call[list="'+ list +'"]').attr('order_by', name +'-'+ ascdesc)
							$('tbody.call').remove().clone().appendTo('.requesttable')
							//localStorage.removeItem('search')//.setItem('search',{})
							setTimeout(() => {renderer.process.calls()}, 100)
							return false;
						});
						//сброс настроек фильтрации по полю asc/desc
						$( renderer.cfg.selectors.form_action_table ).unbind('click').click(function(event) {
							location.reload()
						});
					}
				});
			});
// 	
// 			renderer.draw.onReady(renderer.cfg.selectors.table_item_container, function() {
// 				if (!$(renderer.cfg.selectors.table_item_container).length) renderer.process.search_render_form_item();
// 			});

// 			renderer.draw.onReady(renderer.cfg.selectors.search_form_tabs, function() {
// 				$(this).click(function() {
// 					$(document).stopobserve(renderer.cfg.selectors.table_item_container);
// 					$(document).observe(renderer.cfg.selectors.table_item_container, renderer.process.search_render_form_item);
// 				});
// 			});
// 			renderer.draw.onReady(renderer.cfg.selectors.search_item_click, function() {
// 				$(this).unbind('click').click(function() {
// 					renderer.process.search_render_form_item({
// 						selector_search_form: renderer.cfg.selectors.table_item_container,
// 						list_id: $(this).attr('list'),
// 						mode: 'append',
// 						use_parent_container: false,
// 						data: $(this).data()
// 					});
// 					return false;
// 				 });
// 			});
		},
		search: function() {
			if ($(renderer.cfg.selectors.search_item_container).attr('list'))		
			renderer.get.listIfUndefined({
				list_id: $(renderer.cfg.selectors.search_item_container).attr('list')
			}, function(list) {
				GLOBAL.cache.lists[list] = list;
				$(renderer.cfg.selectors.search_item_container).empty().append(list.html3);
				
				renderer.process.search_render_form_item({
					selector_search_form: renderer.cfg.selectors.search_item_container,
					list_id: list,
					mode: 'append',
					use_parent_container: false,
					data: $(this).data()
				});

				renderer.draw.onReady( renderer.cfg.selectors.form_action_search, function() {	
					if (saveform = $(renderer.cfg.selectors.form_action_search).get(0)) {
						$( renderer.cfg.selectors.form_action_search ).unbind('click').click(function(event) {
							localStorage.removeItem('search');
							//var point = $('#sorter').parent().attr('class');
							var list = $(renderer.cfg.selectors.search_item_container).attr('list');							
							
							var elems = $('[data-view="search"]');
							var search = {};	
							
							for (var i = 0; i < elems.length; i++) {
								var elem = $(elems[i]);
								var split = elem.attr('class').split(' ');
								var item = (split[1]) ? split[1] : split[0];
								var range = elem.attr('range');
								if (typeof range !== typeof undefined && range !== false) {
									search[item] = {'in' : elem.attr('data-form-in'), 'out' : elem.attr('data-form-out')};
								} else {
									search[item] = elem.attr('data-form')
								}
							}

							function clearEmpties(o) {
								for (var k in o) {
									if (!o[k] || typeof o[k] !== "object") {
										if (o[k] === null || o[k] === undefined || o[k] == '0' || o[k] == '') delete o[k];
									} else {
										if (Object.keys(o[k]).length === 0) {
											delete o[k];
										} else {
											clearEmpties(o[k]);
										}
									}
								}
							}
							clearEmpties(search);
							clearEmpties(search);

							localStorage.setItem('search', JSON.stringify(search));
							
							$( '#list2 .call, #list2 div[paginator]').remove().clone().appendTo('#list2');
							$( 'tbody.call').remove().clone().appendTo('.requesttable');

							renderer.process.calls();
							return false;
													
						});
						
						
						$('.search select').change(function() {
							$(renderer.cfg.selectors.form_action_search).click();
						});
			
			
			
			
					}
				});
				renderer.draw.onReady( renderer.cfg.selectors.form_clear_search, function() {	
					$( renderer.cfg.selectors.form_clear_search ).unbind('click').click(function(event) {
						localStorage.search = '';
						renderer.process.search();
						setTimeout(function() {
							$(renderer.cfg.selectors.form_action_search).click();
						}, 100);
						return false;						
					});
				});
			});
	
			renderer.draw.onReady(renderer.cfg.selectors.search_item_container, function() {
				if (!$(renderer.cfg.selectors.search_item_container).length) renderer.process.search_render_form_item();
			});
			renderer.draw.onReady(renderer.cfg.selectors.change_category, function() {
				$(this).click(function() {
					return false;
				});
			});
			renderer.draw.onReady(renderer.cfg.selectors.search_form_tabs, function() {
				$(this).click(function() {
					$(document).stopobserve(renderer.cfg.selectors.search_item_container);
					$(document).observe(renderer.cfg.selectors.search_item_container, renderer.process.search_render_form_item);
				});
			});
			renderer.draw.onReady(renderer.cfg.selectors.search_item_click, function() {
				$(this).unbind('click').click(function() {
					renderer.process.search_render_form_item({
						selector_search_form: renderer.cfg.selectors.search_item_container,
						list_id: $(this).attr('list'),
						mode: 'append',
						use_parent_container: false,
						data: $(this).data()
					});
					return false;
				 });
			});
		},
		//сортировка, текстовый поиск и пагинация
		pagination: function(count_all, count, list, offset) {
							
			//определяем переменные
			$( '[data-sorter="text"]' ).unbind();
			$( '[data-sorter="price"]' ).unbind();
			$( '[data-sorter="users"]' ).unbind();
			$( '[data-sorter="feeds"]' ).unbind();
			$( '[data-sorter="raions"]' ).unbind();
			$( '[data-sorter="usertype"]' ).unbind();
			
			//определяем переменные
		 localStorage.list = list;
			var text = $( '[data-sorter="text"]' ).val();
			if(!localStorage.price) localStorage.setItem('price','new');
			if(!localStorage.users) localStorage.setItem('users','all');
			if(!localStorage.feeds) localStorage.setItem('feeds','all');
			if(!localStorage.raions) localStorage.setItem('raions','all');
			$('[data-sort="' + localStorage.price + '"]').attr("selected", true);			
			
			if(!localStorage.usertype) {
				localStorage.setItem('usertype','all');
				$( '[data-sorter="usertype"] label' ).removeClass('page_in');
				$( '[data-sort="all"]' ).parent().addClass('page_in').prop( "checked", true );
			}
			
			//сортировка новые, дороже, дешевле
			$( '[data-sorter="price"]' ).change(function() {
				$( '[data-sorter="price"] option:selected' ).each(function() {
					localStorage.price = $( this ).attr( 'data-sort' );
				offset = '0';
				datapage();
				});
			});
			
			//сортировка по пользователям
			$( '[data-sorter="users"]' ).change(function() {
				$( '[data-sorter="users"] option:selected' ).each(function() {
					localStorage.users = $( this ).attr( 'users' );
				offset = '0';
				datapage();
				});
			});
			
			//поиск по тексту
			$( '[data-sorter="text"]' ).change(function() {
				text = $( '[data-sorter="text"]' ).val();
				offset = '0';
				datapage();
			});
			
			//выводим список страниц
			if ( offset == '0' ) {
				$('[paginator]').empty();
				var Pagination = {
					code: '',
					Extend: function(data) {
						data = data || {};
						Pagination.size = data.size || 10;
						Pagination.page = data.page || 1;
						Pagination.step = data.step || 3;
					},
					Add: function(s, f) {
						for (var i = s; i < f; i++) {
							Pagination.code += '<span data-page='+ i + '>' + i + '</span>';
						}
					},
					Last: function() {
						// var la = Pagination.size -1;
						// Pagination.code += '<i>...</i><span data-page='+ la + '>' + la + '</span>';
						Pagination.code += '<i>...</i><span data-page='+ Pagination.size + '>' + Pagination.size + '</span>';
					},
					First: function() {
						Pagination.code += '<span data-page="1">1</span><i>...</i>';
					},
					Click: function() {
						Pagination.page = +this.innerHTML;
						Pagination.Start();
						cntpage(Pagination.page)
					},
					Prev: function() {
						Pagination.page--;
						if (Pagination.page < 1) {
							Pagination.page = 1;
						}
						Pagination.Start();
						cntpage(Pagination.page)
					},
					Next: function() {
						Pagination.page++;
						if (Pagination.page > Pagination.size) {
							Pagination.page = Pagination.size;
						}
						Pagination.Start();
						cntpage(Pagination.page)
					},
					Bind: function() {
						var a = Pagination.e.getElementsByTagName('span');
						for (var i = 0; i < a.length; i++) {
							if (+a[i].innerHTML === Pagination.page) a[i].className = 'page_in';
							a[i].addEventListener('click', Pagination.Click, false);
						}
					},
					Finish: function() {
						Pagination.e.innerHTML = Pagination.code;
						Pagination.code = '';
						Pagination.Bind();
					},
					Start: function() {
						if (Pagination.size < Pagination.step * 2 + 6) {
							Pagination.Add(1, Pagination.size + 1);
						} else if (Pagination.page < Pagination.step * 2 + 1) {
							Pagination.Add(1, Pagination.step * 2 + 8);
							Pagination.Last();
						} else if (Pagination.page > Pagination.size - Pagination.step * 2) {
							Pagination.First();
							Pagination.Add(Pagination.size - Pagination.step * 2 - 2, Pagination.size + 1);
						} else {
							Pagination.First();
							if(Pagination.page >= 7 && (Pagination.size - 6) > Pagination.page){
								Pagination.Add(Pagination.page - 5, Pagination.page + 6);
							}else if(Pagination.page >= 7 ){
								Pagination.Add(Pagination.page - 5, Pagination.page + Pagination.step + 1);
							}else {
								Pagination.Add(Pagination.page - Pagination.step, Pagination.page + Pagination.step + 1);
							}
							Pagination.Last();
						}
						Pagination.Finish();
					},
					Buttons: function(e) {
						var nav = e.getElementsByTagName('span');
						nav[0].addEventListener('click', Pagination.Prev, false);
						nav[1].addEventListener('click', Pagination.Next, false);
					},
					Create: function(e) {
						var html = [
							'<span>&#9668;</span>',
							'<a></a>',
							'<span>&#9658;</span>'
						];
						e.innerHTML = html.join('');
						Pagination.e = e.getElementsByTagName('a')[0];
						Pagination.Buttons(e);
					},
					Init: function(e, data) {
						Pagination.Extend(data);
						Pagination.Create(e);
						Pagination.Start();
					}
				}

				function pinit() {
					var n =  Math.ceil(count_all / count);
					if (Math.abs(n) != 0) {
						Pagination.Init(document.querySelector('[paginator]'), {
							size: n, // pages size
							page: 1,  // selected page
							step: 1   // pages before and after 
						});
					}
				}
				pinit();

				//скрываем пагинацию по условию ??????
				if ( Math.ceil( count - count_all ) >= 0 )  {
					$('[paginator]').hide();
				} else { 
					$('[paginator]').show();
				}
			}
			//переход по пагинации		
			function cntpage(i){
				$('[paginator] span').removeClass('page_in');
				$('span[data-page="'+ i + '"]').addClass('page_in');
				offset = Math.ceil((i - 1) * count);
				datapage();
			}

			//листаем
			function datapage() {
				$('html, body').animate({
					scrollTop: parseInt($('[searcher]').offset().top) - 70
				}, 'slow');
				//отрисовываем
				$(renderer.cfg.selectors.calls).map(function() {
					//зачищаем контейнеры
					var $calls_root = $(this).empty();

					if (typeof($calls_root.attr('user')) != 'undefined') {
						var region				= $calls_root.attr('region');
						var pagination 		= $calls_root.attr('pagination');
						var my_list_id 		= localStorage.list;
						var order_by 			= $calls_root.attr('order_by') || '';
						var user_id 			= $calls_root.attr('user') || '';
						var status 				= $calls_root.attr('status') || 'all';
						var count 				= $calls_root.attr('count') || '1';
						var search = '';
						if ( localStorage.search ) search += localStorage.search;
						renderer.get.query({
							func: 'CEditCat',
							action: 'listing',
							post: {
								method: 'get',
								offset: offset,
								region: region,
								pagination: pagination,
								list_id: my_list_id,
								text: text,
								search: search,
								page: window.location.search.substr(1).split('&')[0],
								order_by: order_by,
								status: status,
								raions: localStorage.raions,
								price: localStorage.price,
								usertype: localStorage.usertype,
								user_id: user_id,
								count: count
							},
							callback: function() {
								var json = this;
								if (json.status == 'good') {
									renderer.get.listIfUndefined({
										list_id: my_list_id
									}, function(list) {
										renderer.process.showCardsList(json, list, $calls_root);
										localStorage.setItem('countall', json.count)
									});
								}
							}
						});
					}
				});
			}
		},
		//отрисовка карточек
		showCardsList: function(response, list, cont) {
			if (typeof(list.html2) != 'undefined') {
				var tpl = list.html2;
				if (cont.attr('template') == '4') tpl = list.html4;
				if (cont.attr('template') == '6') tpl = list.html6;
				if (cont.attr('template') == '8') tpl = list.html8;
				if (cont.attr('template') == '9') tpl = list.html9;
				if (cont.attr('template') == '10') tpl = list.html10;
			
				for (i = 0; i < response.result.length; i++) {
					var item_id = response.result[i].id;
					renderer.draw.el({
						view: 'listing',
						container: cont,
						mode: 'append',
						tpl: tpl,
						data: response.result[i],
						list: list,
						list_id: list.id,
						callback: function($html, data_id) {
							//активация кнопок управления (редактировать/удалить/...)
							renderer.process.cardActions($html, function() {
								var $html = $(this);
								$html.find(renderer.cfg.selectors.card_opennext).attr("href", "/card?" + list.id + "-" + data_id);
								$html.find(renderer.cfg.selectors.card_openblank).attr("href", "/card?" + list.id + "-" + data_id);
							})
							
							if (response.count != false && cont.attr('pagination') ) {
								var length = cont.attr('count');
								//var list = cont.attr('list');
								if(response.nopagination && response.nopagination == true){
									
								}else{
									renderer.process.pagination(response.count, length, list.id, response.offset);
								}
							}
							//remove fields in role
							setTimeout(() => {for (a in response.not) {
								$('th[label="'+ response.not[a] +'"], td[label="'+ response.not[a] +'"]').empty()
							}}, 100)
							$("tr.request td[label]").unbind().click(function(){$(this).parent().toggleClass("whitesmoke")})
							$('table.requesttable td[label] details').on('click', function(event){
								event.stopPropagation();
							})
						}
					});
				}
			}
		},
		stuff: function() {
			renderer.draw.onReady(renderer.cfg.selectors.id_user, function() {
				if (JSCat && JSCat.user !== undefined) {
					$(this).html(JSCat.user);
				}
			});
		},
		//запрос объявлений через listing
		calls: function() {
			$('[paginator]').empty();
			renderer.draw.onReady(renderer.cfg.selectors.calls, function() {
				$(renderer.cfg.selectors.calls).map(function() {
					var $calls_root = $(this).empty();
					if ($calls_root.data('processed')) {
						return;
					}
					$calls_root.data('processed', true);
					if(!localStorage.price) localStorage.setItem('price','new');
					if(!localStorage.usertype) localStorage.setItem('usertype','all');
					if (typeof($calls_root.attr('user')) != 'undefined') {
						var offset = '0';
						var pagination 		= $calls_root.attr('pagination'); //пагинация
						var region 				= $calls_root.attr('region') || '0';
						var my_list_id 		= $calls_root.attr('list') || '0';
						var user_id 			= $calls_root.attr('user') || '';
						var order_by 			= $calls_root.attr('order_by') || '';
						var status 				= $calls_root.attr('status') || 'all';
						var item_id 			= $calls_root.attr('item') || false;
						var count 				= $calls_root.attr('count'); //количество карточек на странице
						var search = '';
						if ( localStorage.search ) search += localStorage.search;
						renderer.get.query({
							func: 'CEditCat',
							action: 'listing',
							post: {
								method: 'get',
								offset: offset,
								region: region,
								pagination: pagination,
								list_id: my_list_id,
								text: '',
								search: search,
								order_by: order_by,
								page: window.location.search.substr(1).split('&')[0],
								status: status,
								raions: localStorage.raions,
								price: localStorage.price,
								usertype: localStorage.usertype,
								user_id: user_id,
								item_id: item_id,
								count: count
							},
							callback: function() {
								// console.log("РАБОТАЕТ");
								var json = this;
								if (json.status == 'good') {
									renderer.get.listIfUndefined({
										list_id: my_list_id
									}, function(list) {
										renderer.process.showCardsList(json, list, $calls_root);
										localStorage.setItem('countall', json.count)
									});
								}
							}
						});
					}
				});
			});
		},
		//обработка карточки перед прорисовкой
		post: function($html) {
			var options = $html.data('options');
			//подсвечиваем премиум
			if (options.data.premium == '1') $($html).attr('color','');
			if (options.data.premium == '2') $($html).attr('left','');
			
			$html.find('.chekbox-hidden').parent().remove();
			$html.find('img').on('error', function() {
				$(this).attr('src', '/cdn/lib/nophoto.jpg').attr('alt', '');
			});
			//прячем элементы "не владельца"
			if (typeof(options.data.id_user) != 'undefined' && options.data.id_user != JSCat.user) {
				if (JSCat.userType == '5') $html.find(renderer.cfg.selectors.owner).remove();
			}
			if (JSCat.userType == '5') $html.find(renderer.cfg.selectors.add_item_forward).remove();
			return $html;
		}
	},
	draw: {
		onReady: function(selector, func, options) {
			var $container = $(selector);

			if ($container.length) {
				$container.map(func);
			} else {
				if (options !== undefined) {
					jQuery(document).ready(function($) {
						$(document).observe(selector, options, func);
					});
				} else {
					if (selector == '.save') jQuery(document).ready(func);
					else {
						jQuery(document).ready(function($) {

							$(document).observe(selector, func);

						});
					}
				}
			}
		},
		onHtmlReady: function($el, callback) {
			var i_protect = 0;
			var interval = setInterval(function() {
				if (i_protect++ > 50 || $el.html() != '') {
					clearInterval(interval);
					callback.call($el.get(0));
				}
			}, 100);
		},
		formAdd: function(params) {
			var options = {
				$container: null,
				list: {},
				mode: 'inner_html'
			}
			$.extend(options, params);
			if(options.list_id == 22 && JSCat.user != 17 && JSCat.Group.indexOf('supervisor') != -1){
				options.list.html9 = '<div class="frm"><h3><span>Товар {{{ids}}}</span></h3><span class="label">Название<i required>*</i></span>{{{name.input[type:text,class:w500,placeholder:Название,disabled:disabled]}}}<br/><span class="label">Категория</span>{{{category.select[class:w500,placeholder:0,disabled:disabled]}}}<br/><br/><span class="label">Алиас</span>{{{alias.input[type:text,class:w500,placeholder:Алиас,disabled:disabled]}}}<br/><span class="label">Описание</span>{{{description.textarea[disabled:disabled]}}}<br/><div class="frmmar check_role"></div><h3 id="check_role">Дополнительно</h3><span class="label">Вес в граммах</span>{{{weight.input[type:text,class:w100,placeholder:0]}}}<br/><span class="label">Размер</span>{{{size.input[type:text,class:w100,placeholder:0]}}}<br/><div class="frmmar"></div><h3>Скрипты продаж</h3><h4>Приветствие</h4>{{{script_greeting.textarea}}}<h4>Клиент  подтверждает заказ</h4>{{{script_confirms_order.textarea}}}<h4>Окончание разговора</h4>{{{script_end_call.textarea}}}<div class="frmmar"></div><button class="save" action="addf">Продолжить</button><span class="closeform">Отмена</span></div>';
			}else if(options.list_id == 22 && JSCat.user != 17 && JSCat.Group.indexOf('techspec') != -1){
				options.list.html9 = '<div class="frm"><h3><span>Товар {{{ids}}}</span></h3><span class="label">Название<i required>*</i></span>{{{name.input[type:text,class:w500,placeholder:Название]}}}<br/><span class="label">Категория</span>{{{category.select[class:w500,placeholder:0]}}}<br/><br/> <div class="alert alert-info" style="margin-bottom: 10px;">Поле алиас необходимо для корректной работы лендингов. Алиас может состоять только из букв латинского алфавита, цифр и символов «-», «_».</div> <span class="label">Алиас</span>{{{alias.input[type:text,class:w500,placeholder:Алиас]}}}<br/><span class="label">Описание</span>{{{description.textarea}}}<br/><div class="frmmar check_role"></div><h3 id="check_role">Дополнительно</h3><span class="label">Единица измерения</span>{{{unity.input[type:text,class:w100,placeholder:шт]}}}<br/><span class="label">Длина (см)</span>{{{length.input[type:text,class:w100,placeholder:0]}}}<br/><span class="label">Ширина (см)</span>{{{width.input[type:text,class:w100,placeholder:0]}}}<br/><span class="label">Высота (см)</span>{{{height.input[type:text,class:w100,placeholder:0]}}}<br/><span class="label">Закупочная цена</span>{{{price.input[type:text,class:w100,placeholder:0]}}}<br/><span class="label">На складе</span>{{{countAll.input[type:text,class:w100,placeholder:0]}}}<br/><br/> <span class="label">Цена лида</span>{{{f1580430728n.input[type:text,class:w100,placeholder:0]}}}<br/><br/><span class="label"></span>{{{parse.checkbox[label: Вести учет остатков этого товара?]}}}<br/><div class="frmmar"></div><h3>Цены</h3>  {{{priceAll.some}}}<div class="frmmar"></div><h3>Скрипты продаж</h3><h4>Приветствие</h4>{{{script_greeting.textarea}}}<h4>Клиент  подтверждает заказ</h4>{{{script_confirms_order.textarea}}}<h4>Окончание разговора</h4>{{{script_end_call.textarea}}}<div class="frmmar"></div><button class="save" action="addf">Продолжить</button><span class="closeform">Отмена</span></div>';
			}
			renderer.lib('add', {
				id: options.list_id,
				html9: options.list.html9,
				onLibLoad: function() {
					
					renderer.get.listIfUndefined(options, function(list) {

						var $container_src = options.$container;
						if (options.use_parent_container) $container_src = $container_src.parent();
						renderer.draw.el({
							view: 'add',
							container: $container_src,
							tpl: options.list.html9,
							data: options.data,
							mode: options.mode,
							list: options.list,
							list_id: options.list_id,
							callback: function($html) {
								$html.find(renderer.cfg.selectors.close_item_click).click(function() {
									if ($('button#btn-mute').css('display') != 'block') {
										//window.location.href = '/partner';
										if (window.location.pathname == '/edit') window.location.href = '/partner';
										$html.remove();
									} else {
										alert('Сначала завершите разговор')
									}
									return false;
								});
								$container_src.show();
								$('html, body').animate({
									scrollTop: parseInt($container_src.offset().top) - 35
								}, 'slow');
								$html.find(renderer.cfg.selectors.form_action_save).data('options', options);
							}
						});
					});
				}
			});
		},
		formSearch: function(params) {
			var options = {
				$container: null,
				list: {},
				mode: 'inner_html'
			}
			$.extend(options, params);
			renderer.get.listIfUndefined(options, function(list) {
				var $container_src = options.$container;
				if (options.use_parent_container) $container_src = $container_src.parent();
				renderer.draw.el({
					view: 'search',
					container: $container_src,
					tpl: options.list.html3,
					data: options.data,
					mode: options.mode,
					list: options.list,
					list_id: options.list_id,
					callback: function($html) {
						$container_src.show();
						$html.find(renderer.cfg.selectors.form_action_search).data('options', options);
					}
				});
			});

		},
		formTable: function(params) {
			var options = {
				$container: null,
				list: {},
				mode: 'inner_html'
			}
			$.extend(options, params);
			renderer.get.listIfUndefined(options, function(list) {
				var $container_src = options.$container;
				if (options.use_parent_container) $container_src = $container_src.parent();
				renderer.draw.el({
					view: 'table',
					container: $container_src,
					tpl: options.list.html4,
					data: options.data,
					mode: options.mode,
					list: options.list,
					list_id: options.list_id,
					callback: function($html) {
						$container_src.show();
						//$html.find(renderer.cfg.selectors.form_action_table).data('options', options);
					}
				});
			});

		},
		card: function() {
			var $this = $(this);
			var html_data = $this.data();
			//mode: 'append' нужен для работы похожих объявлений
			if (typeof(html_data.options.list.position) == 'undefined') html_data.options.list.position = GLOBAL.cache.lists[options.position];
			var $container = $('div#detail');
			renderer.draw.el({
				view: 'card',
				mode: 'append',
				container: $container,
				tpl: html_data.options.list.html7,
				data: html_data.options.data,
				list: html_data.options.list,
				list_id: html_data.options.list_id,
				callback: function($html) {
					renderer.process.cardActions($html, function() {
						var $html = $(this);
					});
					

					$(renderer.cfg.selectors.card_closep).click(function() {
						$('body').removeClass('noscroll');
						$html.remove();
						return false;
					});
					$('#next').click(function() {
						var $next = $this.next();
						if ($next.length) {
							$next.click();
						} else {
							$this.parent().children().get(0).click();
						}
						return false;
					});
					$('#prew').click(function() {
						var $prev = $this.prev();
						if ($prev.length) {
							$prev.click();
						} else {
							$this.parent().children().filter(':last').click();
						}
						return false;
					});
				}
			});
		},
		el: function(params) {
			var options = {
				view: 'card',
				container: null,
				tpl: '',
				data: {},
				mode: 'append',
				list: {},
				callback: function($html, data_id) {},
				hideBeforeDraw: true,
				hideUseVisibility: true
			}
			$.extend(options, params);
			if (!options.tpl) options.tpl = '<div>----- ПУСТОЙ ШАБЛОН (list_id=' + options.list_id + '; data_id=' + options.data.ids + '; view=' + options.view + ';) -----</div>';
			if (options.hideBeforeDraw === true) {
				if (options.hideUseVisibility === true) {
					options.container.invisible();				   
				} else {
					options.container.hide();
				}
			}
			renderer.prerend.get({
				view: options.view,
				tpl: options.tpl,
				data: options.data,
				list: options.list,
				list_opts: options,
				callback: function($html) {
					$html.data('options', options);
					//убираем элементы не владельца, ставим заглушки для фото
					var $html = renderer.process.post($html.eq(0));//faster
					switch (options.mode) {
						case 'append':
							options.container.append($html);
							break;
						case 'prepend':
							options.container.prepend($html);
							break;
						case 'inner_html':
							options.container.html($html);
							break;
					}
					if (options.hideBeforeDraw === true) {
						if (options.hideUseVisibility === true) {
							options.container.visible();
						} else {
							options.container.fadeIn();
						}
					}
					options.callback($html, options.data.ids);
				}
			});
		},
		attrs: function(attrs) {
			var res = '';
			for (var attr_name in attrs) res += ' ' + attr_name + '="' + attrs[attr_name] + '"';
			return res;
		}
	},
	destruct: {
		card: function(html_data) {
			$(renderer.cfg.selectors.pos_prefix + html_data.options.list.position).empty();
		}
	},	
	suggest: function(el, type) {
	
		var $parent = $(el).parent();
		
		switch(type) {
			case 'address':
				$(el).on('keypress', function() {
					$('.frm .suggestions').remove();
					if ($(el).val().length > 3) {
						var json = {func:'Dadata', action:'suggest', token:JSCat.token};
						json["query"] = $(el).val();
						json["type"] = type;
						$.post("/json/", json, function(suggestion) {
							if ( typeof suggestion !== 'object' ) suggestion = JSON.parse(suggestion);
							
							function suggest(sugg) {
								$('#address').val(sugg.value); //заполняем адрес
// 								var json = {func:'Dadata', action:'clean2', token:JSCat.token};
// 								json["query"] = value;
// 								json["type"] = type;
// 								$.post("/json/", json, function(address) {
// 									if ( typeof address !== 'object' ) address = JSON.parse(address);
									showGeo(sugg.data);
// 									
									//timezone								
									if (sugg.data.timezone) $('input.timezone[data-view="add"]').val(parseInt(sugg.data.timezone.substr(4)) * -60)
									
									function join(arr /*, separator */) {
										var separator = arguments.length > 1 ? arguments[1] : ", ";
										return arr.filter(function(n){return n}).join(separator);
									}
									
									//проверка данных
									function topLabel(olds, news, text) {

										$('.label .'+ news).remove();
										if (text.length > 0) {
											$('.frm .'+ olds).prev().append('<span class="'+ news +'"><a>'+ text +' </a><u>&hearts;</u><s>&times;</s></span>');
											$('.frm .'+ news).find('u, a').click(function() {
												var hearts = $(this);
												if (olds == 'city' && text.length == 0) {
													$('.frm .'+ olds).val($(".frm .region").val())
												} else {
													$('.frm .'+ olds).val(text)
												}
												$('.label .'+ news).remove()
											});
										}
										$('.frm .'+ news).find('s').click(function() {
											var hearts = $(this);
											$('.label .'+ news).remove()
										})
									}
									
									function showGeo(address) {
										var flat = $(".frm .flat").val();
										var city = $(".frm .city").val();
										var house = $(".frm .house").val();
										var region = $(".frm .region").val();
										var addres1 = $(".frm .address").val();
										var postIndex = $(".frm .postIndex").val();
										
										var flatNew = join([address.flat_type, address.flat], " ");
										var cityNew = join([
											join([address.city_type, address.city], " "), 
											join([address.settlement_type, address.settlement], " ")
										]);
										var houseNew = join([
											join([address.house_type, address.house], " "),
											join([address.block_type, address.block], " ")
										]);
										var regionNew = join([
											join([address.region_type, address.region], " "),
											join([address.area_type, address.area], " ")
										]);
										var addressNew = join([address.street_type, address.street], " ");
										var postIndexNew = (address.postal_code) ? address.postal_code : '';
										
										if (postIndexNew != '' && postIndex.trim() != postIndexNew.trim()) topLabel('postIndex', 'postIndexNew', postIndexNew); else $('.label .postIndexNew').remove();
										if (addressNew != '' && addres1.trim() != addressNew.trim()) topLabel('address', 'addressNew', addressNew); else $('.label .addressNew').remove();
										if (regionNew != '' && region.trim() != regionNew.trim()) topLabel('region', 'regionNew', regionNew); else $('.label .regionNew').remove(); //регион должен быть выше, чем город
										if (houseNew != '' && house.trim() != houseNew.trim()) topLabel('house', 'houseNew', houseNew); else $('.label .houseNew').remove();
										if (cityNew != '' && city.trim() != cityNew.trim()) topLabel('city', 'cityNew', cityNew); else $('.label .cityNew').remove();
										if (flatNew != '' && flat.trim() != flatNew.trim()) topLabel('flat', 'flatNew', flatNew); else $('.label .flatNew').remove();
										
										
// 										$(".frm .region").val(regionNew).attr('data-form', $(".frm .region").val());
// 										$(".frm .city").val(cityNew).attr('data-form', $(".frm .city").val());
// 										
// 										if (cityNew.length == 0) {
// 											$(".frm .city").val($(".frm .region").val()).attr('data-form', $(".frm .region").val());
// 										}
// 										
// 										$(".frm .house").val(houseNew).attr('data-form', $(".frm .house").val());
// 										
// 										$(".frm .address").val(addressNew).attr('data-form', $(".frm .address").val());
// 										$(".frm .flat").val(flatNew).attr('data-form', $(".frm .flat").val());
// 										$(".frm .postIndex").val(postIndexNew).attr('data-form', $(".frm .postIndex").val());
// 																		
									}
									$('.suggestions').empty(); 			
// 								});
							}
							
							$parent.find('.suggestions').remove();
							$parent.find('label').after('<div class="suggestions"><i>Выберите вариант или продолжите ввод</i></div>');
							for (a in suggestion.suggestions) {
								var value = suggestion.suggestions[a].value;
								
								$parent.find('.suggestions').append('<div data-item="'+ a +'">'+ value +'</div>');
								$parent.find('.suggestions [data-item="'+ a +'"]').click(suggest.bind(this, suggestion.suggestions[a]));
								
							}
				
							
// 							$('.suggestions [data-item]').each(function() {
// 								var $item = $(this);
// 								var a = $item.attr('data-item');
// 							
								var u = -1;
								$(el).unbind('keydown').on('keydown', function(e) {
									switch (e.which) {
										case 13://enter
											//suggest($(el).val())
										break;
										case 32://space
											if ($parent.find('[data-item][focus]').length > 0) $(el).val($parent.find('[data-item][focus]').text());
											$parent.find('.suggestions [data-item]').removeAttr('focus');
										break;
										case 38://up
											u = ((parseInt(u) - 1) < 0) ? 0 : u - 1;
											$parent.find('.suggestions [data-item]').removeAttr('focus');
											$parent.find('[data-item="'+ u +'"]').attr('focus','');
										break;
										case 40://down
											u = ((parseInt(u) + 1) > 3) ? 3 : u + 1;
											$parent.find('.suggestions [data-item]').removeAttr('focus');
											$parent.find('[data-item="'+ u +'"]').attr('focus','');
										break;
										default:
										return
									}
										
								});
								
							//});
						})
					}
				});
			break;
			case 'names'://ФИО -не работает временно
				$('.frm .suggestions').remove();
				$(el).on('keypress', function() {
					if ($(el).val().length > 3) {
						var json = {func:'Dadata', action:'suggest', token:JSCat.token};
						json["query"] = $(el).val();
						json["type"] = 'fio';
						$.post("/json/", json, function(suggestion) {
							if ( typeof suggestion !== 'object' ) suggestion = JSON.parse(suggestion);
							function suggest($parent, a) {

								
								$parent.find(el).val(a.value);
	
								$parent.attr('data-form', a.value);
								$parent.find('.suggestions').empty();
							}
								
							$parent.find('.suggestions').remove();
							$parent.append('<div class="suggestions"><i>Выберите вариант или продолжите ввод</i></div>');
							for (a in suggestion.suggestions) {
								$parent.find('.suggestions').append('<div data-item="'+ a +'">'+ suggestion.suggestions[a].value +'</div>');
								$parent.find('.suggestions [data-item="'+ a +'"]').click(suggest.bind(this, $parent, suggestion.suggestions[a]));
							}

						})
					}
				});
			break;
			case 'email':
				$('.frm .suggestions').remove();
				$(el).on('keypress', function() {
					if ($(el).val().includes("@")) {
						var json = {func:'Dadata', action:'suggest', token:JSCat.token};
						json["query"] = $(el).val();
						json["type"] = type;
						$.post("/json/", json, function(suggestion) {
							if ( typeof suggestion !== 'object' ) suggestion = JSON.parse(suggestion);
							
							function suggest($parent, a) {
								
								$parent.find(el).val(a.value);
								$parent.attr('data-form', a.value);
								$parent.find('.suggestions').empty();
							}
								
							$parent.find('.suggestions').remove();						
							$parent.append('<div class="suggestions"><i>Выберите вариант или продолжите ввод</i></div>');
	
							for (a in suggestion.suggestions) {
								$parent.find('.suggestions').append('<div data-item="'+ a +'">'+ suggestion.suggestions[a].value +'</div>');
								$parent.find('.suggestions [data-item="'+ a +'"]').click(suggest.bind(this, $parent, suggestion.suggestions[a]));
							}
						})
					}
				});
			break;
		}
	},
	yandex_add: function(obj) {
		var $el = $( obj.field );
		firstready = false;
		$el.empty().append('<div class="yandexmap"><input autofocus type="text" id="searchart'+ obj.key +'" placeholder="Например: Москва, ул. Пушкина, д. 4"><label></label><br><div class="yamap"><i id="index' + obj.key + '"></i><span id="cardyandex' + obj.key + '"></span><p id="full' + obj.key + '"><b class="mapcenter">Сначала <a id="mapfocus">укажите адрес</a></b></p></div></div>');		
		

					

// 		{"ycoradr":{
// 			"coords":"55.76007887633082,37.643448481436565",
// 			"address":"Россия, Москва, Чистопрудный бульвар, 14с1",
// 			"raion":"Басманный район"
// 		}, "kinds":{
// 			"country":"Россия",
// 			"province":"Москва",
// 			"locality":"Москва",
// 			"street":"Потаповский переулок",
// 			"house":"9"
// 		}, "metro":{
// 			"branch":"1",
// 			"metroName":"Чистые пруды",
// 			"distance":"600 м",
// 			"station":"149"
// 		}}
		

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
	
		var scripts = {};
		scripts[ util.cfg.url.yandex_map ] = {
			state:		'loading',
			callbacks:	new Array({
				func:	function() {
					ymaps.ready(function(){
						renderer.functionYandex();
						if (es = document.getElementById('searchart' + obj.key)) {
							es.onkeypress = function(event) {
								if (event.keyCode == 13) {
									renderer.functionYandex(obj);
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
									renderer.functionYandex(obj);
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
		script.onload = script.onerror = script.onreadystatechange = function() {
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
		}

		// sync way of adding script tags to the page
		document.body.appendChild( script );

	},	
	functionYandex: function(obj) {
		

		var fieldkey = (obj) ? obj.key : 'yandexfield';
		myGeocoder = ymaps.geocode( $('#searchart' + fieldkey).val() );
		myGeocoder.then(function(res) {
			if (firstready == true) {
				coords = res.geoObjects.get(0).geometry.getCoordinates();
				$('#' + fieldkey).attr('data-form', '{"ycoradr":{"coords":"' + coords + '","address":"' + $('#searchart' + fieldkey).val() + '"}}');
			} else coords = data_form.ycoradr.coords.split(',');

			myMap = new ymaps.Map('cardyandex' + fieldkey, {
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
						
						//определяем район города
						var raion = '';
						ymaps.geocode(ads, { kind: 'district' }).then(function(res2) {
							raion += res2.geoObjects.get(0).properties.get('name');
						});
									
						$('#index' + fieldkey).html('<div class="yandextext">Маркер указывает на: ' + newCenter + '<a id="yandexcool' + fieldkey + '">Это верный адрес</a></div>');
						//определяем район города и метро
						function rescool(ads, obj) {
								util.load_script(util.cfg.url.yandex_map, function() {
									ymaps.ready(function() {
										//определяем ближайшие метро
 										ymaps.geocode(ads, { kind: 'metro' }).then(function(res) {
											//i < 2; - количество станций метро
											for (var i = 0; i < 1; i++) {
												metroObj = res.geoObjects.get(i);
												coordsMetro = metroObj.geometry.getCoordinates();
												distance = Math.floor(ymaps.coordSystem.geo.getDistance(ads, coordsMetro));
												
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
																						
												$('#' + fieldkey).attr('data-form', '{"ycoradr":{"coords":"' + ads + '","address":"' + newCenter + '","raion":"' + raion + '"},"kinds":' + kinder + ',' + metroadd + '}');
 										}).catch(function(metroadd) {
												$('#' + fieldkey).attr('data-form', '{"ycoradr":{"coords":"' + ads + '","address":"' + newCenter + '","raion":"' + raion + '"},"kinds":' + kinder + '}');
										});
									});
								});
								//сохраняем значения
								$('#searchart' + fieldkey).val(newCenter);
								
// 								if (obj.list == '6' || obj.list == '15' || obj.list == '8') {
// 									
// 									//инициализируем для отправки
// 									if (obj.list == '8') var neuron = 'Buildingid';
// 									if (obj.list == '6' || obj.list == '15') var neuron = 'BusinessShoppingCenter';
// 									
// 									function building_id(id, kinder) {
// 									
// 										//записываем для отправки
// 										if (obj.list == '6' || obj.list == '15')
// 											$('.BusinessShoppingCenter[data-view="add"]').attr('data-form', id); 
// 										
// 										var json = {func:'CEditCat', domain:JSCat.domain, token:JSCat.token};
// 										json["action"] 		= neuron;
// 										json["param"] 		= 'set';
// 										json["id"] 			= id; 
// 										json["kinder"] 		= JSON.parse(kinder); 
// 										$.post("/json/", json, function(result) {
// 											$( '.bcjk' ).remove();
// 											//insert data
// 											if (typeof result !== 'object') result = JSON.parse(result);
// 										});
// 									}
// 									
// 									//запрашиваем данные для подстановки
// 									var json = {func:'CEditCat', domain:JSCat.domain, token:JSCat.token};
// 									json["action"] 		= neuron;
// 									json["kinder"] 		= JSON.parse(kinder); 
// 									json["param"] 		= 'get'; 
// 									$.post("/json/", json, function(result) {
// 										$('.bcjk').remove();
// 										if (typeof result !== 'object') result = JSON.parse(result);
// 										if (result != null) {
// 											$( '.yamap' ).after('<div class="bcjk"><i>Укажите нужный комплекс для автоматического заполнения параметров</i></div>');
// 											for (id in result) {
// 												$( '.bcjk').append('<div building="' + id + '"><b>' + result[id].type + ' ' + result[id].name + '</b>'+ result[id].adress +'</div>');
// 												$( '.bcjk [building="' + id + '"]').click(building_id.bind(this, id, kinder));
// 											}
// 										}
// 									});
// 								}
// 								
// 									
									
						}
						$('#yandexcool' + fieldkey).click(rescool.bind(this, ads, obj));
					});
				}
				getAddress(event.get('newCenter'));
			});
		}, function(err) {
			alert('Ошибка на стороне Яндекс Карт');
		});
	},
	photoAlbum: {
		build: '1.0.1',
		options: {},
		actions: {
			loadPhoto: function(field, files, div_content, IDbase, rotate) {
					
				link = '/json/';
				var form = new FormData(),
					xmlhttp = getXmlHttp();
				if (parseInt(rotate) == rotate && parseInt(rotate) > 0) form.append('rotate', rotate);
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
							var result = JSON.parse(xmlhttp.response);
							if ( result == false ) {
								alert('Превышен размер изображения, или неверный формат!');
								return false;
							}
							
							//если поворот
							if (parseInt(rotate) == rotate && parseInt(rotate) > 0) {
								var newname = Object.keys(result)[0];
								$('[data-remove="'+ rotate +'"]').attr('data-remove', newname);
								$('[data-rotate="'+ rotate +'"]').attr('data-rotate', newname);
								$('div[data-id="'+ rotate +'"]').attr('data-id', newname);
								$('div[data-id="'+ newname +'"] img').attr('src','/cdn/'+ JSCat.domain +'/card/'+ IDbase +'/'+ newname +'.jpg');
								
								var fielddata = $('.galleryfield[data-view="add"]').attr('data-form');										
								var dataform = JSON.parse(fielddata);
								delete dataform[rotate];
								
								$('.galleryfield[data-view="add"]').attr('data-form', JSON.stringify(dataform));
								$('[data-rotate="'+ newname +'"]').unbind().click(function() {
									function getDataUri(url, callback) {
										var image = new Image();
										image.onload = function () {
											var canvas = document.createElement('canvas');
											canvas.width = this.naturalWidth;
											canvas.height = this.naturalHeight;
											canvas.getContext('2d').drawImage(this, 0, 0);
											callback(canvas.toDataURL('image/png'));
										}
										image.src = url;
									}
									getDataUri('https://'+ JSCat.domain +'/cdn/'+ JSCat.domain +'/card/'+ IDbase +'/'+ newname +'.jpg', function(files) {
										renderer.photoAlbum.actions.loadPhoto(field, files, $('#galler'), IDbase, newname);
									});
								});
							}
							
							renderer.cfg.selectors.cFloadAlbums--;
							
							var fielddata = $('.' + field).attr('data-form');
							var newdataform = {};					
					
							if (fielddata != '') {
								var dataform = JSON.parse(fielddata);
								for (var key in dataform) {
									newdataform[key] = dataform[key];
								}
							}
	
							for (var key in result) {
								newdataform[key] = result[key];
							}
	
							if (renderer.cfg.selectors.cFloadAlbums == 0) {
								renderer.photoAlbum.actions.modPhoto(field, JSON.stringify(newdataform), div_content, IDbase);
							} else {
								$('.' + field).attr('data-form', JSON.stringify(newdataform));
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
							renderer.photoAlbum.actions.addPhoto(field, imageId, response[imageId], IDbase, ELcontent);
						}
					}
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
					
				}
			},	
			//добавление изображений
			addPhoto: function(field, imageId, response1, IDbase, ELcontent) {
				var gallery = ELcontent;
				if(!gallery) gallery = $('.gallery');
				
				var src = JSCat.cdn + '/card/' + IDbase + '/' + response1.img;
	
				var $item = $('<div data-id="'+ imageId +'" class="listimg">');
				$item.append('<img src="'+ src +'"/>');
				$item.append('<div data-remove="'+ imageId +'">&times;</div>');
				$item.append('<b data-rotate="'+ imageId +'"></b>');
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
				$item.find('[data-rotate="'+ imageId +'"]').click(function() {

					function getDataUri(url, callback) {
						var image = new Image();
						image.onload = function () {
							var canvas = document.createElement('canvas');
							canvas.width = this.naturalWidth;
							canvas.height = this.naturalHeight;
							canvas.getContext('2d').drawImage(this, 0, 0);
							callback(canvas.toDataURL('image/png'));
						}
						image.src = url;
					}
					
					getDataUri('https://'+ JSCat.domain +'/cdn/'+ JSCat.domain +'/card/'+ IDbase +'/'+ imageId +'.jpg', function(dataUri) {
						renderer.photoAlbum.actions.loadPhoto(field, dataUri, $('#galler'), IDbase, imageId);
					});
				});
			},
			//resizeImage
			resizeImageToSpecificWidth: function(maxWidth, input, field, file, div_content, IDbase, onSuccess, onFailure) {
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
										octx.fillStyle = '#ffffff';
										octx.fillRect(0, 0, w, h);
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
			},
			//modPhoto
			modPhoto: function(field, data, div_content, IDbase) {
				$(div_content).empty();

				
				//noinspection JSAnnotator
				var div = $('\
					<div id="galler" class="gallery gallery' + field + '">\
						<b>Загрузка изображений</b>\
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
					renderer.cfg.selectors.cFloadAlbums = evt.target.files.length;

					if ($('img#imggalleryfield').attr('src') == '/cdn/lib/camera.svg') 
						$('img#imggalleryfield').attr('src', '/cdn/lib/loading.gif');
					
					for (var i = 0; i < evt.target.files.length; i++) {
						var onSuccess = (function() {
							return function(file) {
								// Если удалось отресайзить - отправить data-uri
								renderer.photoAlbum.actions.loadPhoto(field, file, div_content, IDbase);
							}
						})();
			
						var onFailure = (function(originalFile) {
							return function(error) {
								// Если произошла ошибка - загрузить оригинал

								renderer.photoAlbum.actions.loadPhoto(field, originalFile, div_content, IDbase);
							}
						})(evt.target.files[i]);

						renderer.photoAlbum.actions.resizeImageToSpecificWidth(960, input, field, evt.target.files[i], div_content, IDbase, onSuccess, onFailure);
					}
				};
	
				div.children('.listimg0').children('img')[0].onclick = function() {
					input.click();
				};
	
				div_content.appendChild(div[0]);
				renderer.photoAlbum.actions.editPhoto(field, data, div[0], IDbase);
			}
		}
	},
	socketio: function(e) {
			$.extend({}, {}, e);
			renderer.flags.socketio_load_called || (renderer.flags.socketio_load_called = !0, util.load_lib("socket.io", function() {
				util.load_lib("lib.socketio", function() {
					socketio = new socketio_cl
				})
			}))
		},
	//рендеринг элементов форм
	prerend: {
		get: function(params) {
			var options = {
				view: 'card',
				tpl: '',
				data: {},
				list: {},
				callback: function($html) {},
				list_opts: {}
			};
			$.extend(options, params);
			var regexp_str = '{{{(\\w+)(\\.|)(' + renderer.cfg.known_prerender_types.join('|') + '|){1}(.*?)}}}';
			var $dom_root = $(options.tpl).eq(0);
			var result = {};
			var process_dom_item = function(dom, result, i_dom_item, callback) {
				switch (dom.nodeType) {
					case 1:
						var $dom = $(dom);
						result.self = renderer.get.el_without_children($dom).get(0);
						result.childs = new Array();
						var $contents = $dom.contents();
						var process_contents = function(i_content) {
							if (i_content < $contents.length) {
								result.childs[i_content] = {};
								process_dom_item($contents[i_content], result.childs[i_content], i_dom_item + 1, function(result_struct) {
									process_contents(i_content + 1);
								});
							} else {
								callback(result);
							}
						}
						process_contents(0);
						break;
					case 3:
						var el_text = dom.nodeValue;
						var reg = new RegExp(regexp_str, 'gim');
						var founded = el_text.split(reg);
						var items_per_proc = 5;
						if (founded && founded.length > items_per_proc) {
							var proc_count = Math.floor(founded.length / items_per_proc);
							var end_text = founded[founded.length - 1];
							var confs = new Array();
							for (var k = 0; k < proc_count; k++) {
								var field_id_raw = founded[k * items_per_proc + 1];
								if (typeof(renderer.cfg.field_aliases[field_id_raw]) != 'undefined') {
									field_id_raw = renderer.cfg.field_aliases[field_id_raw];
								}
								confs.push({
									pre_text: founded[k * items_per_proc + 0],
									field_id: field_id_raw,
									processor: founded[k * items_per_proc + 3],
									attrs: renderer.parse.attrs(founded[k * items_per_proc + 4]),
								});
							}
							result.self = new Array();
							var process_config = function(i_config) {
								if (i_config < confs.length) {
									var conf = confs[i_config];
									result.self.push(document.createTextNode(conf.pre_text));
									var field_info = renderer.get.field_info(conf.field_id, options.list);
									var callback_render_result = function(render_result) {
										if (render_result) {
											var $render_result = $(render_result);
											$render_result.eq(0).addClass(conf.field_id).attr('data-view', options.view);
											result.self.push(render_result);
										}
										process_config(i_config + 1);
									}
									if (field_info && field_info.type !== null) {
										if (typeof(renderer.prerend.processors[conf.processor]) !== 'undefined') {
											// gallery
											renderer.prerend.processors[conf.processor]({
												view: options.view,
												data: options.data,
												callback: callback_render_result,
												field_id: conf.field_id,
												field_info: field_info,
												attrs: conf.attrs,
												list: options.list,
												prerend_opts: options
											});
										} else {
											if (typeof(renderer.get.field[field_info.type]) !== 'undefined') {
												// fotoalbum
												renderer.get.field[field_info.type]({
													view: options.view,
													data: options.data[conf.field_id],
													callback: callback_render_result,
													field: field_info.src,
													prerend_opts: options
												});
											} else {

											}
										}
									} else {
										var lib_params = {
											ID: "0",
											IDbase: typeof(options.list.id) != 'undefined' ? options.list.id : options.list_opts.list_id,
											Key: conf.field_id,
											KeyID: "",
											Value: "",
											i: "",
											ih: "",
											mydata: {},
											name: "",
											user: "",
											conf: conf,
											callback: callback_render_result,
											field_info: field_info,
											options: options
										};
										try {
											lib_params.ID = options.data.ids;
										} catch (ex) {}
										try {
											lib_params.user = options.data.id_user;
										} catch (ex) {}
										try {
											var timestamp_now = util.now();
											lib_params.mydata = renderer.get.mydata(options.data, timestamp_now);
											lib_params.i = timestamp_now;
										} catch (ex) {}
										var CheckIsListField = conf.field_id.match(new RegExp('^f([0-9]+)n$', 'ig'));
										if (CheckIsListField != null && CheckIsListField.length > 0) {
											util.log('[WARN] ошибка HTML-разметки для list_id=' + lib_params.IDbase + '; data_id=' + lib_params.ID + '; field_id=' + conf.field_id + '; - field_id "' + conf.field_id + '" не зарегистрировано для list_id "' + lib_params.IDbase + '"');
											callback(document.createTextNode('{' + conf.field_id + '}'));
										} else {
											renderer.lib(conf.field_id, lib_params);
										}
									}
								} else {
									result.self.push(document.createTextNode(end_text));
									callback(result);
								}
							}
							process_config(0);
						} else {
							result.self = dom;
							result.childs = new Array();
							callback(result);
						}
						break;
				}
			}
			process_dom_item($dom_root.get(0), result, 0, function(new_dom_struct) {
				var draw_dom_result = function(dom) {
					if (typeof(dom.nodeType) != 'undefined') {
						var dom_result = dom;
					} else {
						var dom_result = dom.self;
						if (typeof(dom_result.length) == 'undefined' && typeof(dom.childs) != 'undefined' && dom.childs.length > 0) {
							for (var i = 0; i < dom.childs.length; i++) {
								var child_parsed = draw_dom_result(dom.childs[i]);
								if (child_parsed) {
									if (typeof(child_parsed.length) != 'undefined' && typeof(child_parsed[0]) != 'undefined') {
										for (var k = 0; k < child_parsed.length; k++)
											if (child_parsed[k]) {
												if (child_parsed[k] instanceof jQuery) {
													for (var j = 0; j < child_parsed[k].length; j++) dom_result.appendChild(child_parsed[k].get(j));
												} else {
													dom_result.appendChild(child_parsed[k]);
												}
											}
									} else {
										dom_result.appendChild(child_parsed);
									}
								}
							}
						}
					}
					return dom_result;
				}
				var dom_result = draw_dom_result(new_dom_struct);
				options.callback($(dom_result));
			});
		},
		processors: {
			init_vars: {
				view: 'card',
				field_id: 0,
				field_info: null,
				attrs: null,
				tpl: null,
				data: {},
				list: null,
				callback: function() {}
			},
			selectmenu: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var result = '';
				var $root = $('<span></span>');
				var update_menu_selected = function() {
					var result = {};
					$root.find('select').map(function() {
						var $this = $(this);
						if ($this.val()) result[$this.val()] = $this.find('option:selected').html();
					});
					$root.attr('data-form', JSON.stringify(result));
				};
				var process_submenu = function(parent_id) {
					util.ajax({
						func: 'menuAdm',
						action: 'parentl',
						post: {
							parent: parent_id
						},
						json: false,
						callback: function(decoded) {
							if ( decoded != 'null' ) {
								var decoded = JSON.parse(decoded);
								if (typeof(decoded.error) == "undefined") {
									try {
										var $select = $('<select id="select-' + parent_id + '" class="select-' + options.field_id + '"></select>');
										$select.append($('<option value="">-</option>'));
										if (decoded !== false) {
											for (var opt_id in decoded) {
												var $option = $('<option></option>');
												$option.html(decoded[opt_id].title);
												$option.val(decoded[opt_id].id);
												if (typeof(options.field_info.src.param[parent_id]) != 'undefined') {
													if (decoded[opt_id].id == options.field_info.src.param[parent_id]) {
														$option.attr('selected', 'selected');
														$select.attr('disabled', 'disabled');
													}
												}
												$select.append($option);
											}
										}
	
										$root.append($('<span class="ms' + ($root.find('select').length + 1) + '"></span>'));
										$root.append($select);
										if (typeof(options.field_info.src.param[parent_id]) != 'undefined') {
											update_menu_selected();
											$select.nextAll().remove();
											var selected_parent_id = $select.val();
											process_submenu(selected_parent_id);
										}
										$select.change(function() {
											update_menu_selected();
											$select.nextAll().remove();
											var selected_parent_id = $(this).val();
											if (decoded[selected_parent_id].inner_menu != '0') {
												selected_parent_id = decoded[selected_parent_id].inner_menu;
											}
											process_submenu(selected_parent_id);
										});
									} catch (ex) {
										alert('потрачено');
									}
								}
								update_menu_selected();
							}
						}
					});
				}
				if (typeof(options.field_info.src.param) == 'object') process_submenu(Object.keys(options.field_info.src.param)[0]);
				else process_submenu(options.field_info.src.param);
				try {
					var selected = JSON.parse(options.data[options.field_id]);
					if (!util.isEmpty(selected)) {
						var selected_list = new Array();
						var key_parent = options.field_info.src.param;
						for (var key in selected) {
							selected_list.push({
								parent: key_parent,
								key: key,
								data: selected[key]
							});
							key_parent = key;
						}
						var find_func = function() {
							var $select = $(this);
							for (var j = 0; j < selected_list.length; j++) {
								var key_try = selected_list[j].key;
								var $try_option = $select.find('option[value=\'' + key_try + '\']');
								if ($try_option.length) {
									selected = selected_list[j];
									var selector = '#select-' + selected.key;
									$(document).stopobserve(selector);
									renderer.draw.onReady(selector, find_func);
									break;
								}
							}
							$select.val(selected.key).change();
						};
						var draw_selected_item = function(i_local) {
							var selected = selected_list[i_local];
							var selector = '#select-' + selected.parent;
							$(document).stopobserve(selector);
							renderer.draw.onReady(selector, find_func);
						}
						for (var i = 0; i < selected_list.length; i++) draw_selected_item(i);
					}
					options.callback($root);
				} catch (ex) {
					options.callback($root);
				}
			},
			link: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var $el = $('<a href="#">link</a>');
				var href = '';
				if (typeof(options.data[options.field_id]) != 'undefined' && options.data[options.field_id] != '') href = options.data[options.field_id];
				if (typeof(options.attrs.content) != 'undefined') {
					$el.html(options.attrs.content);
				} else {
					if (href) $el.html(href);
				}
				
				if (href) {
					if (href.replace('http://', '') != href) {$el.attr('href', href)} else 
					if (href.replace('https://', '') != href) {$el.attr('href',  href)} else 
					$el.attr('href', '//' + href)	
				}
				if (typeof(options.attrs.class) != 'undefined') $el.addClass(options.attrs.class);
				if (typeof(options.attrs.target) != 'undefined') $el.attr('target', options.attrs.target);
				options.callback($el);
			},
			some: function(params) {

				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var $el = $('<div some></div>');
				var data_form = '{}';
				var dam = '{}';
				

				try {
					var selected = options.data[options.field_id];
					if (selected) {
						data_form = selected;
					}

					$el.append('<div class="somestart">'+ options.field_info.src.param[0] +' <input type="text" placeholder="0" value=""> '+ options.field_info.src.param[1] +' <input type="text" placeholder="0" value=""> <s>+</s><div>');
					
					var some_info = JSON.parse(data_form);
					if (some_info) {
						for (var some_id in some_info) {
							if (some_info.hasOwnProperty(some_id)) {
								$el.append('<div hash="'+ some_id +'">'+ options.field_info.src.param[0] +' <input type="text" placeholder="0" value="'+ some_id +'"> '+ options.field_info.src.param[1] +' <input type="text" placeholder="0" value="'+ some_info[some_id] +'"> <i hash="i'+ some_id +'">&times;</i><div>');
								
								$el.find('i[hash="i'+ some_id +'"]').click(function() {
									$('div[hash="'+ some_id +'"]').remove();
									$el.attr('data-form', get_dataform());
								});
							}
						}
					}
					
					function get_dataform() {
						var dataform = {};
						$('div[some] div[hash]').each(function() {
							var $item = $(this);
							var $hash = $item.attr('hash');
							var $first = $item.find('input:first-of-type').val();
							var $last = $item.find('input:last-of-type').val();
							dataform[$first] = $last;
						});
						return JSON.stringify(dataform);
					}
					
					$el.find('.somestart s').unbind().click(function() {
						//var dataform = (JSON.parse($el.attr('data-form'))) ? JSON.parse($el.attr('data-form')) : {};
						var $item = $(this);
						var $parent = $item.parent();
						var $first = $('.somestart input:first-of-type').val();
						var $last = $('.somestart input:last-of-type').val();
						
						if ($('.somestart input:first-of-type').val().length < 1 || $('.somestart input:last-of-type').val().length < 1) {
							$('.somestart').addClass('trrr');
							setTimeout(() => {$('.somestart').removeClass('trrr')}, 1000);
							return false;
						} else {
									
							$el.append('<div hash="'+ $first +'">'+ options.field_info.src.param[0] +' <input type="text" placeholder="0" value="'+ $first +'"> '+ options.field_info.src.param[1] +' <input type="text" placeholder="0" value="'+ $last +'"> <i hash="i'+ $first +'">&times;</i><div>');	
							$el.attr('data-form', get_dataform());
							$parent.find('input').val('');
							
							$el.find('i[hash="i'+ $first +'"]').click(function() {
								$('div[hash="'+ $first +'"]').remove();
								$el.attr('data-form', get_dataform());
							});
						}
					});
					
					$el.find('input[type="text"]').change(function() {
						$el.attr('data-form', get_dataform());
					});
					
					data_form = get_dataform();
				} catch (ex) {
					console.error(ex);
				}
				$el.attr('data-form', data_form);				
				options.callback($el);
			},
			gallery: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var el = document.createElement('div');
				var data_form = '{}';
				try {
					var selected = options.data[options.field_id];
					if (selected) {
						data_form = selected;
					}

					var src = '/cdn/lib/nophoto.jpg';
					var src_ava = src;
					var srcs = [];
					var img_info = JSON.parse(data_form);
					if(img_info) {
						for(var img_id in img_info) {
							if(img_info.hasOwnProperty(img_id)) {
								var idbase = '0';

								if(options.field && typeof(options.field.idbase) !== 'undefined') {
									idbase = options.field.idbase;
								}

								if(typeof(options.prerend_opts.list_opts.list_id) !== 'undefined') {
									idbase = options.prerend_opts.list_opts.list_id;
								}

								src = JSCat.cdn + '/card/' + idbase + '/' + img_info[img_id].img;
								srcs.push(src);
								if(img_info[img_id].ava) {
									src_ava = src;
								}
							}
						}
					}
				} catch (ex) {
					console.error(ex);
				}
				$(el).attr('data-form', data_form);
				renderer.photoAlbum.actions.modPhoto(options.field_id, data_form, el, options.prerend_opts.list_opts.list_id, srcs);
				options.callback(el);
			},
			multiselect: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var label = params.field_info.id;
				var $select = $('<select multiple="multiple" ' + renderer.draw.attrs(options.attrs) + ' aria-label="' + label + '"></select>');
				$select.change(function() {
					$(this).attr('data-form', $(this).val());//list
				});
				var draw_options = function(data_list) {
					for (var value in data_list) {
						$select.append('<option value="'+ value +'">'+ data_list[value] +'</option>');
					}
					try {
						var vals = options.data[options.field_id];

						if (typeof(vals) === 'object') {
							$select.val(Object.keys(vals)[0]).change()
						} else {
							if (typeof(vals) === 'string' && vals.length > 0) var selected =  vals.split(',');
							if (typeof(vals) === 'string' && vals.length == 0) var selected =  0;
							var custom_default_select_founded = '';
							switch (options.prerend_opts.view) {
								case 'add':
								case 'search':
									if (typeof(options.field_info.src.param.add) != 'undefined') custom_default_select_founded = options.field_info.src.param.add;
									break;
							}
							if (custom_default_select_founded != '') {
								$select.val(custom_default_select_founded).change()
							} else {
								$select.find('option:first').change()
							}
						}
						$select.multiselect()
					} catch (ex) {console.log('')}
				}
				if (typeof(options.field_info.src.param.list_id) != 'undefined') {
					renderer.get.query({
						func: 'CEditCat',
						action: 'listing',
						post: {
							method: 'get',
							list_id: options.field_info.src.param.list_id,
							order_by: options.field_info.src.param.order_by,
							user_id: 'all',
							status: '1',
							count: '200',
							price: 'new'
						},
						callback: function() {
							var json = this;
							if (json.status == 'good') {
								var data_list = {};
								for (var i = 0; i < json.result.length; i++) {
									var name = '';
									var names = [];
									if (typeof(options.field_info.src.param.id_json) != 'undefined') {
										try {
											var decoded = JSON.parse(json.result[i][options.field_info.src.param.id_json]);
											for (var index in decoded) names.push(decoded[index]);
										} catch (ex) {
											names.push('#' + json.result[i].ids);
										}
									}
									if (typeof(options.field_info.src.param.id_content) != 'undefined') {
										var decoded2 = json.result[i][options.field_info.src.param.id_content];
										names.push(decoded2);
									}
									name = names.join(', ');
									data_list[json.result[i].ids] = name;
								}
								draw_options(data_list);
							}
						}
					})
				} else {
					draw_options(options.field_info.src.param.list);
				}
				options.callback($select);
			},
			select: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var label = params.field_info.id;
				if(JSCat.Group.indexOf('selectstatus') != -1 || JSCat.Group.indexOf('admin') != -1){
					var $select = $('<select' + renderer.draw.attrs(options.attrs) + ' aria-label="' + label + '"></select>');
					
					$select.change(function() {
						$(this).attr('data-form', $(this).val());//list
					});
				}
				var draw_options = function(data_list) { 
					if (window.location.pathname != '/edit') {
						$select.append('<option value="0">- Не выбрано -</option>');
						for (var value in data_list) {
					 		$select.append('<option value="'+ value +'">'+ data_list[value] +'</option>');
					 	}
					}
					else if(window.location.pathname == '/edit' && (JSCat.Group.indexOf('selectstatus') != -1 || JSCat.Group.indexOf('admin') != -1)){
						$select.append('<option value="0">- Не выбрано -</option>');
						$select.append('<option value="1">'+ data_list[1] +'</option>');
						$select.append('<option value="31">'+ data_list[31] +'</option>');
						$select.append('<option value="89">'+ data_list[89] +'</option>');
						$select.append('<option value="90">'+ data_list[90] +'</option>');
						$select.append('<option value="91">'+ data_list[91] +'</option>');
						$select.append('<option value="92">'+ data_list[92] +'</option>');
						$select.append('<option value="29">'+ data_list[29] +'</option>');
						$select.append('<option value="2">'+ data_list[2] +'</option>');
						$select.append('<option value="82">'+ data_list[82] +'</option>');
						$select.append('<option value="28">'+ data_list[28] +'</option>');
						$select.append('<option value="33">'+ data_list[33] +'</option>');
						$select.append('<option value="10">'+ data_list[10] +'</option>');
						$select.append('<option value="48">'+ data_list[48] +'</option>');
						$select.append('<option value="47">'+ data_list[47] +'</option>');
						$select.append('<option value="88">'+ data_list[88] +'</option>');
						$select.append('<option value="5">'+ data_list[5] +'</option>');
						$select.append('<option value="11">'+ data_list[11] +'</option>');
						$select.append('<option value="12">'+ data_list[12] +'</option>');
						$select.append('<option value="13">'+ data_list[13] +'</option>');
						$select.append('<option value="86">'+ data_list[86] +'</option>');
						$select.append('<option value="14">'+ data_list[14] +'</option>');
						$select.append('<option value="85">'+ data_list[85] +'</option>');
						$select.append('<option value="15">'+ data_list[15] +'</option>');
						$select.append('<option value="34">'+ data_list[34] +'</option>');
						$select.append('<option value="16">'+ data_list[16] +'</option>');
						$select.append('<option value="35">'+ data_list[35] +'</option>');
						$select.append('<option value="17">'+ data_list[17] +'</option>');
						$select.append('<option value="36">'+ data_list[36] +'</option>');
						$select.append('<option value="18">'+ data_list[18] +'</option>');
						$select.append('<option value="37">'+ data_list[37] +'</option>');
						$select.append('<option value="19">'+ data_list[19] +'</option>');
						$select.append('<option value="38">'+ data_list[38] +'</option>');
						$select.append('<option value="20">'+ data_list[20] +'</option>');
						$select.append('<option value="39">'+ data_list[39] +'</option>');
						$select.append('<option value="21">'+ data_list[21] +'</option>');
						$select.append('<option value="40">'+ data_list[40] +'</option>');
						$select.append('<option value="22">'+ data_list[22] +'</option>');
						$select.append('<option value="41">'+ data_list[41] +'</option>');
						$select.append('<option value="23">'+ data_list[23] +'</option>');
						$select.append('<option value="42">'+ data_list[42] +'</option>');
						$select.append('<option value="24">'+ data_list[24] +'</option>');
						$select.append('<option value="43">'+ data_list[43] +'</option>');
						$select.append('<option value="25">'+ data_list[25] +'</option>');
						$select.append('<option value="44">'+ data_list[44] +'</option>');
						$select.append('<option value="26">'+ data_list[26] +'</option>');
						$select.append('<option value="45">'+ data_list[45] +'</option>');
						$select.append('<option value="27">'+ data_list[27] +'</option>');
						$select.append('<option value="46">'+ data_list[46] +'</option>');
						$select.append('<option value="9">'+ data_list[9] +'</option>');
						$select.append('<option value="49">'+ data_list[49] +'</option>');
						$select.append('<option value="57">'+ data_list[57] +'</option>');
						$select.append('<option value="55">'+ data_list[55] +'</option>');
						$select.append('<option value="56">'+ data_list[56] +'</option>');
						$select.append('<option value="52">'+ data_list[52] +'</option>');
						$select.append('<option value="50">'+ data_list[50] +'</option>');
						$select.append('<option value="53">'+ data_list[53] +'</option>');
						$select.append('<option value="51">'+ data_list[51] +'</option>');
						$select.append('<option value="54">'+ data_list[54] +'</option>');
						$select.append('<option value="7">'+ data_list[7] +'</option>');
						$select.append('<option value="58">'+ data_list[58] +'</option>');
						$select.append('<option value="59">'+ data_list[59] +'</option>');
						$select.append('<option value="60">'+ data_list[60] +'</option>');
						$select.append('<option value="61">'+ data_list[61] +'</option>');
						$select.append('<option value="62">'+ data_list[62] +'</option>');
						$select.append('<option value="63">'+ data_list[63] +'</option>');
						$select.append('<option value="64">'+ data_list[64] +'</option>');
						$select.append('<option value="65">'+ data_list[65] +'</option>');
						$select.append('<option value="66">'+ data_list[66] +'</option>');
						$select.append('<option value="67">'+ data_list[67] +'</option>');
						$select.append('<option value="68">'+ data_list[68] +'</option>');
						$select.append('<option value="69">'+ data_list[69] +'</option>');
						$select.append('<option value="70">'+ data_list[70] +'</option>');
						$select.append('<option value="71">'+ data_list[71] +'</option>');
						$select.append('<option value="72">'+ data_list[72] +'</option>');
						$select.append('<option value="74">'+ data_list[74] +'</option>');
						$select.append('<option value="75">'+ data_list[75] +'</option>');
						$select.append('<option value="73">'+ data_list[73] +'</option>');
						$select.append('<option value="76">'+ data_list[76] +'</option>');
						// $select.append('<option value="80">'+ data_list[80] +'</option>');
						$select.append('<option value="4">'+ data_list[4] +'</option>');
						$select.append('<option value="8">'+ data_list[8] +'</option>');
						$select.append('<option value="74">'+ data_list[74] +'</option>');
						$select.append('<option value="6">'+ data_list[6] +'</option>');
						$select.append('<option value="30">'+ data_list[30] +'</option>');
						$select.append('<option value="3">'+ data_list[3] +'</option>');
						$select.append('<option value="77">'+ data_list[77] +'</option>');
						$select.append('<option value="78">'+ data_list[78] +'</option>');
						// $select.append('<option value="79">'+ data_list[79] +'</option>');
						$select.append('<option value="81">'+ data_list[81] +'</option>');
						$select.append('<option value="83">'+ data_list[83] +'</option>');
						$select.append('<option value="84">'+ data_list[84] +'</option>');

					}


					try {
						var vals = options.data[options.field_id];
						var selected = Object.keys(vals)[0];
						if (selected) {
							$select.val(selected).change();
						} else {
							var custom_default_select_founded = '';
							switch (options.prerend_opts.view) {
								case 'add':
									if (typeof(options.field_info.src.param.add) != 'undefined') custom_default_select_founded = options.field_info.src.param.add;
									break;
								case 'search':
									if (typeof(options.field_info.src.param.add) != 'undefined') custom_default_select_founded = options.field_info.src.param.add;
									break;
							}
							if (custom_default_select_founded != '') {
								$select.val(custom_default_select_founded);
							} else {
								$select.find('option:first');
							}
							$select.change();
						}
						if (params.field_info.id == 'status') {
							$select.change(() => {
								confirm({
									text: 'Изменить статус и перезагрузить страницу?',
									ok: function() {
										if(window.location.pathname == '/edit'){
											var $data = {
												'liveinform' : $('input[class="liveinform"]').val(),
												'name' : $('input[class="name"]').val(),
												'address' : $('input[class="address"]').val(),
												'city' : $('input[class="city"]').val(),
												'size' : $('input[class="size"]').val(),
												'russianpostTrack' : $('input[class="russianpostTrack"]').val(),
												'postIndex' : $('input[class="postIndex"]').val(),
												'region' : $('input[class="region"]').val(),
												'flat' : $('input[class="flat"]').val(),
												'house' : $('input[class="house"]').val(),
												'weight' : $('input[class="weight"]').val(),
												'comment' : $('textarea[class="comment"]').val(),
												'completely' : $('textarea[class="completely"]').val(),
												'dop1' : $('input[class="dop1"]').val(),
												'dop3' : $('input[class="dop3"]').val(),
												'dop4' : $('input[class="dop4"]').val(),
												'dop5' : $('input[class="dop5"]').val(),
											};
											var save_json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
											save_json['action'] = "Update_Data";
											save_json["list"] = window.location.href.split('?')[1].split('-')[0];
											save_json["set"] = $data;
											save_json["id"] = window.location.href.split('-')[2];
											$.post("/json/", save_json, function(a) {

											});
											setTimeout(() => {
												var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
												json["action"] 	= "statusChange";
												json["list"] = window.location.href.split('?')[1].split('-')[0];
												// else json["list"] 		= $('tbody.call').attr('list');
												json["ids"] 		= [params.data.id];
												json["tostatus"] 	= $select.val();
												$.post("/json/", json, function(a) {
													location.reload()
												});
											}, 1500);
										}else{
											
										}
										
									},
									cancel: function() {
										$select.val(selected);
									}
								});
							})
						}
					} catch (ex) {console.log('')}
				}
				if (typeof(options.field_info.src.param.list_id) != 'undefined') {
					renderer.get.query({
						func: 'CEditCat',
						action: 'listing',
						post: {
							method: 'get',
							list_id: options.field_info.src.param.list_id,
							order_by: options.field_info.src.param.order_by,
							user_id: 'all',
							status: '1',
							count: '200',
							price: 'new'
						},
						callback: function() {
							var json = this;
							if (json.status == 'good') {
								var data_list = {};
								for (var i = 0; i < json.result.length; i++) {
									var name = '';
									var names = [];
									if (typeof(options.field_info.src.param.id_json) != 'undefined') {
										try {
											var decoded = JSON.parse(json.result[i][options.field_info.src.param.id_json]);
											for (var index in decoded) names.push(decoded[index]);
										} catch (ex) {
											names.push('#' + json.result[i].ids);
										}
									}
									if (typeof(options.field_info.src.param.id_content) != 'undefined') {
										var decoded2 = json.result[i][options.field_info.src.param.id_content];
										names.push(decoded2);
									}
									name = names.join(', ');
									data_list[json.result[i].ids] = name;
								}
								draw_options(data_list);
							}
						}
					})
				} else {
					draw_options(options.field_info.src.param.list);
				}
				options.callback($select);
			},
			time: function(params) {// && UNIX_timestamp != '0' && UNIX_timestamp != ''
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var tmp = options.data[options.field_id];
				var dmy = (tmp != '0' && tmp != '') ? util.timeConverters.dmy(options.data[options.field_id]) : '<i time>Нет данных</i>';
				var last = (tmp != '0' && tmp != '') ? util.timeConverters.last(options.data[options.field_id]) : '<i time>Нет данных</i>';
				var all = (dmy == last) ? last : dmy +'<i time>('+ last +')</i>';
				var res = '<span' + renderer.draw.attrs(options.attrs) + '>'+ all +'</span>';
				var $res = $(res);

				options.callback($res);
			},
			details: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				if (options.data[options.field_id].length > 0) {
					var res = '<details' + renderer.draw.attrs(options.attrs) + '><summary>Показать</summary><div><div>'+ options.data[options.field_id] +'</div></div></details>';
				} else {
					var res = '<i time>Нет данных</i>';
				}
				
				var $res = $(res)
				options.callback($res)
			},
			checkbox: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var res = '';
				var checked_state = '0';
				try {
					checked_state = options.data[options.field_id] == '1' ? '1' : '0';
				} catch (ex) {}
				$res = $('<label><input type="checkbox"' + renderer.draw.attrs(options.attrs) + ' data-form="' + checked_state + '"' + (checked_state == '1' ? ' checked="checked"' : '') + ' />' + options.attrs.label + '</label>');
				$res.find('input').change(function() {
					var $self = $(this);
					if ($self.is(':checked')) {
						$self.parent().attr('data-form', '1');
						eval( options.field_info.src.param );
					} else {
						$self.parent().attr('data-form', '0');
					}
				}).change();
				options.callback($res.get(0));
			},
			radio: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var res = '<span class="radio">';
				for (var value in options.field_info.src.param) {
					res += '<label><input name="' + options.field_id + '" type="radio"' + renderer.draw.attrs(options.attrs) + ' value=\'' + value + '\' renderer-radio="1" />' + options.field_info.src.param[value] + '</label>';
				}
				res += '</span>';
				$res = $(res);
				var $inputs = $res.find('input');
				$inputs.change(function() {
					var $this = $(this);
					$inputs.parent().removeClass('check');
					$this.parent().addClass('check');
					$this.parent().parent().attr('data-form', $this.val());
				});
				try {
					var selected = options.data[options.field_id];
					if (selected) {
						$inputs.map(function() {
							if (this.value && this.value == selected) {
								$(this).prop('checked', true);
								$(this).change();
							}
						});
					}
				} catch (ex) {}
				options.callback($res);
			},
			textarea: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var res = '';
				res += '<textarea' + renderer.draw.attrs(options.attrs) + '></textarea>';
				var $res = $(res);
				try {
					var selected = options.data[options.field_id];
					if (selected) {
						$res.val(selected);
					}
				} catch (ex) {}
				options.callback($res);
			},
			input: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var res = '';
				res += '<input' + renderer.draw.attrs(options.attrs) + ' />';
				var $res = $(res);
				try {
					var selected = options.data[options.field_id];
					if (selected) {
						$res.val(selected);
					}
				} catch (ex) {}
				options.callback($res);
			},
			range: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var res = '';
				var placeholder = '';
				var label = params.field_info.id;
				if(options.attrs.placeholder)
					placeholder = options.attrs.placeholder + ' ';
				res = $('<span range><input aria-label="in' + label + '" in placeholder="' + placeholder + 'от"' + renderer.draw.attrs(options.attrs) + ' /> - <input aria-label="out' + label + '" out placeholder="' + placeholder + 'до"' + renderer.draw.attrs(options.attrs) + ' /></span>');
				var $res = $(res);
				$res.change(function() {
					var $self = $(this);
					var datain = $self.find('[in]').val();
					var dataout = $self.find('[out]').val();				
					$self.attr('data-form-in', datain);
					$self.attr('data-form-out', dataout);
				}).change();
				options.callback($res);
			}
		}
	},
	//парсим атрибуты в []
	parse: {
		attrs: function(str) {
			var res = {};
			if (str) {
				str = str.replace("[", "").replace("]", "");
				var attrs = str.split(',');
				for (var i = 0; i < attrs.length; i++) {
					var name_val = attrs[i].split(':');
					name_val[0] = renderer.get.str_without_spaces(name_val[0]);
					var old_len = name_val[1].length;
					name_val[1] = renderer.get.str_without_quotes(name_val[1]);
					if (renderer.cfg.attrs_remove_spaces && name_val[1].length == old_len) {
						name_val[1] = renderer.get.str_without_spaces(name_val[1]);
					}
					if (name_val[0]) {
						res[name_val[0]] = name_val[1];
					}
				}
			}
			return res;
		}
	},
	get: {
		//сохранение/извлечение разметки каталога 
		listIfUndefined: function(options, callback) {
			if (util.isEmpty(options.list)) {
				$.ajax({
					url: JSCat.cdn + '/form/' + options.list_id + '.json?u=' + Math.random(),
					type: 'GET',
					dataType: 'json',
					success: function(d) {
						GLOBAL.cache.lists[options.list_id] = d;
						GLOBAL.cache.lists[options.list_id].id = options.list_id;
						callback(options.list = GLOBAL.cache.lists[options.list_id]);
					},
					error: function(e) {
						$.ajax({
							cache: true,
							url: '//' + JSCat.domain + '/json/?func=CPanel&action=gen&id=' + options.list_id + '&domain=' + JSCat.domain,
							type: 'POST',
							dataType: 'json',
							data: {
								method: 'gen'
							},
							context: this,
							success: function(d) {
								GLOBAL.cache.lists[options.list_id] = d;
								GLOBAL.cache.lists[options.list_id].id = options.list_id;
								callback(options.list = GLOBAL.cache.lists[options.list_id]);
							}
						});
					}
				});
			} else {
				callback(options.list);
			}
		},
		query: function(params) {
			var options = {
				action: null,
				url_prefix: util.cfg.url.func_lk,
				data: '',
				post: {},
				callback: function() {}
			};
			$.extend(options, params);
			var ajax_params = {
				url: options.url_prefix + options.data,
				success: function(response) {
					try {
						var decoded = JSON.parse(response);
						if (decoded) {
							options.callback.call(decoded);
						} else {
							options.callback.call({
								status: 'bad',
								err_msg: 'не удалось распарсить JSON-ответ'
							});
						}
					} catch (msg) {
						options.callback.call({
							status: 'bad',
							err_msg: 'не удалось распарсить JSON-ответ: ' + msg
						});
					}
				}
			};
			if (options.post !== null) {
				$.extend(options.post, {
					domain: JSCat.domain,
					token: JSCat.token,
					action: options.action
				});
				ajax_params.method = 'POST';
				ajax_params.data = options.post;
			}
			$.ajax(ajax_params);
		},
		func: function(params) {
			var options = {
				url_prefix: util.cfg.url.func,
				func: '',
				func_uri: '',
				data: '',
				post: null,
				callback: function() {}
			};
			$.extend(options, params);
			if (options.func) options.func_uri = '&func=' + options.func;
			var ajax_params = {
				url: options.url_prefix + options.func_uri + options.data,
				success: options.callback
			};
			if (options.post !== null) {
				if (typeof(options.post.domain) == 'undefined') options.post.domain = JSCat.domain;
				ajax_params.method = 'POST';
				ajax_params.data = options.post;
			}
			$.ajax(ajax_params);
		},
		mydata: function(data, timestamp_now) {
			var result = {};
			//if (typeof data !== 'object') data = JSON.parse(data);
			if (typeof(timestamp_now) == 'undefined') var timestamp_now = util.now();
			for (var index in data) {
				result[index] = {};
				result[index][timestamp_now] = data[index];
			}
			return result;
		},
		field: {
			init_vars: {
				view: 'card',
				data: {},
				field: null,
				callback: function() {}
			},
			text: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				if (typeof(options.data) == 'string') {
					if (options.field.caption != 'Товары' || options.data.length == 0) {
						options.callback(document.createTextNode(options.data));
					} else {
						var $el = $('<span></span>');
						var goods = JSON.parse(options.data);
						for (a in goods) {
							$el.append('<b good>'+ goods[a].name +'<b>')
						}
						options.callback($el);
					}
				} else {
					var $el = $('<span></span>');
					options.callback($el);
				}
			},
			// some: function(params) {
// 				var options = $.extend({}, renderer.get.field.init_vars, params);
// 				var src = '/cdn/lib/nophoto.jpg';
// 				var src_ava = src;
// 				var srcs = new Array();
// 				try {
// 					var img_info = JSON.parse(options.data);
// 					if (img_info) {
// 						for (var img_id in img_info) {
// 							if (typeof img_info[img_id].imgurl === 'undefined') {
// 								var idbase = '0';
// 								if (typeof(options.field.idbase) != 'undefined') idbase = options.field.idbase;
// 								if (typeof(options.prerend_opts.list_opts.list_id) != 'undefined') {
// 									idbase = options.prerend_opts.list_opts.list_id;
// 								}
// 								src = JSCat.cdn + '/card/' + idbase + '/' + img_info[img_id].img;
// 							} else {
// 								src = img_info[img_id].imgurl;
// 							}
// 							srcs.push(src);
// 						}
// 						src_ava = srcs[0];
// 					}
// 				} catch (err) {}
// 				srcs[0]?src_ava = srcs[0]:src_ava = src; //
// 				var $el = $('<a href="' + src + '"><img alt="" src="' + src + '" /></a>');
// 				switch (options.view) {
// 					case 'listing':
// 						$el = $('<a href="' + src_ava + '"><img alt="" src="' + src_ava + '" /></a>');
// 						break;
// 					case 'card':
// 						$el = $('<span></span>');
// 						for (var i = 0; i < srcs.length; i++) {
// 							var $link = $('<a href="' + srcs[i] + '" style="background-image:url(' + srcs[i] + ')"><img alt="" src="' + srcs[i] + '" /></a>');
// 							$el.append($link);
// 						}
// 						$el.photobox('a', {
// 							time: 3000
// 						});
// 						break;
// 				}
// 				options.callback($el);
// 			},
			fotoalbum: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				var src = '/cdn/lib/nophoto.jpg';
				var src_ava = src;
				var srcs = new Array();
				try {
					var img_info = JSON.parse(options.data);
					if (img_info) {
						for (var img_id in img_info) {
							if (typeof img_info[img_id].imgurl === 'undefined') {
								var idbase = '0';
								if (typeof(options.field.idbase) != 'undefined') idbase = options.field.idbase;
								if (typeof(options.prerend_opts.list_opts.list_id) != 'undefined') {
									idbase = options.prerend_opts.list_opts.list_id;
								}
								src = JSCat.cdn + '/card/' + idbase + '/' + img_info[img_id].img;
							} else {
								src = img_info[img_id].imgurl;
							}
							srcs.push(src);
						}
						src_ava = srcs[0];
					}
				} catch (err) {}
				srcs[0]?src_ava = srcs[0]:src_ava = src; //
				var $el = $('<a href="' + src + '"><img alt="" src="' + src + '" /></a>');
				switch (options.view) {
					case 'listing':
						$el = $('<a href="' + src_ava + '"><img alt="" src="' + src_ava + '" /></a>');
						break;
					case 'card':
						$el = $('<span></span>');
						for (var i = 0; i < srcs.length; i++) {
							var $link = $('<a href="' + srcs[i] + '" style="background-image:url(' + srcs[i] + ')"><img alt="" src="' + srcs[i] + '" /></a>');
							$el.append($link);
						}
						$el.photobox('a', {
							time: 3000
						});
						break;
				}
				options.callback($el);
			},
			system: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				renderer.get.field.text(options);
			},
			timeupdate: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				options.callback(document.createTextNode(''));
			},
			textint: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				var result = '';
 				//if (options.data !== null) result = parseInt(options.data);
				if (options.data !== null) result = options.data.replace(/(\d)(?=(\d{3})+\b)/g,'$1 ');
				result = $('<span>' + result + '</span>');
				options.callback(result);
			},
			textarea: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				if (options.field.param.json == 'true' && options.data.length > 10) {
					var obj = JSON.parse(options.data);
					var o ='<ul>';
					for (const key of Object.keys(obj)) {
						o += '<li>' + key + ': '+ obj[key] + "</li>";
					}
					o += '</ul>';
					options.data = o;
				}
				var container = document.createElement('span');
				var text = util.convert.normaliseNewLines(options.data);

				function strip_tags(input, allowed) {
					allowed = (((allowed || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('')
					var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi
					var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi
					return input;
				}
				var obj = $(container);
				obj.append(strip_tags(text, "<li><b>")).html(obj.html().replace(/\n/g, '<br/>'));
				options.callback(container);
			},
			select: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				var selected = options.data[Object.keys(options.data)[0]];
				selected = (typeof(selected) != 'undefined') ? selected : '';
				options.callback(document.createTextNode(selected));
			},
			multiselect: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				var selected = options.data[Object.keys(options.data)[0]];
				selected = (typeof(selected) != 'undefined') ? selected : '';
				options.callback(document.createTextNode(selected));
			},
			selectmenu: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				var root_span = document.createElement('span');
				if (options.data) {
					var decoded = JSON.parse(options.data);
					if (decoded) {
						var counter = 1;
						for (var menu_id in decoded) {
							var span = document.createElement('span');
							span.innerHTML = decoded[menu_id];
							span.className = 'ms' + counter;
							root_span.appendChild(span);
							counter++;
						}
					}
				}
				options.callback(root_span);
			},
			time: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				options.callback(document.createTextNode(options.data));
			},
			radiobtn: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				var text = '';
				if ( options.data && (options.field.param[options.data] !='0') ) 
					text = options.field.param[options.data];
				options.callback(document.createTextNode(text));
			},
			checkbox: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				var className = 'chekbox-hidden';
				if (options.data !== null && options.data !== '' && options.data !== 0 && options.data !== '0') className = '';
				var $element = $(document.createElement('span'));
				if (className) $element.addClass(className);
				options.callback($element);
			},
		},
		field_info: function(field_id, list) {
			var result = {
				id: field_id,
				src: null,
				type: null
			};
			if (typeof(renderer.get.field_info_static[field_id]) != 'undefined') {
				result = renderer.get.field_info_static[field_id](result);
			} else {
				if (typeof(list.field) != 'undefined' || typeof(list.fields) != 'undefined') {
					if (typeof(list.field) != 'undefined') {
						if (typeof(list.field[field_id]) != 'undefined') result.src = list.field[field_id];
					} else {
						if (typeof(list.fields[field_id]) != 'undefined') result.src = list.fields[field_id];
					}
					if (result.src !== null) {
						if (typeof(result.src.type_field) != 'undefined') {
							result.type = result.src.type_field;
						} else {
							if (typeof(result.src.type) != 'undefined') result.type = result.src.type;
						}
					}
				}
				try {
					result.src.param = JSON.parse(result.src.param);
				} catch (err) {}
				try {
					result.src.action = JSON.parse(result.src.action);
				} catch (err) {}
			}
			return result;
		},
		field_info_static: {
			id: function(result) {
				result.type = 'text';
				return result;
			}
		},
		list_columns: function(page_id, callback) {
			if (page_id) util.ajax({
				func: 'sys',
				data: '&page_id=' + page_id + '&action=get_list_rows',
				json: false,
				callback: function(decoded) {
					try {
						if (decoded !== false) {
							callback(decoded);
						} else {}
					} catch (except) {}
				}
			});
		},
		str_without_lines: function(str) {
			return str.replace(/(\r\n|\n|\r)/gm, "");
		},
		str_without_spaces: function(str) {
			return str.replace(/\s/gm, "");
		},
		str_without_quotes: function(str) {
			return str.replace(/['"]*/g, '');
		},
		el_without_children: function($dom) {
			var $el = $dom.clone();
			$el.children().remove();
			$el.html('');
			return $el;
		}
	},
	util: {
		advCacheToDrawData: function(adv_cache) {
			var result = {};
			if (!util.isEmpty(adv_cache)) {
				for (var field_name in adv_cache)
					for (var timestamp in adv_cache[field_name]) {
						result[field_name] = adv_cache[field_name][timestamp];
						break;
					}
			}
			return result;
		}
	},
	DOMObserver: function() {}
};
$(function() {
	renderer = new renderer_cl();
	renderer.process.known_elements();
	renderer.process.hash_links.init();
	$(document).trigger('rendererReady');
	$.fn.getAttributes = function() {
		var attributes = {};
		if (this.length) {
			$.each(this[0].attributes, function(index, attr) {
				attributes[attr.name] = attr.value;
			});
		}
		return attributes;
	};
	$.fn.visible = function() {
		return this.fadeIn();
	};
	$.fn.invisible = function() {
		return this.css('display', 'none');
	};
	$.fn.visibilityToggle = function() {
		return this.css('visibility', function(i, visibility) {
			return (visibility == 'visible') ? 'hidden' : 'visible';
		});
	};
});