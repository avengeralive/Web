<?php
/**
 * Search Form template
 *
 * @package MOKO
 * @author Noor Tech
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Restricted' );
}
?>

<form method="post" action="blog.html">
	<div class="form-group">
		<input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr__( 'Search Here', 'moko' ); ?>">
		<button type="submit"><i class="fa fa-search"></i></button>
	</div>
</form>
