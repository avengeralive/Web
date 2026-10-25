/*lib.core.js*/
util = {
    build: '1.0.23',
    cfg: {
        debug: true,
        url: {
            ajax: 						'//' + JSCat.domain + '/json/?domain=' + JSCat.domain + '&token=' + JSCat.token,
            query: 						'/json/?func=CEditCat',
            func: 						'//' + JSCat.domain + '/json/?domain=' + JSCat.domain,
            func_lk: 					'/json/?func=CEditCat&domain=' + JSCat.domain,
            resetCategoryRedirect: 		'//' + JSCat.domain + '/add',
            yandex_map: 				'//api-maps.yandex.ru/2.1/?lang=ru_RU',
            recaptcha: 					'https://www.google.com/recaptcha/api.js',
            lib: 						'//' + JSCat.domain + '/js/',
            parent: 					'//' + JSCat.domain + '/' + JSCat.domain + '/parent/'
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
        }
    },
    dom: {
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
        util.load_script(util.cfg.url.lib + name + '.js', callback);
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
    timeObject: function(UNIX_timestamp) {
        var time = {};
        var a = new Date(UNIX_timestamp * 1000);
        var months = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
        var enmonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        time.year = a.getFullYear();
        time.month = months[a.getMonth()];
        time.emonth = enmonths[a.getMonth()];
        time.minutes = a.getMinutes();
        time.hours = a.getHours();
        time.date = a.getDate();
        return time;
    },
    log: function(msg) {
        if (util.cfg.debug)
            for (var i = 0; i < arguments.length; i++) console.log(arguments[i]);
    }
}

function renderer_cl(params) {
	$.extend(this.options, params);
}

//observe 
$.extend($.fn,{observe:function(){function e(e){n={},function(e){Object.keys(f.list).forEach(function(t){e.is(t)?n[t]=e:Object.keys(f.list).forEach(function(t){$(t,e).each(function(){var e=$(this);e.is(t)&&(n[t]=e)})})})}(e),Object.keys(n).forEach(function(e){f.list[e].forEach(function(t){t.call(n[e].get(0),e)})})}var t,i,n,o=this.get(0),s=this,r={attributes:!1,childList:!0,subtree:!0},f=s.data("observe-list");if("function"==typeof arguments[0])t="*",i=arguments[0];else if("function"==typeof arguments[1])"string"==typeof arguments[0]?t=arguments[0]:(t="*",arguments[0]),i=arguments[1];else{if("function"!=typeof arguments[2])return;t=arguments[0],arguments[1],i=arguments[2]}return f||(s.data("observe-list",{list:{}}),f=s.data("observe-list"),window.MutationObserver&&(f.observer=new MutationObserver(function(t){t.forEach(function(t){t.addedNodes.forEach(function(t){e($(t))})})}))),f.list[t]||(f.list[t]=[]),f.list[t].some(function(e){if(i!=e)return!0})||f.list[t].push(i),f.live||(f.observer?f.observer.observe(o,r):s.on("DOMNodeInserted",function(t){e($(t.originalEvent.target))}),f.live=!0),s},stopobserve:function(e){function t(){n.observer?n.observer.disconnect():i.off("DOMNodeInserted"),delete n.live}var i=$(this),n=i.data("observe-list");return n&&(e?(delete n.list[e],Object.keys(n.list).length||t()):t()),i}});

renderer_cl.prototype = {
	build: '1.1',
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
			danteedit: '.danteedit',
			premium_item: '[premium]',
			add_item_republic: '.republic',
			search_form_tabs: '#search_button',
			search_item_click: '.find',
			search_item_container: '#search_content',
			search_item_delete: '.clear',
			close_item_click: '.closeform',
			form_action_save: '.save',
			form_action_search: '.startsearch',
			form_clear_search:	'.clearsearch',			
			change_category: '.rchange',
			change_search: '.schange',
			premium: '#premium',
			calls: '.call',
			refill: '.ib',
			owner: '.owner',
			id_user: '#id_user',
			card_openp: '.openp',
			card_openblank: '.openb',
			card_opennext: '.openr',
			card_closep: '.closep'
		},
		known_prerender_types: new Array('selectmenu', 'map', 'yandex', 'youtube', 'select', 'check', 'radio', 'textarea', 'input', 'range', 'gallery', 'link'),
		max_prerender_els: 10000,
		attrs_remove_spaces: false,
		lib_new_list_check_required: false,
		lib_new_list: {
			userName: true,
			pusrName: true
		},
		field_aliases: {
			index: 'id'
		},
		chat: {
			port: 8888
		},
		on_full_card_hide_all_calls: true
	},
	options: {},
	lib: function(func, obj, context) {
		var co = (context) ? context : this;
		var func_folder = typeof(renderer.cfg.lib_new_list[func]) != 'undefined' || !renderer.cfg.lib_new_list_check_required ? 'core' : 'func';
		var script = document.createElement('script');
		script.src = '/js/' + func_folder + '/' + func + '.js?v5';
		if (typeof(obj.onLibLoad) == 'undefined') obj.onLibLoad = function() {};
		if (renderer.lib_func[func]) {
			renderer.lib_func[func].call(co, obj);
			obj.onLibLoad();
		} else {
			if (window[func]) {
				f.call(co, func, obj);
			} else {
				head = document.getElementsByTagName('head')[0];
				head.appendChild(script);
				script.onload = f.bind(co, func, obj);
			}
		}

		function f(func, obj) {
			if (window[func]) {
				if (obj) {
					if (typeof(window[func]) == 'function') {
						window[func].call(co, obj);
					} else {
						console.log('Переменная ' + func + ', тип "' + typeof(window[func]) + '" не является функцией');
					}
				} else {
					window[func].call(co);
				}
			} else {
				console.log('Функция обработчика ' + func + ' в файле не найдена');
			}
			obj.onLibLoad();
		};
	},
	lib_func: {
		avatar: function(params) {
			console.log(params)
			var options = params.mydata.avatar[params.i];
			console.log(options)
			var container = document.createElement('span');
			if(options == 'nophoto.png' || options == '') {
				$(container).append('<img src="/cdn/lib/noavatar.png" alt="" />');
			} else {
				$(container).append('<img src="/cdn/'+ JSCat.domain +'/avatar/'+ options +'" alt="" />');
			}
			params.callback(container);
		},
		html: function(data) {
			var $el = $('<div id="htmls"></div>');
			function escapeHtml(text) {
				return text
					.replace(/&amp;/g, "&")
					.replace(/&lt;/g, "<")
					.replace(/&gt;/g, ">")
					.replace(/&quot;/g, '"')
					.replace(/&#039;/g, "'");
			}
			var ht = escapeHtml(data.mydata.Description[data.i]);
			$el.html(ht);
			data.callback($el);
		},
		dantestart: function(data) {
			var $el = $('<span id="dantestart">Редактировать</span>');
			
			$el.click(function(){
				$('#dantestart').remove();
				handler = function(data) {
            	console.log("content saved");
        		}
        		editor = new Dante.Editor({
      		   api_key: JSCat.token,
      	      el: "#htmls",
      	      //upload_url: "/json/?action=AddFileAlbum&func=CEditCat",
      	      store_url: "/json/?user="+ JSCat.user +"&token="+ JSCat.token +"&list_id="+ data.IDbase +"&item_id="+ data.ID +"&action=list19&func=CEditCat",
      	      //suggest_url: "/json3/",
      	      store_success_handler: handler,
      	      debug: false
      	  });
      	  editor.start()
			});
			
			if (JSCat.user.substr(0, 7) == 'wadmin_') $el.unbind().empty();
			data.callback($el);
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
		datapod: function(data) {//tmp
			var $el = $('<span></span>');
			$el.html(util.timeConverter(data.mydata.time[data.i]));
			data.callback($el);
		},
		viewfunc: function(data) {//tmp
			var $el = $('<span></span>');
			data.callback($el);
		},
		pusrName: function(data) {//tmp
			var $el = $('<span></span>');
			data.callback($el);
		},
		useronline: function(data) {//tmp
			var $el = $('<span></span>');
			data.callback($el);
		},
		dmg: function(data) {
			var $el = $('<span></span>');
			$el.html(util.timeConverterWithYear(data.mydata.timeupdate[data.i]));
			data.callback($el);
		},
		noob: function(data) {
			if (JSCat.template == 'london') var link = data.IDbase +'-'+ data.ID;
			if (JSCat.template != 'london') var link = 'https://'+ JSCat.domain +'/card?'+ data.IDbase +'-'+ data.ID;
			var $el = $( '<a target="_blank" href="https://'+ JSCat.domain +'/card?'+ data.IDbase +'-'+ data.ID +'">'+ link +'</a>' );
			data.callback( $el );
		},
		wrong: function(data) {
			var $el = '';
// 			var $el = $('<details wrong><summary>Жалоба</summary>\
// 	                <label><input type="radio" name="reason" id="w1' + data.IDbase + '' + data.ID + '' + data.i + '">Не актуально</label>\
// 	                <label><input type="radio" name="reason" id="w2' + data.IDbase + '' + data.ID + '' + data.i + '">Неверная цена</label>\
// 	                <label><input type="radio" name="reason" id="w3' + data.IDbase + '' + data.ID + '' + data.i + '">Не дозвониться</label></details>');
// 			
// 			function sendwrong(data) {
// 				var json = {func:'CWrongs', domain:JSCat.domain, token:JSCat.token};
// 				json["action"] = "creat_wrongs";
// 				json["list_id"] = data.IDbase;
// 				json["card_id"] = data.ID;
// 				json["param"] = $("input[name='reason']:checked").parent().text();
// 				$.post("/json/", json, function() {
// 					$('details[wrong] summary').text('Жалоба отправлена');
// 					$('details[wrong]').removeAttr('open');
// 				});
// 			}
// 			$el.find("input[name='reason']").change(sendwrong.bind(this, data));
			data.callback( $el );
		},
		social: function(data) {
			var $el = $( '<span></span>' );
			$el.append( '<span social="vk"></span><span social="ok"></span>' );
			$el.find('[social="vk"]').click(function() {
				$('[social="vk"]').toggleClass('selected');
				if ( $('[social="vk"]').hasClass('selected') ) {
				    $el.attr('data-form','vk')
				} else {
				    $el.removeAttr('data-form')
		    	}
		    });
			$el.find('[social="ok"]').click(function() {
				$('[social="ok"]').toggleClass('selected');
				if ( $('[social="ok"]').hasClass('selected') ) {
				    $el.attr('data-form','ok')
				} else {
				    $el.removeAttr('data-form')
		    	}
		    });
			data.callback( $el );
		},
		current: function(data) {
			var $el = $( '<span></span>' );
			$el.append($('title').text());
			data.callback( $el );
		},
		similar: function(data) {
			var $el = $( '<div class="call"></div>' );
			//количество карточек на странице
			renderer.get.query({
				func: 'CEditCat',
				action: 'listing',
				post: {
					method: 'get',
					list_id: data.IDbase,
					price: 'rand',
					user_id: 'all',
					similar: data.options.data.names,
					count: '2'
				},
				callback: function() {
					var json = this;
					if (json.status == 'good') {
						renderer.get.listIfUndefined({
							list_id: data.IDbase
						}, function(list) {
							renderer.process.showCardsList(json, list, $el);
						});
					}
				}
			});					
			data.callback( $el );
		},
		subLocalityName: function(data) {
			var $select = $( '<select data-view="search" data-form="0"></select>' );
			var json = {func:'CPanel', domain:JSCat.domain, token:JSCat.token};
			json["action"] = "raions_setting";
			json["city"] = JSON.parse(JSCat.city).city;
			$.post("/json/", json, function(result) {
				if (typeof result !== 'object' ) result = JSON.parse(result);
				$select.empty().append('<option value>- Не выбрано -</option>');	
				for (var b in result.raion.name) {
					$select.append('<option value="'+ result.raion.name[b] +'">' + result.raion.name[b] + '</option>');
				}
				function change_raions() {
	    			$select.attr('data-form', $select.val())
	    		}
				$select.change(change_raions.bind(this))
			});			
			data.callback( $select );
		}
	},
	process: {
		known_elements: function() {
			this.add();
			this.search();
			this.calls();
			this.billing();
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
							renderer.cfg.hash_params.action = 'full_card';
							renderer.cfg.hash_params.list_id = params[0];
							renderer.cfg.hash_params.item_id = params[1];
						}
					}
					renderer.process.hash_links.full_card()
				}
			},
			full_card: function() {
				if (renderer.cfg.hash_params.action) {
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
									var $root_container = $('pos' + list.position);
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
										tpl: list.html1,
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
			//console.log(options)
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
							if ( type == '0' ) {
								var text = 'Снять премиум услуги?';
							}
							if ( type == '1' ) {
								var text = 'С баланса аккаунта будет списано '+ color +' рублей, \
												а текущее объявление будет выделено цветом и поднято в поиске бесплатно. \
												Применить услугу "Выделение объявления"? ';
								if ( color == '' || color == '0' ) text = 'Применить услугу "Выделение объявления"?';
							}
							if ( type == '2' ) {
								var text = 'С баланса аккаунта будет списано '+ left +' рублей, \
												а текущее объявление будет размещено в премиум-блоке и поднято в поиске бесплатно. \
												Применить услугу "Премиум объявление"? ';
								if ( left == '' || left == '0' ) text = 'Применить услугу "Премиум объявление"?';
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
				$(this).unbind('click').click(function() {
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
		search: function() {

			if ($(renderer.cfg.selectors.search_item_container).attr('list'))		
			renderer.get.listIfUndefined({
				list_id: $(renderer.cfg.selectors.search_item_container).attr('list')
			}, function(list) {
				GLOBAL.cache.lists[list] = list;
				$(renderer.cfg.selectors.search_item_container).append(list.html3);
				
				renderer.process.search_render_form_item({
					selector_search_form: renderer.cfg.selectors.search_item_container,
					list_id: list,
					mode: 'append',
					use_parent_container: false,
					data: $(this).data()
				});
				//
				renderer.draw.onReady( renderer.cfg.selectors.form_action_search, function() {	
					if (saveform = $(renderer.cfg.selectors.form_action_search).get(0)) {
						$( renderer.cfg.selectors.form_action_search ).unbind('click').click(function(event) {
							localStorage.removeItem('search');
							var point = $('#sorter').parent().attr('class');
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
							
							if (localStorage.view != 'list' || localStorage.view != 'cube') {
								$('.search').css('opacity', '1');
								$('.search').css('pointer-events', 'auto');
								$( '.' + point + ' .call, div[paginator]').remove();
								$('#sorter').after('<div class="call" list="' + list + '" user="all" count="8" pagination="true"></div><div paginator style="display: none;"></div>');
								renderer.process.calls();
								$('.call').fadeIn();
							}
							
							if (localStorage.view == 'map') {
								$('.search').css('opacity', '0.5');
								$('.search').css('pointer-events', 'none');
							}
							return false;
													
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
				renderer.draw.onReady( renderer.cfg.selectors.change_search, function() {	
					var list = $(renderer.cfg.selectors.search_item_container).attr('list');
					var doub = [{1:'Продажа',9:'Аренда'},{2:'Продажа',11:'Аренда'},{3:'Продажа',12:'Аренда'},
						{4:'Продажа участков',10:'Продажа коммерческой земли',13:'Аренда коммерческой земли'},
						{5:'Продажа',14:'Аренда'},{6:'Продажа',15:'Аренда'},{7:'Продажа',16:'Аренда'}];
					
					function change_search(a) {
						localStorage.search = '';
						$('.call, [paginator]').remove().clone().insertAfter('#sorter');
						setTimeout(function() {
							$('#search_content, .call').attr('list', a);
							renderer.process.calls();
							renderer.process.search();
						}, 100);
						return false;						
					}	
					
					var item = 0;
					var cats = JSCat.category.split('_');
					if (cats.includes(list)) {
						for (var i = 0; i < doub.length; i++){
							if (doub[i][list] && Object.keys(doub[i]).length > 1) {
								for (a in doub[i]) {
									if (a == list || cats.includes(a)) {
										var checked = (doub[i][a] == doub[i][list]) ? 'checked' : '';
										$( renderer.cfg.selectors.change_search ).append('<input id="cc'+ a +'" list="'+ a +'" type="radio" name="cc" '+ checked +'><label for="cc'+ a +'">'+ doub[i][a] +'</label>');
										$('label[for="cc'+ a +'"]').click(change_search.bind(this, a));
										item++
									}
								}
								if (item < 2) $( renderer.cfg.selectors.change_search ).remove();
							}
						}
					} else alert('Укажите данную категорию в настройках сайта')
				});
			});
	
			renderer.draw.onReady(renderer.cfg.selectors.search_item_container, function() {
				if (!$(renderer.cfg.selectors.search_item_container).length) renderer.process.search_render_form_item();
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
			$( '[data-sorter="usertype"]' ).unbind();
			//определяем переменные
            localStorage.list = list;
			var text = $( '[data-sorter="text"]' ).val();
			if(!localStorage.price) localStorage.setItem('price','new');
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
			
			//сортировка все, компании, частные
			$( '[data-sorter="usertype"]' ).change(function() {
				$( '[data-sorter="usertype"] input[type="radio"]:checked' ).each(function() {
					localStorage.usertype = $( this ).attr( 'data-sort' );
					$('[data-sorter="usertype"] label').removeClass('page_in');
					$( this ).parent().addClass('page_in');
					$( this ).prop( "checked", true );
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
        					Pagination.Add(1, Pagination.step * 2 + 4);
        					Pagination.Last();
        				} else if (Pagination.page > Pagination.size - Pagination.step * 2) {
        					Pagination.First();
        					Pagination.Add(Pagination.size - Pagination.step * 2 - 2, Pagination.size + 1);
        				} else {
        					Pagination.First();
        					Pagination.Add(Pagination.page - Pagination.step, Pagination.page + Pagination.step + 1);
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
						var pagination 			= $calls_root.attr('pagination');
						var my_list_id 			= localStorage.list;
						var user_id 			= $calls_root.attr('user') || '';
						var count 				= $calls_root.attr('count');
						var search = '';
						if ( localStorage.search ) search += localStorage.search;
						renderer.get.query({
							func: 'CEditCat',
							action: 'listing',
							post: {
								method: 'get',
								offset: offset,
								pagination: pagination,
								list_id: my_list_id,
								text: text,
								search: search,
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
									});
								}
								if (json.count != false && $calls_root.attr('pagination') ) {
									var length = $calls_root.attr('count');
									var list = $calls_root.attr('list');
									renderer.process.pagination(json.count, length, list, json.offset);
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
				if (cont.attr('template') == '7') tpl = list.html7;
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
									});
								}
							});
						}
					}
		},
		billing: function() {
			renderer.draw.onReady(renderer.cfg.selectors.refill, function() {
				var $refill = $(this);
				var $button = $refill.find('button');
				$button.prop('disabled', true);
				renderer.get.query({
					action: 'dbsettings',
					post: {
						method: 'get',
						list: 'kassa_shop_id;kassa_vitrina_id'
					},
					callback: function() {
						var json = this;
						if (json.status == 'good') {
							$refill.find('input[name="shopId"]:first').val(json.result.kassa_shop_id);
							$refill.find('input[name="scid"]:first').val(json.result.kassa_vitrina_id);
							$('#UserNumber').val(JSCat.user);
							$('#balance').html(JSCat.user_balance + ' руб.');
							$button.prop('disabled', false);
						}
					}
				});
			});
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
						var pagination 			= $calls_root.attr('pagination'); //пагинация
						var my_list_id 			= $calls_root.attr('list') || '0';
						var user_id 			= $calls_root.attr('user') || '';
						var count 				= $calls_root.attr('count'); //количество карточек на странице
						var search = '';
						if ( localStorage.search ) search += localStorage.search;
						renderer.get.query({
							func: 'CEditCat',
							action: 'listing',
							post: {
								method: 'get',
								offset: offset,
								pagination: pagination,
								list_id: my_list_id,
								text: '',
								search: search,
								price: localStorage.price,
								usertype: localStorage.usertype,
								user_id: user_id,
								count: count,
								page: JSCat.page
							},
							callback: function() {
								var json = this;
								if (json.status == 'good') {
									renderer.get.listIfUndefined({
										list_id: my_list_id
									}, function(list) {
										renderer.process.showCardsList(json, list, $calls_root);
									});
								}
								if (json.count != false && $calls_root.attr('pagination') ) {
									var length = $calls_root.attr('count');
									var list = $calls_root.attr('list');
									renderer.process.pagination(json.count, length, list, json.offset);
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
				$html.find(renderer.cfg.selectors.owner).remove();
			}
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
					$(document).observe(selector, options, func);
				} else {
					$(document).observe(selector, func);
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
			renderer.lib('add', {
				id: options.list_id,
				html5: options.list.html5,
				onLibLoad: function() {
					renderer.get.listIfUndefined(options, function(list) {
						var $container_src = options.$container;
						if (options.use_parent_container) $container_src = $container_src.parent();
						renderer.draw.el({
							view: 'add',
							container: $container_src,
							tpl: options.list.html5,
							data: options.data,
							mode: options.mode,
							list: options.list,
							list_id: options.list_id,
							callback: function($html) {
								$html.find(renderer.cfg.selectors.close_item_click).click(function() {
									$html.remove();
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
		card: function() {
			var $this = $(this);
			var html_data = $this.data();
			//mode: 'append' нужен для работы похожих объявлений
			if (typeof(html_data.options.list.position) == 'undefined') html_data.options.list.position = GLOBAL.cache.lists[options.position];
			var $container = $(renderer.cfg.selectors.pos_prefix + html_data.options.list.position);
			//console.log(html_data)
			//console.log(GLOBAL.cache.lists)
			renderer.draw.el({
				view: 'card',
				mode: 'append',
				container: $container,
				tpl: html_data.options.list.html1,
				data: html_data.options.data,
				list: html_data.options.list,
				list_id: html_data.options.list_id,
				callback: function($html) {
				
					renderer.process.cardActions($html, function() {
						var $html = $(this);
					});
					
					
					if (JSCat.template == 'london' && JSCat.cpu == 'card') {
						var imageUrl = $('.detail .galleryfield a:first-of-type').attr('href');
						$('.detail .gally').css('background', 'url(' + imageUrl + ') 0% 35% / cover no-repeat');
						$('.detail .galleryfield').css('margin-left', $('.detail .galleryfield').css('margin-left'));
						var start = parseInt($('.detail .galleryfield').css('margin-left'));
						localStorage.setItem('londonslider', 1);
						
						if (localStorage.londonslider >= 1 && 
						localStorage.londonslider <= $('.detail .galleryfield a').length &&
						parseInt($('.detail .galleryfield').css('margin-left')) <= start &&
						$('.detail .galleryfield').prop('scrollWidth') <= document.body.offsetWidth) {
							$('.nexxt').click(function() {
								if (localStorage.londonslider < $('.detail .galleryfield a').length) {
									var $next = $('.detail .galleryfield a:nth-of-type('+ localStorage.londonslider +')');
									$('.detail .galleryfield').css('margin-left', parseInt($('.detail .galleryfield').css('margin-left')) - ($next.width()) + 'px');
									localStorage.londonslider++
								}
								console.log(localStorage.londonslider)
								return false;
							});
							$('.preww').click(function() {
								if (localStorage.londonslider > 1) {
									localStorage.londonslider--
									var $next = $('.detail .galleryfield a:nth-of-type('+ localStorage.londonslider +')');
									$('.detail .galleryfield').css('margin-left', parseInt($('.detail .galleryfield').css('margin-left')) + ($next.width()) + 'px');
								}
								console.log(localStorage.londonslider)
								return false;
							});
						}
					}
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
		},
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
			var regexp_str = '{{(\\w+)(\\.|)(' + renderer.cfg.known_prerender_types.join('|') + '|){1}(.*?)}}';
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
												console.log('processor/renderer for dynamic tag/field "' + conf.processor + '" / "' + conf.field_id + '" not found');
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
			map: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				options.attrs = $.extend({}, {
					type: 'address',
					width: 400,
					height: 300
				}, options.attrs);
				var span = document.createElement('div');
				switch (options.attrs.type) {
					case 'address':
						$(span).attr({
							class: options.field_id,
							id: options.field_id,
							'data-form': options.data[options.field_id]
						});
						yandex_add({
							field: span,
							list: options.list.id,
							key: options.field_id
						});
						break;
					case 'polygon':
						var $MapCanvas = function() {
							var _class, element = document.createElement('canvas'),
								ctx = element.getContext('2d'),
								coordsSet = [],
								drawSet = [],
								position = {},
								hasTouch = 'ontouchstart' in window && !/hp-tablet/gi.test(navigator.appVersion);
							_class = {
								show: function() {
									element.style.display = 'block';
								},
								hide: function() {
									element.style.display = 'none';
								},
								getElement: function() {
									return element;
								},
								init: function(options) {
									element.width = options.wrapper.offsetWidth;
									element.height = options.wrapper.offsetHeight;
									options.wrapper.appendChild(element);
									if (hasTouch) {
										element.addEventListener('touchstart', touchStart);
									} else {
										element.addEventListener('mousedown', mouseDown);
									}
									if (options.attr) {
										Object.keys(options.attr).forEach(function(name) {
											element[name] = options.attr[name];
										});
									}
									if (options.hidden) {
										this.hide();
									}
									return element;

									function mouseDown(e) {
										e.stopPropagation();
										e.preventDefault();
										startReaction(e);
										element.addEventListener('mouseup', mouseUp);
										element.addEventListener('mousemove', mouseMove);
									}

									function mouseMove(e) {
										e.stopPropagation();
										e.preventDefault();
										moveReaction(e);
									}

									function mouseUp(e) {
										e.stopPropagation();
										e.preventDefault();
										element.removeEventListener('mouseup', mouseUp);
										element.removeEventListener('mousemove', mouseMove);
										endReaction();
									}

									function touchStart(e) {
										e.stopPropagation();
										e.preventDefault();
										startReaction(e.touches[0] || e);
										element.addEventListener('touchend', touchEnd);
										element.addEventListener('touchmove', touchMove);
									}

									function touchMove(e) {
										e.stopPropagation();
										e.preventDefault();
										moveReaction(e.touches[0] || e);
									}

									function touchEnd(e) {
										e.stopPropagation();
										e.preventDefault();
										element.removeEventListener('touchend', touchEnd);
										element.removeEventListener('touchmove', touchMove);
										endReaction();
									}

									function setCoords(e) {
										var coords = {
											x: e.pageX - position.x,
											y: e.pageY - position.y
										};
										coordsSet.push({
											x: e.pageX - element.offsetLeft,
											y: e.pageY - element.offsetTop
										});
										drawSet.push(coords);
										return coords;
									}

									function startReaction(e) {
										var rect = element.getBoundingClientRect(),
											scroll = {
												left: document.documentElement.scrollLeft || document.body.scrollLeft,
												top: document.documentElement.scrollTop || document.body.scrollTop
											};
										position = {
											x: rect.left + scroll.left,
											y: rect.top + scroll.top
										};
										coordsSet = [];
										drawSet = [];
										ctx.clearRect(0, 0, element.width, element.height);
										setCoords(e);
									}

									function moveReaction(e) {
										setCoords(e);
										if (drawSet.length > 1) {
											ctx.beginPath();
											ctx.moveTo(drawSet[drawSet.length - 2].x, drawSet[drawSet.length - 2].y);
											ctx.lineTo(drawSet[drawSet.length - 1].x, drawSet[drawSet.length - 1].y);
											ctx.stroke();
										}
									}

									function endReaction() {
										ctx.clearRect(0, 0, element.width, element.height);
										if (options.callback) {
											options.callback(coordsSet);
										}
									}
								}
							};
							return _class;
						}();
						util.load_script('https://' + JSCat.domain + '/js/simplify.js');
						util.load_script(util.cfg.url.yandex_map, function() {
							ymaps.ready(function() {
								var draw_polygon_map = function(coords) {
									if (coords === undefined) {
										coords = [util.cfg.def.coords.lat, util.cfg.def.coords.lng];
									}
									var ymap_container = document.createElement('div');
									$MapCanvas.init({
										wrapper: span,
										dims: options.attrs,
										attr: {
											id: 'canv'
										},
										hidden: true,
										callback: function(coordsSet) {
											Map.addPolygon(Map.convert(simplify(coordsSet, 5)));
										}
									});
									ymap_container.style.width = options.attrs.width;
									ymap_container.style.height = options.attrs.height;
									var Map = (function() {
										var ymap, polygonCollection;
										ymaps.ready(function() {
											ymap = new ymaps.Map(ymap_container, {
												center: coords,
												zoom: util.cfg.def.zoom,
												controls: []
											});
											ymap.behaviors.disable('scrollZoom');
											var objectManager = new ymaps.ObjectManager({
												clusterize: true,
												gridSize: 100
											});
											ymap.geoObjects.add(objectManager);
											
											$.ajax({
												url: '//' + JSCat.domain + '/json/?func=yandex&action=get_markers',
												data: {
													'type': 1,
													'list': localStorage.list,
													'domain': JSCat.domain,
													'token': JSCat.token
												},
												method: 'POST',
											}).done(function(data) {
												if (data) objectManager.add(data);
											});
											polygonCollection = new ymaps.GeoObjectCollection({}, {});
											ymap.geoObjects.add(polygonCollection);
											
											var $button = {
												poly_zoom_up: $('<a class="poly_zoom_up">+</a>'),
												poly_zoom_down: $('<a class="poly_zoom_down">-</a>'),
												check_location: $('<a class="check_location"></a>'),
												poly_stop: $('<a class="poly_stop"></a>'),
												poly_start: $('<a class="poly_start"></a>')
											}
											

                            				
											$button.poly_start.show();
											$button.poly_stop.hide();
											$button.poly_zoom_up.click(function() {
												ymap.setZoom(ymap.getZoom() + 1, {
													checkZoomRange: true,
													duration: 300
												});
												return false;
											});
											$button.poly_zoom_down.click(function() {
												ymap.setZoom(ymap.getZoom() - 1, {
													checkZoomRange: true,
													duration: 300
												});
												return false;
											});
											$button.check_location.click(function() {
												//определяем геолокацию через браузер
												ymaps.geolocation.get({
													provider: 'browser',
													mapStateAutoApply: true
												}).then(function (result) {
													result.geoObjects.options.set('preset', 'islands#redCircleIcon');
													ymap.geoObjects.add(result.geoObjects);
													//zoom при определении геолокации
													//ymap.setCenter({result.geoObjects.get(0).geometry.getCoordinates(), 14, {duration: 300}});
												});
											});
											$button.poly_start.click(function() {
												$button.poly_stop.show();
												$button.poly_start.hide();
												$MapCanvas.show();
												return false;
											});
											$button.poly_stop.click(function() {
												$button.poly_stop.hide();
												$button.poly_start.show();
												$MapCanvas.hide();
												polygonCollection.removeAll();
												$(ymap_container).parent().removeAttr('data-form');
												return false;
											});
											span.appendChild(ymap_container);
											span.appendChild($button.poly_zoom_up.get(0));
											span.appendChild($button.poly_zoom_down.get(0));
											span.appendChild($button.check_location.get(0));
											span.appendChild($button.poly_start.get(0));
											span.appendChild($button.poly_stop.get(0));
											$(document).data('last_ymap_set', {
												ymap: ymap,
												polygon: polygonCollection
											});
										});

										function convert(coords) {
											var projection = ymap.options.get('projection');
											return coords.map(function(el) {
												var c = projection.fromGlobalPixels(ymap.converter.pageToGlobal([el.x, el.y]), ymap.getZoom());
												return c;
											});
										}

										function addPolygon(coord) {
											var Polygon = new ymaps.GeoObject({
												geometry: {
													type: "Polygon",
													coordinates: [coord],
												},
											}, {
												fillColor: '#45ff00',
												strokeColor: '#111',
												opacity: 0.5,
												strokeWidth: 2
											});
											polygonCollection.removeAll();
											polygonCollection.add(Polygon);
											ymap.setBounds(polygonCollection.getBounds());
											var coords = Polygon.geometry.getCoordinates();
											$(span).attr('data-form', JSON.stringify({
												ycoradr: {
													coords: coords.length && coords[0].length ? coords[0][0][0] + ',' + coords[0][0][1] : '0,-999',
													address: '',
													polygon: coords
												}
											}));
										}
										return {
											addPolygon: addPolygon,
											convert: convert
										};
									})();
								};
								var geocode_text = JSON.parse(JSCat.city).name;
								if (geocode_text) {
									var myGeocoder = ymaps.geocode(geocode_text);
									//console.log(myGeocoder)
									myGeocoder.then(function(res) {
										draw_polygon_map(res.geoObjects.get(0).geometry.getCoordinates());
									}, function(err) {
										draw_polygon_map();
									})
								} else {
									draw_polygon_map();
								}
							});
						});
						break;
				}
				if ( localStorage.mapconteyner != 'undefined' )
					$( '#' + localStorage.mapconteyner ).append(span);
				options.callback(span);
			},
			yandex:  function(params) {
				var $el = $('<span></span>');
				var $ed = $('<div class="metro"></div>');
				if ( params.attrs.type ) {					
					for(var key in params.data) {
						if(key == params.field_id) {
							var decoded = JSON.parse(params.data[key]);
							$el.html(decoded.ycoradr.address);
						}
					}
				}
				params.callback($el);
			},
			youtube: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var $el = $('<span></span>');
				try {
					var url = options.data[options.field_id];
					if (url.indexOf("v=") != -1) {
						var temp = url.split("?")[1];
						var arr_temp = temp.split("&");
						for (var i = 0; i < arr_temp.length; i++) {
							var res = arr_temp[i].split("=");
							if (res[0] == 'v') {
								url = res[1];
								break;
							}
						}
						url = "https://www.youtube.com/embed/" + url;
					}
					if (url.indexOf("src=") != -1) {
						url = url.split('src="')[1].split('"')[0];
					}
					if (url.indexOf("//youtu.be/") != -1) {
						url = "https://www.youtube.com/embed/" + url.split('//youtu.be/')[1];
					}
					if (url != '') {
						$el = $('<iframe></iframe>');
						$el.attr('src', url);
						for (var attr_index in options.attrs) $el.attr(attr_index, options.attrs[attr_index]);
					}
				} catch (ex) {
					console.log('[renderer::youtube] ' + ex);
				}
				options.callback($el);
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
				$el.attr('href', href);
				if (typeof(options.attrs.class) != 'undefined') $el.addClass(options.attrs.class);
				if (typeof(options.attrs.target) != 'undefined') $el.attr('target', options.attrs.target);
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
				if(typeof(window.modPhoto) !== 'undefined') {
					modPhoto(options.field_id, data_form, el, options.prerend_opts.list_opts.list_id, srcs);
				}

				options.callback(el);
			},
			select: function(params) {
				var options = $.extend({}, renderer.prerend.processors.init_vars, params);
				var label = params.field_info.id;
				var $select = $('<select' + renderer.draw.attrs(options.attrs) + ' aria-label="' + label + '"></select>');
				$select.change(function() {
					$(this).attr('data-form', $(this).val());
				});
				var draw_options = function(data_list, list) {
					if (!list) list = ["id_json"];
					for (var i = 0; i < list.length; i++) {
						for (var value in data_list) {
							var option = document.createElement('option');
							option.value = value;
							option.innerHTML = data_list[value];
							$select.append(option);
						}
						try {
							var selected = options.data[options.field_id];
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
						} catch (ex) {}
					}
				}
				if (typeof(options.field_info.src.param.list_id) != 'undefined') {
					renderer.get.query({
						func: 'CEditCat',
						action: 'listing',
						post: {
							method: 'get',
							list_id: options.field_info.src.param.list_id,
							user_id: '0'
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
											names.push('#' + json.result[i].id);
										}
									}
									if (typeof(options.field_info.src.param.id_content) != 'undefined') {
										var decoded2 = json.result[i][options.field_info.src.param.id_content];
										names.push(decoded2);
									}
									name = names.join(', ');
									data_list[json.result[i].id] = name;
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
			check: function(params) {
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
					options.callback(document.createTextNode(options.data));
				} else {
					var $el = $('<span></span>');
					options.callback($el);
				}
			},
			yandex: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				var container = document.createElement('div');
				options.field.param = $.extend({}, {
					width: 200,
					height: 300,
					zoom: 16,
					open_container: false
				}, options.field.param);
				var coords = null;
				try {
					coords = JSON.parse(options.data);
					if (typeof(coords.ycoradr) == 'undefined' || !coords.ycoradr.coords) {
						coords = null;
					} else {
						coords.ycoradr.coords = coords.ycoradr.coords.split(',');
						for (var i = 0; i < coords.ycoradr.coords.length; i++) coords.ycoradr.coords[i] = parseFloat(coords.ycoradr.coords[i]);
					}
				} catch (ex) {}
				switch (options.view) {
					case 'card':
						var ya_map_container = container;						
						if (options.field.param.open_container) {
							ya_map_container = document.createElement('div');
							$(ya_map_container).hide();
							var $open_button = $('<a href="#">Показать на карте</a>');
							$open_button.click(function() {
								var $ya_map_container = $(ya_map_container);
								if ($ya_map_container.is(':visible')) {
									$ya_map_container.hide();
								} else {
									$ya_map_container.show();
								}
								return false;
							});
							$(container).append([$open_button, ya_map_container]);
						}
						ya_map_container.style.width = parseInt(options.field.param.width) + 'px';
						ya_map_container.style.height = parseInt(options.field.param.height) + 'px';
						if (coords !== null) {
							util.load_script(util.cfg.url.yandex_map, function() {
								ymaps.ready(function() {
									var ya_map = new ymaps.Map(ya_map_container, {
										center: coords.ycoradr.coords,
										zoom: options.field.param.zoom,
										controls: []
									});
									ya_map.behaviors.disable('scrollZoom');
									var $button = {
										podr_zoom_up: $('<a class="podr_zoom_up">+</a>'),
										podr_zoom_down: $('<a class="podr_zoom_down">-</a>')
									};
									$button.podr_zoom_up.click(function() {
										ya_map.setZoom(ya_map.getZoom() + 1, {
											checkZoomRange: true,
											duration: 300
										});
										return false;
									});
									$button.podr_zoom_down.click(function() {
										ya_map.setZoom(ya_map.getZoom() - 1, {
											checkZoomRange: true,
											duration: 300
										});
										return false;
									});
									var myPlacemark = new ymaps.Placemark(ya_map.getCenter(), {
										balloonContent: coords.ycoradr.address,
									});
									ya_map.geoObjects.add(myPlacemark);
									ya_map_container.appendChild($button.podr_zoom_up.get(0));
									ya_map_container.appendChild($button.podr_zoom_down.get(0));
								});
							});
						}
						break;
					default:
						try {
							var decoded = JSON.parse(options.data);
                            $(container).append(decoded.ycoradr.address);
                            if (decoded.metro.branch)
                            	$(container).append('<span metro="'+decoded.metro.branch+'">'+decoded.metro.metroName+'<i>'+decoded.metro.distance+'</i></span>');
						} catch (ex) {}
						break;
				}
				options.callback(container);
			},
			fotoalbum: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				var src = '/cdn/lib/nophoto.jpg';
				//console.log()
				var src_ava = src;
				var srcs = new Array();
				try {
					var img_info = JSON.parse(options.data);
					if (img_info) {
						for (var img_id in img_info) {
							var idbase = '0';
							if (typeof(options.field.idbase) != 'undefined') idbase = options.field.idbase;
							if (typeof(options.prerend_opts.list_opts.list_id) != 'undefined') {
								idbase = options.prerend_opts.list_opts.list_id;
							}
							src = JSCat.cdn + '/card/' + idbase + '/' + img_info[img_id].img
							srcs.push(src);
						}
						src_ava = srcs[0];
					}
				} catch (err) {}
				
				srcs[0]?src_ava = srcs[0]:src_ava = src; //
				var $el = $('<a href="' + src + '"><img alt="" src="' + src + '" /></a>');
				switch (options.view) {
					case 'listing':
						$el = $('<a href="' + src_ava + '" style="font-size:0px;background-image:url(' + src_ava + ')"></a>');
						break;
					case 'card':						
						$el = $('<div class="'+ JSCat.template +'slider"></div>');
						for (var i = 0; i < srcs.length; i++) {
							if (JSCat.template != 'london') var $link = $('<a style="background-image:url(' + srcs[i] + ')" href="' + srcs[i] + '"></a>');
							if (JSCat.template == 'london') var $link = $('<a href="' + srcs[i] + '" style="font-size:0"><img alt="" src="' + srcs[i] + '">'+ document.title +'</a>');
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
			youtube: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				options.callback(document.createTextNode(options.data));
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
				var text = options.data;
				try {
					if (typeof(options.field.param.id_content) != 'undefined') {
						renderer.get.query({
							func: 'CEditCat',
							action: 'listing',
							post: {
								method: 'get',
								list_id: options.field.param.list_id
							},
							callback: function() {
								var json = this;
								if (json.status == 'good') {
									for (var i = 0; i < json.result.length; i++) {
										if (options.data == json.result[i].id) {
											text = json.result[i][options.field.param.id_content];
											break;//?
										}
									}
								}
								options.callback(document.createTextNode(text));
							}
						});
					} else {
						if (typeof(options.field.param.list[options.data]) != 'undefined') text = options.field.param.list[options.data];
						if (!text) {
							switch (options.view) {
								case 'listing':
									if (typeof(options.field.param.preview) != 'undefined' && typeof(options.field.param.list[options.field.param.preview]) != 'undefined') text = options.field.param.list[options.field.param.preview];
									break;
								case 'card':
									if (typeof(options.field.param.detail) != 'undefined' && typeof(options.field.param.list[options.field.param.detail]) != 'undefined') text = options.field.param.list[options.field.param.detail];
									break;
							}
						}
						options.callback(document.createTextNode(text));
					}
				} catch (ex) {}
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
			chekbox: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				var className = 'chekbox-hidden';
				if (options.data !== null && options.data !== '' && options.data !== 0 && options.data !== '0') className = '';
				var $element = $(document.createElement('span'));
				if (className) $element.addClass(className);
				options.callback($element);
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
			check: function(params) {
				var options = $.extend({}, renderer.get.field.init_vars, params);
				var text = '';
				if (typeof(options.data) == 'string') text = options.data;
				options.callback(document.createTextNode(text));
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
		},
		yandex: {
			init_vars: {
				container: null,
				onDrawed: function() {}
			},
			view: function(params) {
				var options = $.extend({}, renderer.util.yandex.init_vars, params);
				util.load_script(util.cfg.url.yandex_map, function() {
					ymaps.ready(function() {
						options.onDrawed();
					});
				});
			}
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
		return this.css('visibility', 'visible');
	};
	$.fn.invisible = function() {
		return this.css('visibility', 'hidden');
	};
	$.fn.visibilityToggle = function() {
		return this.css('visibility', function(i, visibility) {
			return (visibility == 'visible') ? 'hidden' : 'visible';
		});
	};
});