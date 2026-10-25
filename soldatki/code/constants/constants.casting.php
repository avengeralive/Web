<?php
########################################################
#	constants.casting.php
#
#	Константы бизнес-логики
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.07 - файл создан
#
########################################################
#
	define( 'CASTING_RATING_MAX',			5 );
	define( 'URL_GDOCS_VIEW',				'//docs.google.com/gview?url=' );
	define( 'ANKET_CONTACT_EMAIL',			'support@model2018.ru' );

	// отображаемая заглушка конвертируемого файла
	define( 'ANKET_STUB_URI',				URI.'/assets/images/stub/' );
	define( 'ANKET_STUB_URI_DEFAULT',		ANKET_STUB_URI+'image.png' );
#
########################################################
#
	$GLOBALS['LISTS'] += array(
		'ankets' => array(
			'statuses'			=> array(
				'active'		=> 'отправлена',
				'moderating'	=> 'не отправлена',
				'blocked'		=> 'заблокирована'
			),
			'files_groups'	=> array(
				'photos'	=> array(
					'title'			=> 'Фотографии',
					'max_items'		=> 3,
					'max_width'		=> 1000,
					'max_height'	=> 1000,
					'form_accept'	=> 'image/jpeg',
					'type'			=> 'image',
					'check_type'	=> 'image-check',
					'public'		=> true,
				),
				'videos'	=> array(
					'title'			=> 'Видео',
					'max_items'		=> 3,
					'max_size'		=> 1 * 1024 * 1024, // 1Gb,
					'form_accept'	=> 'video/*',
					'type'			=> 'video',
					'check_type'	=> 'video-check',
					'public'		=> true,

					'conv_tpls'		=> array(
						'thumb.orig' => true,
						'webm.orig' => true
					)
				),
				'docs'	=> array(
					'title'			=> 'Документы',
					'max_items'		=> 10,
					'form_accept'	=> '.doc,.docx,.pdf',
					'type'			=> 'doc',
					'check_type'	=> 'doc-check',
					'public'		=> false
				),
			),

			'conv_states'	=> array(
				'unprocessed'	=> 'не обработано',
				'processing'	=> 'в обработке',
				'processed'		=> 'обработано'
			),
			'conv_tpl'	=> array(
				'1'	=> array(
					'name'	=> 'thumb.orig',
					'ext'	=> 'jpg',
					'type'	=> 'thumb',
					'stub'	=> 'image.png'
				),
				'2'	=> array(
					'name'	=> 'webm.orig',
					'type'	=> 'webm',
					'ext'	=> 'webm',
					'stub'	=> 'video.png'
				)
			),
			'conv_tpl_index'	=> array(
				'thumb.orig'	=> '1',
				'webm.orig'		=> '2'
			),

			'citizenships'	=> array( 'Россия', 'другое', 'Украина', 'Белоруссия', 'Казахстан', 'США', 'Германия' )
		),
	);
#
########################################################
?>
