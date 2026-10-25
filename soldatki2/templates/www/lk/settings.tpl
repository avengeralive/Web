{include file="lk/incl/header.tpl"}
{include file="lk/incl/submenu.tpl"}
{include file="lk/incl/notices.tpl"}

<div id="module-content">

	<form method="POST" enctype="multipart/form-data">
	<table class="tbl_form" cellpadding="10" cellspacing="1" width="100%">
		<input type="hidden" name="action" value='update_settings' />
		<tr class="unic_tbl">
			<td colspan="2" class="caption">Основные</td>
		</tr>

		{foreach $settings->data as $sett_index => $sett_value}
		{if isset($lists.db.SETTINGS_ROWS[$sett_index]) && $lists.db.SETTINGS_ROWS[$sett_index].hidden == '0'}
		<tr>
			<td class="titl" align="left">{$lists.db.SETTINGS_ROWS[$sett_index].comment}</td>
			<td>
				<input type="text" name="settings[{$sett_index}]" value='{$sett_value}' autocomplete="off" />
			</td>
		</tr>
		{/if}
		{/foreach}

		<tr>
			<td colspan="2">
				<input type="submit" value="Сохранить" class="js-form-submit" />
				<font color="red">изменение значений параметров может привести к нестабильной работе!</font>
				<img src="{$uri}/assets/images/lk/loading.gif" align="absmiddle" class="form-loading-img" />
			</td>
		</tr>
	</table>
	</form><br />

	<form method="POST" enctype="multipart/form-data">
	<table class="tbl_form" cellpadding="10" cellspacing="1" width="100%">
		<input type="hidden" name="action" value='update_password' />
		<tr class="unic_tbl">
			<td colspan="2" class="caption">Изменение пароля</td>
		</tr>

		<tr>
			<td class="titl" align="left">Новый пароль</td>
			<td>
				<input type="password" name="new_password" value='' autocomplete="off" />
			</td>
		</tr>
		<tr>
			<td class="titl" align="left">Новый пароль (еще раз)</td>
			<td>
				<input type="password" name="new_password2" value='' autocomplete="off" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="Сохранить" class="js-form-submit" />
				<img src="{$uri}/assets/images/lk/loading.gif" align="absmiddle" class="form-loading-img" />
			</td>
		</tr>
	</table>
	</form><br />

</div>

{include file="lk/incl/footer.tpl"}
