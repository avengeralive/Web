<?php echo $header; ?><?php echo $column_left; ?>

<?php
require_once(DIR_SYSTEM . '/engine/neoseo_view.php' );
$widgets = new NeoSeoWidgets('neoseo_email_notify_',$params);
$widgets->text_select_all = $text_select_all;
$widgets->text_unselect_all = $text_unselect_all;
?>

<div id="content">

	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<?php if (!isset($license_error)) { ?>
					<a onclick="$('#form').attr('action', '<?php echo $save; ?>'); $('#form').submit();" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button_save; ?></a>
					<a onclick="$('#form').attr('action', '<?php echo $save_and_close; ?>'); $('#form').submit();" title="<?php echo $button_save_and_close; ?>" class="btn btn-default"><i class="fa fa-save"></i> <?php echo $button_save_and_close; ?></a>
				<?php } else { ?>
					<a href="<?php echo $recheck; ?>" data-toggle="tooltip" title="<?php echo $button_recheck; ?>"class="btn btn-primary" /><i class="fa fa-check"></i> <?php echo $button_recheck; ?></a>
				<?php } ?>
				<a href="<?php echo $close; ?>" data-toggle="tooltip" title="<?php echo $button_close; ?>" class="btn btn-default"><i class="fa fa-close"></i> <?php echo $button_close; ?></a>
			</div>
			<img width="36" height="36" style="float:left" src="view/image/neoseo.png" alt=""/>
			<h1><?php echo $heading_title_raw . " " . $text_module_version; ?></h1>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
					<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="container-fluid">
		<?php if ($error_warning) { ?>
			<div class="alert alert-danger">
				<i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php } ?>
		<?php if (isset($success) && $success) { ?>
			<div class="alert alert-success">
				<i class="fa fa-check-circle"></i>
				<?php echo $success; ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-body">

				<ul class="nav nav-tabs">

					<li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
					<?php if (!isset($license_error)) { ?>
						<li><a href="#tab_templates" data-toggle="tab"><?php echo $tab_templates; ?></a></li>
						<li><a href="#tab-fields" data-toggle="tab"><?php echo $tab_fields; ?></a></li>
						<li><a href="#tab-logs" data-toggle="tab"><?php echo $tab_logs; ?></a></li>
					<?php } ?>
					<li><a href="#tab-support" data-toggle="tab"><?php echo $tab_support; ?></a></li>
					<li><a href="#tab-license" data-toggle="tab"><?php echo $tab_license; ?></a></li>
				</ul>

				<form action="<?php echo $save; ?>" method="post" enctype="multipart/form-data" id="form">
					<div class="tab-content">
						<div class="tab-pane active" id="tab-general">
							<?php if (!isset($license_error)) { ?>
								<?php $widgets->dropdown('status',array( 0 => $text_disabled, 1 => $text_enabled)); ?>
								<?php $widgets->input('recipients'); ?>
							<?php } else { ?>
								<?php echo $license_error; ?>
							<?php } ?>
						</div>

						<?php if (!isset($license_error)) { ?>
							<div class="tab-pane" id="tab_templates">
								<table class="table table-striped table-hover" id="items-table">
									<thead>

									<th><?php echo $column_status_name; ?></th>
									<th><?php echo $column_status; ?></th>
									<th><?php echo $column_template_subject; ?></th>
									<th><?php echo $column_template_filename; ?></th>

									</thead>
									<tbody>
									<?php foreach($neoseo_email_notify_templates as $id => $template_data) {
										if ($id < 0 )
											continue;
										?>
										<tr>
											<td class="col-xs-2"><?php echo "{$id}. " . $template_data["name"]  ?></td>
											<td class="col-xs-2">
												<?php foreach ($languages as $language) { ?>
												<select class="form-control" name="neoseo_email_notify_templates[<?php echo $id; ?>][<?php echo $language['language_id']; ?>][status]">
													<option value="0"><?php echo $text_disabled; ?></option>
													<option value="1" <?php if (1 == $template_data[$language['language_id']]['status']) { ?> selected="selected" <?php } ?> ><?php echo $text_enabled;?></option>
													<option value="2" <?php if (2 == $template_data[$language['language_id']]['status']) { ?> selected="selected" <?php } ?> ><?php echo $text_force;?></option>
												</select>
												<?php } ?>
												<select class="form-control" name="neoseo_email_notify_templates[<?php echo $id; ?>][0][status]">
													<option value="0"><?php echo $text_disabled; ?></option>
													<option value="1" <?php if (1 == $template_data[0]['status']) { ?> selected="selected" <?php } ?> ><?php echo $text_enabled;?></option>
													<option value="2" <?php if (2 == $template_data[0]['status']) { ?> selected="selected" <?php } ?> ><?php echo $text_force;?></option>
												</select>
											</td>
											<td class="col-xs-6">
												<?php foreach ($languages as $language) { ?>
													<div class="input-group">
														<span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>"/></span>
														<input name="neoseo_email_notify_templates[<?php echo $id; ?>][<?php echo $language['language_id']; ?>][subject]" id="<?php echo "neoseo_email_notify_templates_" . $id . "_" . $language['language_id'] ; ?>" class="form-control" value="<?php echo $template_data[$language['language_id']]['subject']; ?>"/>
													</div>
												<?php } ?>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-cogs" aria-hidden="true" style="width:16px"></i></span>
													<input name="neoseo_email_notify_templates[<?php echo $id; ?>][0][subject]" id="<?php echo "neoseo_email_notify_templates_" . $id . "_0"; ?>" class="form-control" value="<?php echo $template_data[0]['subject']; ?>"/>
												</div>
											</td>
											<td class="col-xs-2">
												<?php foreach ($languages as $language) { ?>
													<select class="form-control" name="neoseo_email_notify_templates[<?php echo $id; ?>][<?php echo $language['language_id']; ?>][filename]">
														<option value=""><?php echo $text_select_template;?></option>
														<?php foreach ($email_templates as $email_template) { ?>
															<option value="<?php echo $email_template;?>" <?php if ($email_template == $template_data[$language['language_id']]['filename']) { ?> selected="selected" <?php } ?> ><?php echo $email_template;?></option>
														<?php } ?>
													</select>
												<?php } ?>
												<select class="form-control" name="neoseo_email_notify_templates[<?php echo $id; ?>][0][filename]">
													<option value=""><?php echo $text_select_template;?></option>
													<?php foreach ($email_templates as $email_template) { ?>
														<option value="<?php echo $email_template;?>" <?php if ($email_template == $template_data[0]['filename']) { ?> selected="selected" <?php } ?> ><?php echo $email_template;?></option>
													<?php } ?>
												</select>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						<?php } ?>
						<?php if (!isset($license_error)) { ?>
							<div class="tab-pane" id="tab-fields">
								<table class="table table-striped table-hover" id="items-table">
									<thead>
									<tr>
										<th><?php echo $entry_field_list_name; ?></th>
										<th><?php echo $entry_field_list_desc; ?></th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($fields as $field_name => $field_desc) { ?>
										<tr>
											<td class="col-xs-3"><?php echo $field_name; ?></td>
											<td class="col-xs-9"><?php echo $field_desc;?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						<?php } ?>
						<?php if (!isset($license_error)) { ?>
							<div class="tab-pane" id="tab-logs">
								<?php $widgets->debug_and_logs('debug',array( 0 => $text_disabled, 1 => $text_enabled), $clear, $button_clear_log ); ?>
								<textarea class="form-control" style="width: 100%; height: 300px; padding: 5px; border: 1px solid #CCCCCC; background: #FFFFFF; overflow: scroll;"><?php echo $logs; ?></textarea>
							</div>
						<?php } ?>

						<div class="tab-pane" id="tab-support">
							<?php echo $mail_support; ?>
						</div>

						<div class="tab-pane" id="tab-license">
							<?php echo $module_licence; ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
	if (window.location.hash.indexOf('#tab') == 0 && $("[href=" + window.location.hash + "]").length) {
		$(".panel-body > .nav-tabs li").removeClass("active");
		$("[href=" + window.location.hash + "]").parents('li').addClass("active");
		$(".panel-body:first .tab-content:first .tab-pane:first").removeClass("active");
		$(window.location.hash).addClass("active");
	}
	$(".nav-tabs li a").click(function() {
		var url = $(this).prop('href');
		window.location.hash = url.substring(url.indexOf('#'));
	});
//--></script>
<script type="text/javascript"><!--
	window.token = '<?php echo $token; ?>';
	var gate = "#neoseo_sms_notify_gate";
	var login = "#neoseo_sms_notify_login";
	var password = "#neoseo_sms_notify_password";
	var sender = "#neoseo_sms_notify_sender";
	var additional = "#neoseo_sms_notify_additional";
	var phone = "#neoseo_sms_notify_phone";
	var message = "#neoseo_sms_notify_message";

	function checkGate() {
		var data = {
			gate: $(gate).val(),
			login: $(login).val(),
			password: $(password).val(),
			sender: $(sender).val(),
			additional: $(additional).val(),
			phone: $(phone).val(),
			message: $(message).val()
		};
		$.ajax({
			url: 'index.php?route=module/neoseo_sms_notify/check&token=' + window.token,
			type: 'post',
			data: data,
			dataType: 'json',
			success: function (json) {
				$('.success, .warning, .attention, .information').remove();

				if (json['redirect'])
					location = json['redirect'];

				if (json['success'])
					showEditForm(type, json);
			}
		});
	}
//--></script>
<?php echo $footer; ?>