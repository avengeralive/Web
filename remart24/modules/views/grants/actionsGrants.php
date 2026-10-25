<script type="text/javascript" charset="utf-8">
	$('.check_all').click(function(e)
	{
		if ($(this).data('resource'))
			$("#grants_form input[data-resource="+$(this).data('resource')+"]").prop('checked', $(this).prop('checked'));
		else		
			$("#grants_form input[data-target="+$(this).data('target')+"]").prop('checked', $(this).prop('checked'));
	});
</script>
<form name="params_form" id="params_form" method="post">
<input type="hidden" name="type" id="type" value="<?php echo $request->parameters['object_type']; ?>"/>
<input type="hidden" name="resource_type" id="resource_type" value="actions"/>
<input type="hidden" name="object_id" id="object_id" value="<?php echo $request->parameters['object_id']; ?>"/>
</form>
<form name="roles_form" id="roles_form" role="form" class="form-horizontal" method="post"></form>

<h1>Actions grants</h1>
<form name="grants_form" id="grants_form" role="form" class="form-horizontal" method="post">
<?php
echo '<table class="table table-hover">';
echo '<thead><tr>';
echo '<th>Grant name</th><th><input type="checkbox" data-target="POST" id="post_check_all" class="check_all" value="1" /> Create</th>';
echo '<th><input type="checkbox" data-target="GET" id="get_check_all" class="check_all" value="1" /> Read</th>';
echo '<th><input type="checkbox" data-target="PUT" id="put_check_all" class="check_all" value="1" /> Update</th>';
echo '<th><input type="checkbox" data-target="DELETE" id="delete_check_all" class="check_all" value="1" /> Delete</th>';
echo '</tr></thead>';
$old_res_name = '';

foreach ($grants as $resource_name=>$actions)
{
	echo '<tr class="info">';
	echo '<td><h3>'.$resource_name.'</h3></td>';
	echo '<td><input type="checkbox" data-target="POST" data-resource="POST_'.$resource_name.'" id="post_check_all" class="check_all" value="1" /> Create</td>';
	echo '<td><input type="checkbox" data-target="GET" data-resource="GET_'.$resource_name.'" id="get_check_all" class="check_all" value="1" /> Read</td>';
	echo '<td><input type="checkbox" data-target="PUT" data-resource="PUT_'.$resource_name.'" id="put_check_all" class="check_all" value="1" /> Update</td>';
	echo '<td><input type="checkbox" data-target="DELETE" data-resource="DELETE_'.$resource_name.'" id="delete_check_all" class="check_all" value="1" /> Delete</td>';
	echo '</tr>';
	foreach ($actions as $action_name=>$grant)
	{
		echo '<tr>';
		echo '<td>'.$action_name.'</td>';
	
		$checked = '';
		if ($grant['POST']->is_checked == 1)
			$checked = 'checked';
		echo '<td><input type="checkbox" data-target="POST" data-resource="POST_'.$resource_name.'" id="grant_'.$grant['POST']->id.'" name="grant['.$grant['POST']->id.']" '.$checked.' value="1" /></td>';
		$checked = '';
		if ($grant['GET']->is_checked == 1)
			$checked = 'checked';
		echo '<td><input type="checkbox" data-target="GET" data-resource="GET_'.$resource_name.'" id="grant_'.$grant['GET']->id.'" name="grant['.$grant['GET']->id.']" '.$checked.' value="1" /></td>';
		$checked = '';
		if ($grant['PUT']->is_checked == 1)
			$checked = 'checked';
		echo '<td><input type="checkbox" data-target="PUT" data-resource="PUT_'.$resource_name.'" id="grant_'.$grant['PUT']->id.'" name="grant['.$grant['PUT']->id.']" '.$checked.' value="1" /></td>';
		$checked = '';
		if ($grant['DELETE']->is_checked == 1)
			$checked = 'checked';
		echo '<td><input type="checkbox" data-target="DELETE" data-resource="DELETE_'.$resource_name.'" id="grant_'.$grant['DELETE']->id.'" name="grant['.$grant['DELETE']->id.']" '.$checked.' value="1" /></td>';
	
		echo '</tr>';
	}
}
echo '</table>';

?>
</form>