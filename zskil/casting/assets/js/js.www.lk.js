/////////////////////////////////////////////////////////
//	js.www.lk.js
//
//	JavaScript-логика (личный кабинет)
//
//	Автор: И.Ашмарин, mail[-===-]harduino.com
//
/////////////////////////////////////////////////////////
var config = {
	paths:		{
		img:	URI+'/assets/images/',
		img_lk:	URI+'/assets/images/lk/'
	},
	intervals:	{},
	block:	{},
	requests:	{},
	cache: {},
	index:	{},
	suggest_max_items:	10,
	resize_timeout:	600,
	tinymce:	{
		selector:	'.js-wysiwyg',
		language:	'ru',
		plugins:	'advlist autolink code fullscreen link paste preview searchreplace table textcolor visualblocks visualchars wordcount image responsivefilemanager',
		toolbar:	[
			"bold italic underline strikethrough alignleft aligncenter alignright alignjustify formatselect fontselect fontsizeselect",
			"bullist numlist | outdent indent | blockquote | subscript superscript | forecolor backcolor | fullscreen link searchreplace table visualblocks | image responsivefilemanager "
		],
		removed_menuitems: 'newdocument',
		external_filemanager_path:	URI_FRAMEWORK+"/filemanager/",
		filemanager_title:			"Filemanager" ,
		external_plugins:			{ "filemanager" : URI_FRAMEWORK+"/filemanager/plugin.min.js"},
		relative_urls:				false,
		height: 300
	}
}

var $tbl_tpls = {};
$(function(){

	init.common();

	switch( lk_module ) {

		/* ======================================================= */
		case 'ankets':
		/* ======================================================= */
			switch( submodule ) {
				// ------------------------------------------------ \\
				case 'edit':
				case 'insert':
					init.ratingChoose();
					init.mediaControl();
					init.anketsInsert();
					tinymce.init( config.tinymce );
				break;
				// ------------------------------------------------ \\
				case 'listing':
					init.multiSelect();
					init.multiDefault();
					init.listFilters();
					init.anketsListing();
					init.ratingChoose();
					init.inlineViewers();
				break;
				// ------------------------------------------------ \\
			}
		break;
		/* ======================================================= */
	}

});

var init = {

	anketsListing:	function() {
		// $(document).swipebox({selector: '.swipebox'});
		$( '.swipebox' ).swipebox();

		// быстрое редактирование статуса анкеты
		$( '.js-item-status' ).map(function(){

			var $root = $( this );
			var item_id = $root.attr( 'data-item-id' );
			var $selects = $root.children();

			$selects.click(function(ev){
				var $self = $( this );
				var new_status = $self.attr( 'data-item-status' );

				$
					.ajax({
						url:	URI+'/lk/ajax/ankets-set-status/',
						method:	'GET',
						data:	{
							item_id:	item_id,
							new_value:	new_status
						}
					})
					.always( function(answer,status) {
						if( status == 'success' ){
							var decoded = $.parseJSON( answer );
							if( decoded.status == 'good' ) {

								$selects.removeClass( 'selected' );
								$self.addClass( 'selected' );

							} else {
								alert( decoded.err_msg );
							}
						}
					})
				;
				return false;
			});
		});
	},
	_anketsListingCheckStatusEdit: function( ids, href ) {
		href.href += '&new_status='+ $('#ankets_new_status').val();
	},
	anketsRatingChange: function(value) {
		var $root = this;
		var anket_id = $root.attr( 'data-item-id' );

		$.ajax({
			url:	URI+'/lk/ajax/ankets-set-rating/',
			method:	'GET',
			data:	{
				item_id:	anket_id,
				new_value:	value
			}
		});
	},
	anketsInsert:	function() {
		$( 'input:file' ).jInputFile();
	},

	mediaControl:	function() {

		var filesToDelete = {};
		var updateFilesToDelete = function() {
			$( '#media_delete' ).val( JSON.stringify(filesToDelete) );
		}
		updateFilesToDelete();

		$('.js-media-control').map(function(){
			var $root_table = $( this );
			var $items = $root_table.find( '.js-media-item' );

			$items.map(function(){
				var $self = $( this );
				var file_id = $self.attr( 'data-item-id' );
				var $btn_delete = $self.find( '.js-media-delete' );
				var $btn_restore = $self.find( '.js-media-restore' );
				var $container_delete = $self.find( '.js-media-delete-container' );
				var $container_restore = $self.find( '.js-media-restore-container' );

				$btn_delete.click(function(){
					filesToDelete[ file_id ] = 1;
					updateFilesToDelete();

					$container_delete.hide();
					$container_restore.show();
					$self.addClass('to-delete');

					return false;
				});
				$btn_restore.click(function(){
					if( typeof(filesToDelete[ file_id ]) != 'undefined' ) {
						delete filesToDelete[ file_id ];
					}
					updateFilesToDelete();

					$container_delete.show();
					$container_restore.hide();
					$self.removeClass('to-delete');

					return false;
				});

			});

		});
	},

	common:		function() {

		// периодическое обновление статистики
		var $js_stat = $( '.js-stat' );
		setInterval(function(){
			$
				.ajax({
					url:	URI+'/lk/ajax/stat/'
				})
				.always( function(answer,status) {
					if( status == 'success' ){
						var decoded = $.parseJSON( answer );
						if( decoded.status == 'good' ) {

							$js_stat.map(function(){
								var $this = $( this );
								var stat_name = $this.attr( 'data-stat-name' );
								if( typeof(decoded.data[stat_name]) != 'undefined' ) {
									$this.html( decoded.data[stat_name] );
								}
							});

						} else {
							alert( decoded.err_msg );
						}
					}
				})
			;
		}, 3000 );

		var $submit, submit_status;
		$( '.js-form-submit' ).click(function(){
			$submit = $( this );
			$submit.hide();

			$( '.js-form-to-hide' ).hide().unvisible();
			$( '.form-loading-img' ).show().visible();

			if( $submit.attr('handler') ) {
				if( submit_status = submit[ $submit.attr('handler') ]() ) {
					return true;
				} else {
					$submit.show();
					$( '.js-form-to-hide' ).show().visible();
					$( '.form-loading-img' ).hide().unvisible();
					return false;
				}
			}
			else
				return true;
		});

		$( '.js-delete-item-confirm' ).click(function(){
			var confirm_text = 'Запись будет удалена, продолжить?';

			var try_confirm_text = $( this ).attr( 'confirm-text' );
			if( try_confirm_text )
			confirm_text = try_confirm_text;

			return confirm( confirm_text );
		});

		$( '.js-delete-items-confirm' ).click(function(){
			var confirm_text = 'Записи будут удалены, продолжить?';

			var try_confirm_text = $( this ).attr( 'confirm-text' );
			if( try_confirm_text )
			confirm_text = try_confirm_text;

			return confirm( confirm_text );
		});

		$( '.js-stop-propagation-click' ).click(function(e){
			e.stopPropagation();
		});

	},

	js_tpls:			function() {
		$( '.js-tbl-tpl' ).map(function(){
			$tbl_tpls[ $(this).attr('tpl-id') ] = $( this );
		});

		swig.setFilter('add', function(phrase, param) {
			return phrase += param;
		});
	},

	ratingChoose:	function() {

		$('.rating').map(function(){
			var $rating = $( this );

			var $input = $rating.find('.js-rating-input:first');
			var $lis = $rating.find('li');
			var $li = null;
			var $hookChange = get_func( $rating, 'data-change-hook' );
			var confirm_required = $rating.attr( 'data-confirm-text' );
			var $btn_rst = $rating.find( '.js-rating-reset' );
			var $btn_any = $rating.find( '.js-rating-any' );

			var selected_value = parseInt( $input.val() );
			var ratingDrawSelected = function() {

				if( selected_value > 0 ) {
					$lis.filter(':gt('+(parseInt(selected_value)-1).toString()+')').removeClass('selected');
					$lis.filter(':lt('+selected_value+')').addClass('selected');
				} else {
					$lis.removeClass('selected');
				}

				$input.val( selected_value );
			};
			ratingDrawSelected();

			var setSelectedValue = function(value) {
				selected_value = value;
				$hookChange.call( $rating, value );
			}

			$lis.map(function(){

				$li = $( this );
				var value = $li.attr( 'value' );

				$li
					.mouseenter(function(){

						$lis.filter(':gt('+value+')').removeClass('hover');
						$lis.filter(':lt('+value+')').addClass('hover');

						return false;
					})
					.mouseleave(function(){
						$lis.removeClass('hover');

						return false;
					})
					.click(function(){

						if( confirm_required && !confirm(confirm_required) ) {
							return false;
						}

						setSelectedValue( value );
						ratingDrawSelected();
						return false;
					})
				;
			});

			$btn_rst.click(function(){
				setSelectedValue(0);
				ratingDrawSelected();
				return false;
			});
			$btn_any.click(function(){
				setSelectedValue(-1);
				ratingDrawSelected();
				return false;
			});
		});

	},

	inlineViewers:function() {
		var $modal_content = $( '#basic-modal-content' );
		var modal_selector = '#simplemodal-container';

		// просмотр видео
		$( '.js-video-play' ).click(function() {
			var $img = $( this );
			var uri = $img.attr( 'data-video-uri' );

			$modal_content.empty().modal();
			var width = $modal_content.width();
			var height = $modal_content.parent().height();

			var $el = $('<video onloadstart="this.volume=0.5" width="400" height="300" controls="controls" poster="video/duel.jpg" autoplay="true"><source src="'+uri+'" type=\'video/webm; codecs="vp8, vorbis"\'>Тег video не поддерживается вашим браузером.<a href="video/duel.mp4">Скачайте видео</a>.</video>');

			$modal_content.append( $el );
			$( modal_selector ).addClass('modal-width-relative').center();

			return false;
		});

		$(document).bind('webkitfullscreenchange mozfullscreenchange fullscreenchange', function(e) {
			var state = document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen;
			var event = state ? 'FullscreenOn' : 'FullscreenOff';

			// при выходе из полноэкранного режима просмотра, центрируем модальное окно
			setTimeout( function(){ $( modal_selector ).center(); }, 0 );
			setTimeout( function(){ $( modal_selector ).center(); }, 50 );
		});

		// просмотр документов при помощи google docs
		$('.js-word').click(function (e) {
			var $a = $( this );

			// прорисовываем модальное окно, чтобы можно было получить его размеры
			$modal_content.empty().modal();
			var width = $modal_content.width();
			var height = $modal_content.parent().height();

			var $iframe = $(document.createElement('iframe'));
			$iframe.prop( 'src', $a.prop('href') );
			$iframe.prop( 'frameborder', '0' );
			$iframe.prop( 'width', width+'px' );
			$iframe.prop( 'height', height+'px' );

			// добавляем сгенерированный iframe
			$modal_content.append( $iframe )

			$( modal_selector ).removeClass('modal-width-relative');

			return false;
		});
	},

	autoComplete:	function() {

		$( '.js-autocomplete' ).map(function(){

			var $root			= $( this );
			var $input			= $root.find( '>.js-input:first' );
			var $cache			= $root.find( '>.js-cache:first' );
			var $draw_content	= $root.find( '>.js-draw-content:first' );
			var is_single		= parseInt($root.attr('single'));
			var is_table		= parseInt($root.attr('table'));
			var metka			= $root.attr( 'metka' );
			var ajax_handler	= 'search-author';

			var try_ajax_handler = $root.attr( 'ajax-handler' );
			if( typeof(try_ajax_handler) != 'undefined' && try_ajax_handler )
			ajax_handler = try_ajax_handler;

			init.tdata_selected[metka] = js_cache[ metka ];
			if( !init.tdata_selected[metka] )
			init.tdata_selected[metka] = {};

			if( is_table ) {
				var $tbl_tpl	= $root.find( '.js-tbl-tpl' );
				var tbl_tpl		= {};
				var tbl_tpl_parse = $tbl_tpl.val().replace(/[\r\n\t]/gim,'');
				var tbl_tpl_founded = {};

				var regexp = new RegExp('<block:(.*?)>(.*?)</block>','gim');
				var reg_protection = 0;

				for( var reg_protect = 0; reg_protect < 100;reg_protect++ ) {

					tbl_tpl_founded = regexp.exec( tbl_tpl_parse );
					if( !tbl_tpl_founded )
					break;

					tbl_tpl[ tbl_tpl_founded[1] ] = tbl_tpl_founded[2];
				}

				var table		= null;
				var data_tpl	= null;
				var vars		= $tbl_tpl.attr('vars').toString().split(';');
			}


			// global for this context!
			var i;

			var drawSelected = function( selected_id ){

				$draw_content.children().remove();

				if( !is_table ) {

					for( var id in init.tdata_selected[metka] )
					$draw_content.append( '<span class="del" item-id="'+id+'">'+init.tdata_selected[metka][id].title+'</span>' );

					$draw_content.children().click(function(){
						var id = $( this ).attr( 'item-id' );
						delete init.tdata_selected[metka][ id ];
						drawSelected();
						return false;
					});

				} else {

					table = $( '<table class="autocomplete-table">' );

					if( typeof(tbl_tpl.thead) != 'undefined' )
					table.append( $(tbl_tpl.thead) );

					if( typeof(tbl_tpl['tstatic-data-before']) != 'undefined' )
					table.append( tbl_tpl['tstatic-data-before'] );
					// drawing data
					data_tpl = tbl_tpl.tdata;
					if( typeof(tbl_tpl.tdata) != 'undefined' ) {
						var tpl_val = '';
						for( var id in init.tdata_selected[metka] ) {

							if( typeof(init.tdata_selected[metka][id].del) == 'undefined' )
								init.tdata_selected[metka][id].del = '';
							if( typeof(init.tdata_selected[metka][id].restore) == 'undefined' )
								init.tdata_selected[metka][id].restore = 'display:none;';

							var tpl_replaced = data_tpl;
							for( i = 0;i < vars.length;i++ ) {
								if( typeof(init.tdata_selected[metka][id][vars[i]]) != 'undefined' )
									tpl_val = init.tdata_selected[metka][id][vars[i]];
								else
									tpl_val = '';
								tpl_replaced = tpl_replaced.replace( new RegExp('%'+vars[i]+'%','gim'), tpl_val );

								init.tdata_selected[metka][id][vars[i]] = tpl_val;
							}

							table.append( $(tpl_replaced) );
						}
					}

					if( typeof(tbl_tpl['tstatic-data-after']) != 'undefined' )
					table.append( tbl_tpl['tstatic-data-after'] );

					$draw_content.append( table );

					$input = $root.find( '.js-input:first' );
					$input.jqEasySuggest(easy_params);
					$( '.js-datepicker' ).glDatePicker({
						timePostFix:	' 23:59:59'
					});

					// delete item
					$root.find( '.js-tbl-delete-item' ).click(function(){
						var id = $( this ).attr( 'data-id' );
						init.tdata_selected[metka][id].del = 'display:none;';
						init.tdata_selected[metka][id].restore = '';
						drawSelected();
						return false;
					});

					// restore item
					var trestore_id;
					$root.find( '.js-trestore .js-trestore-do' ).click(function(){
						trestore_id = $( this ).attr('data-id');

						init.tdata_selected[metka][trestore_id].del = '';
						init.tdata_selected[metka][trestore_id].restore = 'display:none;';
						drawSelected();
						return false;
					});

					// change item
					var tdata_id, tdata_row, $add_row;
					$root.find( '.js-autocomplete-additional-row' ).blur(function(){
						$add_row = $( this );
						tdata_id = $add_row.attr( 'data-id' );
						tdata_row = $add_row.attr( 'add-row' );

						init.tdata_selected[metka][ tdata_id ][ tdata_row ] = $add_row.val();

						$cache.val( $.toJSON(init.tdata_selected[metka]) );

					});

					$root.find( '.js-mouseover-modal' ).onmouseoverModal();

				}

				$cache.val( $.toJSON(init.tdata_selected[metka]) );

			}
			drawSelected();

			init.tdata_drawselected[ metka ] = drawSelected;

			var block_send = false;
			var easy_params = {
				es_offset_top:			5,
				gdata_callbackable:		true,
				get_data_func:			function( keyword, callback ) {

					if( block_send )
					return;

					block_send = true;

					var founded = new Array();
					$
						.ajax({
							url:	URI+'/lk/ajax/'+ajax_handler+'/',
							method:	'GET',
							data:	{
								keyword:	keyword,
								status:		'published'
							}
						})
						.always( function(answer,status) {

							block_send = false;

							if( status == 'success' ){

								var decoded = $.parseJSON(answer);

								if( decoded && decoded.status == 'good' ) {

									callback( founded = decoded.data );
								} else {
									callback( founded );
								}
							} else {
								callback( founded );
							}
						})
					;
				},

				renderer:	function( key, data ) {
					if( typeof(data.search_title) == 'undefined' )
					data.search_title = data.title;

					$.data( $root, data.id, data );

					return '<li item-id="' + data.id + '"><a href="#">' + data.search_title+ '</a></li>';
				},

				onselect: function( el ){

					var item_id = $( el ).attr('item-id');

					if( item_id && typeof(init.tdata_selected[metka][item_id]) == 'undefined' ) {

						if( is_single ) {
							init.tdata_selected[metka] = {};
							js_cache[metka] = {};
						}

						init.tdata_selected[metka][ item_id ] = js_cache[metka][item_id] = $.data( $root, item_id );
						drawSelected();
					}

					$input.val( '' );

					return false;
				}
			};

			$input.jqEasySuggest(easy_params);
		})
	},

	listFilters:	function() {

		update.filterWrapSized();

		var block_filter = function() {
			$( '.js-form-submit, .js-form-to-hide' ).hide().unvisible();
			$( '.form-loading-img' ).show().visible();
			$( '#filters-wrap' ).show();
		}

		$( '.js-form-submit' ).click(function(){
			block_filter();
			return true;
		});

		$( '.js-filter-reset' ).click(function(){
			block_filter();
			location.href = URI + '/' + module_name + '/' + lk_module + '/' + (typeof(submodule)!='undefined'?submodule+'/':'');
			return false;
		});

		$( '.js-filter-text' ).keydown(function(ev){
			if( ev.keyCode == 13 )
			$( '.js-form-submit' ).click();
		});

		$( '.js-filter-href' ).click(function(){
			block_filter();
		});

	},

	inlineEdit:		function() {

		// inline-редактирование в textarea
		$( '.js-inline-edit' ).map(function(){

			var $root = $( this );
			var ajax_url		= $root.find( '.js-inline-ajax-url:first' ).val();
			var item_id			= $root.find( '.js-inline-id:first' ).val();
			var $comment_html	= $root.find( '.js-inline-comment:first' );
			var $edit			= $root.find( '.js-inline-do-edit:first' );
			var $edit_container	= $root.find( '.js-inline-edit-container:first' );
			var $textarea		= $root.find( '.js-inline-value:first' );
			var $save			= $root.find( '.js-inline-do-save:first' );
			var $cancel			= $root.find( '.js-inline-do-cancel:first' );

			$edit.click(function(){

				$edit.hide();
				$comment_html.hide();
				$textarea.val( brToLf( $comment_html.html() ) );
				$edit_container.show();
				$textarea.select();

				return false;
			});

			$cancel.click(function() {

				$edit.show();
				$comment_html.show();
				$edit_container.hide();

				return false;
			});

			$textarea.keydown(function(ev){
				if( ev.keyCode == 13 )
				$save.click();

				if( ev.keyCode == 27 )
				$cancel.click();
			});

			var block_sends_comment = {};
			$save.click(function() {

				if( block_sends_comment[item_id] ) return false;
				block_sends_comment[ item_id ] = true;

				$
					.ajax({
						url:	ajax_url,
						method:	'GET',
						data:	{
							new_value:	$textarea.val(),
							item_id:	item_id
						}
					})
					.always( function(answer,status) {

						block_sends_comment[item_id] = false;

						if( status == 'success' ){

							var decoded = $.parseJSON( answer );

							if( decoded.status == 'good' ) {

								$comment_html.html( lfToBr(decoded.new_value) );
								$cancel.click();

							} else {
								alert( decoded.err_msg );
							}
						}
					})
				;

				return false;
			});

		});

		// inline-редактирование select
		$( '.js-inline-edit-select' ).map(function() {

			var $root				= $( this );
			var $select				= $root.find( '.inline-change-select:first' );
			var $select_container	= $root.find( '.inline-change-value-container:first' );
			var $change				= $root.find( '.inline-change-value:first' );
			var $save				= $root.find( '.inline-change-value-save:first' );
			var $cancel				= $root.find( '.inline-change-value-cancel:first' );
			var $text				= $root.find( '.inline-select-text:first' );
			var metka				= $root.attr( 'metka' );
			var ajax_handler		= $root.attr( 'ajax' );
			var item_id				= $root.attr( 'item-id' );
			var selected_value		= $select.attr( 'selected-value' );

			$change.click(function(){

				$change.hide();
				$text.hide();

				$select_container.show();

				$select.find( '> option[value="'+selected_value+'"]' ).attr( 'selected', true );
				$select.find( '> option[value!="'+selected_value+'"]' ).attr( 'selected', false );

				return false;
			});

			var block_send = false;
			$save.click(function() {

				var new_value = $select.val();
				if( new_value == selected_value ) {

					$cancel.click();

				} else {

					if( block_send ) return false;
					block_send = true;

					$
						.ajax({
							url:	ajax_handler,
							method:	'GET',
							data:	{
								new_value:	new_value,
								item_id:	item_id
							}
						})
						.always( function(answer,status) {

							block_send = false;

							if( status == 'success' ){

								var decoded = $.parseJSON( answer );

								if( decoded.status == 'good' ) {

									$text.html( $select.find('> option:selected:first').html() );

									$root.removeClass( 'inline-select-'+metka+'-'+selected_value );
									$root.addClass( 'inline-select-'+metka+'-'+new_value );

									selected_value = new_value;

									$cancel.click();
								} else {
									alert( decoded.err_msg );
								}
							}
						})
					;
				}

				return false;
			});

			$cancel.click(function() {

				$change.show();
				$text.show();
				$select_container.hide();

				return false;
			});
		});

	},

	multiSelect:	function( params ){
		var options = extend({
			highlight:	true
		}, params );

		var $select_all = $( '#multi_select_all' );
		var $selects = $( '.checkbox-multi' );

		var chbox_count = $selects.length;

		$select_all.click(function(){
			var state = $select_all.prop('checked');
			$selects.prop( 'checked', state );
		});

		$selects.click(function(ev){

			var chbox_count_checked = $selects.filter(':checked').length;

			$select_all.prop( 'checked', chbox_count_checked >= chbox_count );

			if( options.highlight ) {

				if( $(this).prop('checked') )
					$( this ).parent().parent().addClass( 'object_tr_selected' );
				else
					$( this ).parent().parent().removeClass( 'object_tr_selected' );
			}

		});

		// multi :: click on tr
		$( '.object_tr' )
			.click(function(ev){
				$( this ).find( 'td:first > .checkbox-multi:first' ).click();
			})
			.find('a').click(function(ev){
				ev.stopPropagation();
			})
		;

		// multi :: action
		$( '.js-multi-action' ).click(function(){

			var $this = $( this );

			var ids = $selects.filter(':checked').map(function(){
				return '&ids[]=' + $(this).attr( 'item-id' );
			}).get();

			var confirm_required = $this.attr('confirm-required');
			var confirm_message = $this.attr('confirm-message');

			if(
				ids.length	&&
				(
					!confirm_required ||
					confirm( confirm_message )
				)
			){
				var href = $this.attr( 'href' );
				$this.attr( 'href', href + ids.join('') );
				return true;
			}

			return false;
		});

	},

	multiDefault:	function(){

		// multi :: delete news
		$( '#multi_delete' ).click(function(){

			var confirm_text = 'Выделенные записи будут удалены, продолжить?';

			var try_confirm_text = this.getAttribute( 'confirm-text' );
			if( try_confirm_text )
			confirm_text = try_confirm_text;

			var $this = $( this );

			var ids = $( '.checkbox-multi:checked' ).map(function(){
				return '&ids[]=' + $( this ).attr( 'item-id' );
			}).get();

			if(
				ids.length &&
				confirm(confirm_text)
			){
				var href = $this.attr( 'href' );
				$this.attr( 'href', href + ids.join('') );
				return true;
			}

			return false;
		});

		// multi confirm universal
		$( '.multi_confirm' ).click(function(){

			var confirm_text = 'Подтвердите выполнение операции "'+this.innerHTML+'"';

			var try_confirm_text = this.getAttribute( 'confirm-text' );
			if( try_confirm_text )
			confirm_text = try_confirm_text;

			var $this = $( this );

			var id_list = new Array();
			var id = 0;
			var ids = $( '.checkbox-multi:checked' ).map(function(){
				id = $( this ).attr( 'item-id' );
				id_list.push( id );
				return '&ids[]=' + id;
			}).get();

			if(
				ids.length &&
				confirm(confirm_text)
			){

				var check_func = $this.attr( 'check-func' );
				if( check_func ) {
					check_func = getFunctionFromString( check_func );
					if( check_func !== false )
						check_func( id_list, this );
					else
						return false;
				}

				var href = $this.attr( 'href' );
				$this.attr( 'href', href + ids.join('') );
				return true;
			}

			return false;
		});

		// single confirm universal
		$( '.js-confirm' ).click(function(){

			var confirm_text = 'Подтвердите выполнение операции "'+this.innerHTML+'"';

			var try_confirm_text = this.getAttribute( 'confirm-text' );
			if( try_confirm_text )
			confirm_text = try_confirm_text;

			var $this = $( this );

			if(
				confirm(confirm_text)
			){

				var check_func = $this.attr( 'check-func' );
				if( check_func ) {
					check_func = getFunctionFromString( check_func );
					if( check_func !== false )
						check_func( this );
					else
						return false;
				}

				return true;
			}

			return false;
		});

	},

};

var update = {

	filterWrapSized:	function() {
		var $table = $( '#tbl_filter' );
		$( '#filters-wrap' ).width( $table.outerWidth() ).height( $table.outerHeight() );
	},

}

var submit = {


};

var draw = {

};
