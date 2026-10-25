
$(function(){

	var $submit = $( '#js-form-submit' );

	$('#anket_form').submit(function(){
		$( '.js-loading' ).show();
		$submit.parent().addClass( 'disabled' );
	});

	$('.button-collapse').sideNav();

	$('.datepicker').pickadate({
		monthsFull: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
		monthsShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
		weekdaysFull: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
		weekdaysShort: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
		showWeekdaysFull: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
		labelMonthNext: 'Следующий месяц',
		labelMonthPrev: 'Предыдущий месяц',
		labelMonthSelect: 'Месяц',
		labelYearSelect: 'Год',
		format: 'dd/mm/yyyy',
		firstDay: 1,
		today: '',
		clear: '',
		close: '',
		closeOnSelect: true,

		maxYearsSelectable: null,
	    selectYears: true,
	    selectMonths: true,

	    min: new Date(1970, 01 - 1, 01),
	    max: moment().subtract(7, 'years').toDate()
	});

	$( '.chip' ).click(function(){
		$( '#citizenship' ).val( $(this).text() );
		Materialize.updateTextFields();
		return false;
	});

	var drawUploadedFiles = function() {
		for( var group_id in uploadedFiles ) {
			var $container = $( '#files-list-'+group_id );
			if( $container.length ) {
				var files = uploadedFiles[ group_id ];
				if( count(files) ) {
					for( var file_id in files ) {
						var file = files[ file_id ];

						var $file_container = $( '#file-'+file_id );
						if( !$file_container.length ) {
							var $el = $( '<div>' );
							$el.prop( 'id', 'file-'+file_id );

							// кнопка удаления
							var $btn_del = $( '<img>' );
							$btn_del.addClass( 'button-delete' );
							$btn_del.prop( 'src', URI+'/assets/images/cancel.png' );
							$btn_del.data( 'file', file );
							$el.append( $btn_del );

							// картинка
							var $img = $('<img>');
							$img.addClass( 'file-preview' );
							if( file.type == 'image' ) {
								$img.prop( 'src', file.uri );
							}
							if( file.type == 'video' ) {
								if( file.thumb_uri ) {
									$img.prop( 'src', file.thumb_uri );
								} else {
									$img.prop( 'src', URI+'/assets/images/stub/video.png' );
								}
							}
							$el.append( $img );

							$btn_del.click(function(){
								var file = $( this ).data( 'file' );
								if( confirm('Файл будет удален, продолжить?') ) {
									$
										.ajax({
											url:	URI+'/ajax/ankets-delete-file/',
											method:	'GET',
											data:	{
												group:		file.group,
												item_id:	file.id
											}
										})
										.always( function(answer,status) {
											if( status == 'success' ){
												var decoded = $.parseJSON( answer );
												if( decoded.success ) {

													$( '#file-'+file.id ).fadeOutAndRemove();
													delete uploadedFiles[ file.group ][ file.id ];
													drawUploadedFiles();

												} else {
													alert( decoded.msg );
												}
											}
										})
									;
								}
								return false;
							});

							$container.append( $el );
						}
					}
					$container.fadeIn();
				} else {
					$container.fadeOut();
				}
			}
		}
	}
	drawUploadedFiles();

	$( '.js-file-upload' ).map(function(){
		var $self = $( this );

		var $btn = $self.find('.btn:first');
		var $loading = $self.find( '.progress' );
		var $file = $self.find( 'input[type="file"]:first' );

		var uploader = new ss.SimpleUpload({
			button: $btn.get(0),
			url: URI+'/ajax/ankets-upload-file/?group='+$self.attr('data-file-group'),
			name: 'uploadfile',
			multipart: true,
			hoverClass: 'hover',
			focusClass: 'focus',
			responseType: 'json',
			accept: $file.prop('accept'),
			// debug: true,
			startXHR: function() {},
			onSubmit: function() {
				$submit.parent().addClass( 'disabled' );
				$btn.addClass('disabled');
				$loading.show();
			},
			onComplete: function( filename, response ) {
				$submit.parent().removeClass( 'disabled' );
				$btn.removeClass('disabled');
				$loading.hide();

				if( response.success ) {
					if( typeof(response.file) != 'undefined' ) {
						uploadedFiles[ response.file.group ][ response.file.id ] = response.file;
						drawUploadedFiles();
					}
				} else {
					if( response.msg ) {
						alert( response.msg );
					}
				}
			},
			onError: function( data, response ) {
				$submit.parent().removeClass( 'disabled' );
				$btn.removeClass('disabled');
				$loading.hide();
				alert( 'произошла ошибка при загрузке файла: '+response );
			}
		});

	});

});
