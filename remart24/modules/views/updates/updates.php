<?php
require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/header.php');
require_once(Backstage::gi()->MODULES_DIR.'views/admin/navigation.php');
echo '<div class="container">';

if(isset($data['error']) && !empty($data['error'])){
	echo '<h1><span style="color:red">'.$data['error'].'</span></h1>';
}else{
echo '<h1>'.Translations::gi()->update.'</h1>';
echo '<hr/>';

if(isset($data['success']) && !empty($data['success'])){
	echo '<h1><span style="color:green">'.$data['success'].'</span></h1>';
}

if(isset($data['current_version']) && !empty($data['current_version'])){
	echo '<h3>Current version: <span style="color:red">'.$data['current_version']->version.'</span></h3>';
}

	if(isset($data['versions']) && !empty($data['versions'])){
	?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Version</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

	<?php
		foreach ($data['versions'] as $value) {
			echo '<tr><td>'.$value['name'].'</td>';

			echo '<td>';

			if (version_compare($data['current_version']->version , $value['name']) < 0) {
				echo '<a href="'.Backstage::gi()->portal_url.'updates/form?name='.$value['name'].'&new_commit='.$value['hash'].'&last_commit='.$data['current_version']->hash.'"><button type="button" class="btn btn-primary">Update</button></a>';

			}
			echo '</td></tr>';			
		}			
	?>
			</tbody>
		</table>
	<?php
	}

}
echo '</div>';
require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/footer.php');
?>
