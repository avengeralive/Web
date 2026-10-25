<?php
########################################################
#	system.fupload.php
#
#	Системный модуль - обработчик загруженных файлов
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.10.31 - файл создан
#
########################################################
#
	define( 'ERR_PHP_UPLOAD',       1 );		# ошибка загрузки файла на уровне сервера
	define( 'ERR_SIZE_LIMIT',       2 );		# недопустимый размер файла
	define( 'ERR_ACCESS',           3 );		# ошибка доступа
	define( 'ERR_NO_PARAM_FOUND',	4 );		# файл для обработки не найден
	define( 'ERR_WRONG_EXT',		5 );		# недопустимое расширение
	define( 'ERR_EMPTY_EXT',		6 );		# пустое расширение
	define( 'ERR_POST_MAX_SIZE',	7 );
#
########################################################
#
	if( !defined('UPLOAD_ERR_CANT_WRITE') )
	define( 'UPLOAD_ERR_CANT_WRITE', 7 );

	if( !defined('UPLOAD_ERR_EXTENSION') )
	define( 'UPLOAD_ERR_EXTENSION', 8 );

	if( !defined('LIMIT_UPLOAD_SIZE') )
	define( 'LIMIT_UPLOAD_SIZE', 2000000 );

	if( !defined('IMG_JPEG_QUALITY') )
	define( 'IMG_JPEG_QUALITY', 80 );

	if( !defined('IMG_SMALL_W') )
	define( 'IMG_SMALL_W', 1024 );

	if( !defined('IMG_SMALL_H') )
	define( 'IMG_SMALL_H', 768 );

	if( !defined('PREVIEW_RATIO') )
	define( 'PREVIEW_RATIO', 1.0 );

	if( !defined('PREVIEW_PROCENT_WIDTH') )
	define( 'PREVIEW_PROCENT_WIDTH', 100 );
#
########################################################
#
	define( 'IMG_CREATE_NO_RESIZE',				1 << 0 );
	define( 'IMG_CREATE_SMALLING',				1 << 1 );
	define( 'IMG_CREATE_INTERPOLATION',			1 << 2 );
	define( 'IMG_CREATE_KVADRAT',				1 << 3 );
	define( 'IMG_CREATE_CROP',					1 << 4 );
	define( 'IMG_RETURN_BLOB',					1 << 5 );
	define( 'IMG_CREATE_PNG',					1 << 6 );
#
########################################################

class SYSTEM_fupload	{

	// https://en.wikipedia.org/wiki/List_of_file_formats
	var $image_exts = array(
		'jpg'	=> 1,
		'jpeg'	=> 1,
		'gif'	=> 1,
		'bmp'	=> 1,
		'png'	=> 1
	);
	var $video_exts = array(
		'aaf'	=> 1,	'3gp'	=> 1,	'asf'	=> 1,
		'avchd'	=> 1,	'avi'	=> 1,	'bik'	=> 1,
		'cam'	=> 1,	'collab'	=> 1,	'dat'	=> 1,
		'dsh'	=> 1,	'flv'	=> 1,	'm1v'	=> 1,
		'm2v'	=> 1,	'fla'	=> 1,	'flr'	=> 1,
		'sol'	=> 1,	'm4v'	=> 1,	'mkv'	=> 1,
		'wrap'	=> 1,	'mov'	=> 1,	'mpeg'	=> 1,
		'mpg'	=> 1,	'mpe'	=> 1,	'thp'	=> 1,
		'rm'	=> 1,	'svi'	=> 1,	'wmv'	=> 1,
		'webm'	=> 1,	'mp4'	=> 1
	);
	var $doc_exts = array(
		'docx'	=> 1,
		'doc'	=> 1,
		'xls'	=> 1,
		'xlsx'	=> 1,
		'ppt'	=> 1,
		'pptx'	=> 1,
		'odt'	=> 1
	);

	function _init() {
		$this->IMG_SMALL_W = IMG_SMALL_W;
		$this->IMG_SMALL_H = IMG_SMALL_H;

		$this->lang = &$this->engine->lang;
	}

	function init_index( $index, $subindex = null )	{

		$this->INDEX	= $index;
		$this->file_index = 0;

		// single to multi hack
		if( empty($subindex) ) {
			$this->file_p	= array(
				'name'		=> array( $_FILES[ $index ]['name'] ),
				'type'		=> array( $_FILES[ $index ]['type'] ),
				'tmp_name'	=> array( $_FILES[ $index ]['tmp_name'] ),
				'error'		=> array( $_FILES[ $index ]['error'] ),
				'size'		=> array( $_FILES[ $index ]['size'] )
			);
		} else {
			$this->file_p	= array(
				'name'		=> array( $_FILES[ $index ]['name'][ $subindex ] ),
				'type'		=> array( $_FILES[ $index ]['type'][ $subindex ] ),
				'tmp_name'	=> array( $_FILES[ $index ]['tmp_name'][ $subindex ] ),
				'error'		=> array( $_FILES[ $index ]['error'][ $subindex ] ),
				'size'		=> array( $_FILES[ $index ]['size'][ $subindex ] )
			);
		}

		$this->_generateDefaultVars();

	}

	function init_indexes( $ph_index, $arr_index, $subindex = null )	{

		$this->INDEX	= $ph_index;

		$this->file_p	= &$_FILES[ $ph_index ];
		$this->file_index = $arr_index;

		$this->_generateDefaultVars();
	}

	function _generateDefaultVars()	{

		$this->ERR_CODE	= 0;

		if( isset($this->file_p['name'][$this->file_index]) )
			$this->FNAME = $this->file_p['name'][$this->file_index];
		else
			$this->FNAME = '';

		if( isset($this->file_p['size'][$this->file_index]) )
			$this->FSIZE = $this->file_p['size'][$this->file_index];
		else
			$this->FSIZE = 0;

		if( isset($this->file_p['tmp_name'][$this->file_index]) )
			$this->FPATH = $this->file_p['tmp_name'][$this->file_index];
		else
			$this->FPATH = '';

		$this->generate_extension();
	}

	var $action_get = 'do_upl';
	function check_errors()	{

		$checks = array();
		$args = func_get_args();
		$count = count( $args );
		for( $i = 0;$i < $count;$i++ )
		$checks[ $args[$i] ] = true;

		if( empty($checks) )
		$checks[ 'default-checks' ] = true;

		if(
			isset($checks['default-checks']) &&
			!isset($this->file_p)
		){
			$this->ERR_CODE = ERR_NO_PARAM_FOUND;
			return 0;
		}

		if(
			isset($checks['default-checks']) &&
			$this->file_p[ 'error' ][ $this->file_index ]
		){
			$this->ERR_CODE = ERR_PHP_UPLOAD;
			return 0;
		}

		// custom checks

			// is image check
			if(
				isset($checks['image-check'])	&&
				!$this->isImage()
			){
				if( $this->empty_ext )
					$this->ERR_CODE = ERR_EMPTY_EXT;
				else
					$this->ERR_CODE = ERR_WRONG_EXT;
				return 0;
			}

			// is video check
			if(
				isset($checks['video-check'])	&&
				!$this->isVideo()
			){
				if( $this->empty_ext )
					$this->ERR_CODE = ERR_EMPTY_EXT;
				else
					$this->ERR_CODE = ERR_WRONG_EXT;
				return 0;
			}

			// is doc check
			if(
				isset($checks['doc-check'])	&&
				!$this->isDoc()
			){
				if( $this->empty_ext )
					$this->ERR_CODE = ERR_EMPTY_EXT;
				else
					$this->ERR_CODE = ERR_WRONG_EXT;
				return 0;
			}

			// is pdf check
			if(
				isset($checks['pdf-check'])	&&
				!$this->isPdf()
			){
				if( $this->empty_ext )
					$this->ERR_CODE = ERR_EMPTY_EXT;
				else
					$this->ERR_CODE = ERR_WRONG_EXT;
				return 0;
			}

			// check for post_max_size
			if(
				isset($checks['post-max-size']) &&
				isset($_GET[$this->action_get])	&&
				!isset($_FILES['images'])
			){
				$this->ERR_CODE = ERR_POST_MAX_SIZE;
				return 0;
			}

		return 1;

	}

	function get_err_msg( $custom_err_code = 0 )	{

		if( $custom_err_code )
			$err_code = $custom_err_code;
		else
			$err_code = $this->ERR_CODE;

		$fname = empty($this->FNAME) ? '' : '['.$this->FNAME.'] ';

		switch( $err_code )	{

			case 0:
				return $fname. 'файл загружен успешно, но по какой-то причине попал в ветку ошибок';

			case ERR_NO_PARAM_FOUND:
				return $fname. 'не найден файл, возможно размер файла слишком большой';

			case ERR_PHP_UPLOAD:
				return $this->get_server_error($fname);

			case ERR_SIZE_LIMIT:
				return $fname. 'превышен лимит размера файла в '.parsize( LIMIT_UPLOAD_SIZE );

			case ERR_WRONG_EXT:
				return $fname. 'недопустимое расширение файла';

			case ERR_EMPTY_EXT:
				return $fname. 'пустое расширение файла';

			case ERR_POST_MAX_SIZE:
				return $this->get_server_error( $fname, UPLOAD_ERR_FORM_SIZE );

			default:
				return $fname. 'неизвестная ошибка';

		}

		return 0;
	}


	function get_server_error( $fname='', $custom_err_code=0 )	{

		if( $custom_err_code )
			$err_code = $custom_err_code;
		else
			$err_code = $this->file_p[ 'error' ][ $this->file_index ];

		switch( $err_code )	{
			case UPLOAD_ERR_INI_SIZE:
				$max_size = init_get('upload_max_filesize');
				if( !empty($max_size) )
				$max_size = ' ('. $max_size .')';

				return $fname. $this->lang->t('fupl_serr_size_exceed'). $max_size;

			case UPLOAD_ERR_FORM_SIZE:
				$max_size = ini_get( 'post_max_size' );
				if( !empty($max_size) )
				$max_size = ' ('. $max_size .')';

				return $fname. $this->lang->t('fupl_serr_size_exceed_form') .$max_size;

			case UPLOAD_ERR_PARTIAL:
				return $fname. $this->lang->t('fupl_serr_partial');

			case UPLOAD_ERR_NO_FILE:
				return $fname. $this->lang->t('fupl_serr_empty_file');

			case UPLOAD_ERR_NO_TMP_DIR:
				return $fname. $this->lang->t('fupl_serr_no_tmpdir');

			case UPLOAD_ERR_CANT_WRITE:
				return $fname. $this->lang->t('fupl_serr_save_tmpfile');

			case UPLOAD_ERR_EXTENSION:
				return $fname. 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help';

			default:
				return $fname. $this->lang->t('fupl_serr_unknown');
		}

	}
	/*
		$_FILES[ INDEX ] = array(
			name		- имя загруженного файла, которое было на стороне клиента
			type		- тип файла (например, text/html)
			tmp_name	- путь до файла во временной директории (например, z:\tmp\php00.tmp
			error		- код ошибки (0, если ошибки нет)
			size		- размер файла в байтах
	*/

	function save_tmp( $save_path )	{

		if( !empty($this->FPATH) )
			if( copy( $this->FPATH, $save_path ) )
				return 1;
			else
				return 0;
		else
			return 0;

	}

	var $FEXT			= "";
	var $FNAME_NOEXT	= '';
	function generate_extension()	{
		$this->FEXT = "";
		$len = strlen( $this->FNAME ) - 1;

		$buffer = "";

		for($i = $len;$i+1;$i-- )
			if( $this->FNAME[$i] == "." )
				break;
			else
				$buffer .= $this->FNAME[$i];

		if( (strlen($buffer) - 1) == $len )
			$buffer = ""; // не найден символ точки
		else{
			$this->FEXT = strrev( strtolower($buffer) );

			$exploded = explode( '.'.$this->FEXT, $this->FNAME );
			unset( $exploded[ count($exploded)-1 ] );
			$this->FNAME_NOEXT = implode( '.'.$this->FEXT ,$exploded);
		}

		if( empty($buffer) )
			return 0;
		else
			return 1;
	}

	function isImage()	{
		$this->empty_ext = false;
		if( empty($this->FEXT) ){
			$this->empty_ext = true;
			return false;
		}

		if( isset($this->image_exts[$this->FEXT]) )
		return true;

		return false;
	}

	function isVideo()	{
		$this->empty_ext = false;
		if( empty($this->FEXT) ){
			$this->empty_ext = true;
			return false;
		}

		if( isset($this->video_exts[$this->FEXT]) )
		return true;

		return false;
	}

	function isDoc()	{
		$this->empty_ext = false;
		if( empty($this->FEXT) ){
			$this->empty_ext = true;
			return false;
		}

		if( isset($this->doc_exts[$this->FEXT]) )
		return true;

		return false;
	}

	function isPdf() {

		$this->empty_ext = false;
		if( empty($this->FEXT) ){
			$this->empty_ext = true;
			return false;
		}

		if( $this->FEXT != 'pdf' )
		return false;

		$pFile = fopen( $this->FPATH, 'r' );
		$status = fread( $pFile, 4 ) == '%PDF';
		fclose( $pFile );

		return $status;

	}

	var $last_w = 0;
	var $last_h = 0;
	var $PREVIEW_RATIO = PREVIEW_RATIO;
	function create_jpg( $name_big, $name_small, $max_x, $max_y, $CONF = 0 )	{

		if( !EXT_LOADED_GD ) return 0;

		list($x, $y, $t, $attr) = @getimagesize( $name_big );

		switch( $t )	{

			case IMAGETYPE_GIF:		$big = @imagecreatefromgif( $name_big );break;
			case IMAGETYPE_JPEG:	$big = @imagecreatefromjpeg( $name_big );break;
			case IMAGETYPE_PNG:		$big = @imagecreatefrompng( $name_big );break;
			case IMAGETYPE_BMP:		$big = imagecreatefrombmp( $name_big );break;

			default: return 0;
		}

		$xs = $x;
		$ys = $y;
		if( $CONF & IMG_CREATE_NO_RESIZE );		// не менять разрешение изображения
		else
		{
			if(
				($CONF & IMG_CREATE_INTERPOLATION	&& ($x < $max_x || $y < $max_y)) ||		// увеличение размера, если картинка маленькая
				($CONF & IMG_CREATE_SMALLING		&& ($x > $max_x || $y > $max_y))		// уменьшение размера, если картинка большая
			)
				if( $x <= $y )
				{
					$ys = $max_y;
					$xs = $max_y / ($y/$x);

					if( $xs > $max_x )
					{
						$ys = $max_x / ($xs/$ys);
						$xs = $max_x;
					}
				}
				else
				{
					$xs = $max_x;
					$ys = $max_x / ($x/$y);

					if( $ys > $max_y )
					{
						$xs = $max_y / ($ys/$xs);
						$ys = $max_y;
					}
				}

			if( $CONF & IMG_CREATE_KVADRAT )	// оквадрачивание картинки
			{
				if( $xs < $ys ) $xs = $ys;
				if( $ys < $xs ) $ys = $xs;
			}
		}

		if( $CONF & IMG_CREATE_CROP ){
			$old_y = $y;
			$old_x = $x;

			$xs = $x = (int) $x / 100 * PREVIEW_PROCENT_WIDTH;
			$ys = $y = (int) $x * $this->PREVIEW_RATIO;

			// img kolbasa fix
			if( $old_y < $ys ){
				for( $i = $old_x-1; $i; $i-- ){
					$xs = $x = (int) $i;
					$ys = $y = (int) $i * $this->PREVIEW_RATIO;

					if( $old_y >= $ys )
					break;
				}
			}

		}


		$small = @imagecreatetruecolor( $xs, $ys );
		@imagecopyresampled( $small, $big, 0, 0, 0, 0, $xs, $ys, $x, $y );

		@imagedestroy( $big );

		if( $CONF & IMG_CREATE_CROP ) {

			$w = imagesx( $small );
			$h = imagesy( $small );

			if( $w > $this->IMG_SMALL_W || $h > $this->IMG_SMALL_H ) {

				if( $w > $this->IMG_SMALL_W ) {
					$w = $this->IMG_SMALL_W;
					$h *= $this->IMG_SMALL_W / $w;
				}

				if( $h > $this->IMG_SMALL_H ) {
					$h = $this->IMG_SMALL_H;
					$w *= $this->IMG_SMALL_H / $h;
				}

				$small2 = @imagecreatetruecolor( $w, $h );

				@imagecopyresampled(
					$small2, $small,
					0, 0,
					0, 0,
					$w, $h,
					imagesx($small), imagesy($small)
				);
				$small = $small2;
			}

		}

		if( $CONF & IMG_RETURN_BLOB ) {
			ob_start();

			if( $CONF & IMG_CREATE_PNG ) {
				@imagepng( $small, NULL, 3 );
			} else {
				@imagejpeg( $small, NULL, IMG_JPEG_QUALITY );
			}
			return ob_get_clean();
		}


		if( $CONF & IMG_CREATE_PNG ) {
			$create_result = @imagepng($small, $name_small, 3);
		} else {
			$create_result = @imagejpeg($small, $name_small, IMG_JPEG_QUALITY);
		}

		if( $create_result )
		{
			$this->last_w = (int) $xs;
			$this->last_h = (int) $ys;

			@imagedestroy( $small );
			return 1;
		}

		@imagedestroy( $small );
		return 0;

	}

}

?>
