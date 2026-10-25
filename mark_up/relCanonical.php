<?
$can = false;
for($i=0; $i<100; $i++){
	if($_SERVER['REQUEST_URI'] == '/portfolio/?cat='.$i)
		{ echo '<link rel="canonical" href="'.get_bloginfo('url').'/portfolio/" />'; $can = true; }

	if($_SERVER['REQUEST_URI'] == '/blog/'.$i.'/')
		{ echo '<link rel="canonical" href="'.get_bloginfo('url').'/blog/" />'; $can = true; }
}
if ($can == false) {
	echo '<link rel="canonical" href="'.get_bloginfo('url').$_SERVER['REQUEST_URI'].'" />';
}