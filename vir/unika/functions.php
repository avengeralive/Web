<?
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array(
	'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
) );
add_theme_support( 'post-formats', array(
	'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
) );
add_theme_support( 'custom-logo', array(
	'height'      => 248,
	'width'       => 248,
	'flex-height' => true,
) );

function ring()
{
	$to = get_bloginfo('admin_email');
	$subject = 'Сообщение с сайта';
	$message = '
Имя: '.$_POST['form-name'].'<br>
E-mail: '.$_POST['form-email'].'<br>
Комментарий: '.$_POST['form-message'];
	$headers = 'Content-Type: text/html; charset=UTF-8';
	if (mail($to, $subject, $message, $headers)) echo "true";
	return true;
}

add_action( 'admin_post_nopriv_ring', 'ring' );
add_action( 'admin_post_ring', 'ring' );
?>