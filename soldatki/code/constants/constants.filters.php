<?php
########################################################
#	constants.filters.php
#
#	Фильтры при выводе на сайте
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
$GLOBALS['LISTS']['filters'] = array(

	'on_page_default_lk'	=> array(
		'100'	=> '100',
		'70'	=> '70',
		'100'	=> '100'
	),
	'on_page_default'	=> array(
		'100'	=> '100',
		'30'	=> '30',
		'50'	=> '50'
	),
	'paginator_default'	=> array(
		'page'		=> array( 'type' => 'value', 'value' => 1),
		'on_page'	=> array( 'type' => 'first' ),
		'sort'		=> array( 'type' => 'first' ),
		'desc'		=> array( 'type' => 'value', 'value' => 1 )
	)

);

$GLOBALS['LISTS']['filters'] += array(

	'site'	=> array(

	),

	'lk' => array(

		'ankets'	=> array(
			'vars'	=> $GLOBALS['LISTS']['filters']['paginator_default'] + array(
				'status'		=> array( 'type' => 'value', 'value' => '' ),
				'text'			=> array( 'type' => 'value', 'value' => '' ),
				'id'			=> array( 'type' => 'value', 'value' => '' ),
				'rating'		=> array( 'type' => 'value', 'value' => '-1' ),
			),
			'on_page'	=> $GLOBALS['LISTS']['filters']['on_page_default_lk'],
			'sort'	=> array(
				'id'			=> '`items`.`id` DESC',
				'id-desc'		=> '`items`.`id` DESC',
				'id-asc'		=> '`items`.`id` ASC',
				'fio-asc'		=> '`items`.`last_name` DESC',
				'fio-desc'		=> '`items`.`last_name` ASC',
				'rating-asc'	=> '`items`.`rating` ASC',
				'rating-desc'	=> '`items`.`rating` DESC',
				'age-asc'		=> '`items`.`date_birthday` DESC',
				'age-desc'		=> '`items`.`date_birthday` ASC',
				'created-asc'	=> '`items`.`date_created` ASC',
				'created-desc'	=> '`items`.`date_created` DESC',
				'updated-asc'	=> '`items`.`date_updated` ASC',
				'updated-desc'	=> '`items`.`date_updated` DESC',
				'order'			=> '`items`.`order` DESC',
				'order-desc'	=> '`items`.`order` DESC',
				'order-asc'		=> '`items`.`order` ASC',
				'status-asc'	=> '`items`.`status` ASC',
				'status-desc'	=> '`items`.`status` DESC'
			)
		),
	),
);
#
########################################################
?>
