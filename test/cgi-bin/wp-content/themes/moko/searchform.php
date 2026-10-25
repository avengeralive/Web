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

<!-- Search -->
<div class="search-box">
	<form method="get" action="<?php echo esc_url(home_url('/')); ?>">
		<div class="form-group">
			<input type="search" name="s" placeholder="<?php echo esc_attr__( 'Search Here', 'moko' ); ?>">
			<button type="submit"><span class="icon fa fa-search"></span></button>
		</div>
	</form>
</div>
