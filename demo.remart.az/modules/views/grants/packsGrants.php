<?php
echo '<form name="params_form" id="params_form" method="post">';
echo '<input type="hidden" name="type" id="type" value="'.$request->parameters['object_type'].'"/>';
echo '<input type="hidden" name="resource_type" id="resource_type" value="packs"/>';
echo '<input type="hidden" name="object_id" id="object_id" value="'.$request->parameters['object_id'].'"/>';
echo '</form>';
echo '<form name="roles_form" id="roles_form" role="form" class="form-horizontal" method="post">';
echo '</form>';

echo '<h2>Packs:</h2><hr>';
echo '<form name="grants_form" id="grants_form" role="form" class="form-horizontal" method="post">';

foreach ($packs as $pack)
{
	echo '<h3>'.$pack['name'].'</h3>';
	foreach ($pack['children'] as $subpack)
	{
		$checked = '';	
		if ($subpack->is_checked == 1)
			$checked = 'checked';	
		echo '<div class="row"><div class="col-xs-10 col-xs-offset-2"><input type="checkbox" id="grant_'.$subpack->id.'" name="grant['.$subpack->id.']" value="1" '.$checked.'/>'.$subpack->name.'</div></div>';
		
	}
}
echo '</form>';

?>