{include file="lk/incl/header.tpl"}
{include file="lk/incl/submenu.tpl"}
{include file="lk/incl/notices.tpl"}


<div id="module-content">
	<center>
		<h1>{$submenu_title}</h1>

		<a href="{$referer}">вернуться назад</a>

		<form method="POST" enctype="multipart/form-data" action="{$uri}/lk/{$selected_module}/{if $edit}edit/id-{$inputs.id}{else}insert{/if}/">
		<input type="hidden" name="do" value='true' />
		<input type="hidden" name="edit" value='{$edit}' />
		<input type="hidden" name="edit_id" value='{$inputs.id}' />

		<table class="tbl_form" cellspacing="1" width="800px">
			<tr class="unic_tbl">
				<td colspan="2" class="caption">Общая информация</td>
			</tr>
			<tr>
				<td class="titl" align="left">Фамилия:<span class="red">*</span></td>
				<td>
					<input type="text" name="last_name" value='{$inputs.last_name}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Имя:<span class="red">*</span></td>
				<td>
					<input type="text" name="first_name" value='{$inputs.first_name}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Дата рождения:<span class="red">*</span></td>
				<td>
					<input type="text" name="date_birthday" class="datepicker" value='{$inputs.date_birthday}' />
					{*<input type="text" name="date_birthday" class="js-mask-date" value='{$inputs.date_birthday}' />*}
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Гражданство:</td>
				<td align="left">
					<input type="text" name="citizenship" value='{$inputs.citizenship}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Город:<span class="red">*</span></td>
				<td>
					<input type="text" name="city" value='{$inputs.city}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Телефон:<span class="red">*</span></td>
				<td>
					<input type="text" name="phone" class="js-mask-phone" value='{$inputs.phone}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">E-mail:<span class="red">*</span></td>
				<td>
					<input type="text" name="email" value='{$inputs.email}' />
				</td>
			</tr>

			<tr class="unic_tbl">
				<td colspan="2" class="caption">Ссылки на соцсети</td>
			</tr>
			<tr>
				<td class="titl" align="left">Ссылка #1:</td>
				<td>
					<input type="text" name="social1" value='{$inputs.social1}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Ссылка #2:</td>
				<td>
					<input type="text" name="social2" value='{$inputs.social2}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Ссылка #3:</td>
				<td>
					<input type="text" name="social3" value='{$inputs.social3}' />
				</td>
			</tr>

			<tr class="unic_tbl">
				<td colspan="2" class="caption">
					Медиа
					<input type="hidden" name="media_delete" id="media_delete" value="" />
				</td>
			</tr>
			{foreach $lists.ankets.files_groups as $group_id => $group}
			<tr>
				<td class="titl" align="left">{$group.title}:</td>
				<td>
					<input type="file" name="{$group_id}[]" accept="{$group.form_accept}" multiple />

					{if !empty($cur_obj[$group_id])}
						<table class="js-media-control">
							{foreach $cur_obj[$group_id] as $file}
							<tr class="js-media-item" data-item-id="{$file.file_id}">
								<td class="js-media-show">
									{if $group.type == 'image'}
										<img src="{$file.uri}" width="150" />
									{else}
										<a href="{$file.uri}">Файл #{$file.file_id}</a>
									{/if}
								</td>
								<td>
									<div class="js-media-delete-container">
										<a href="#" class="js-media-delete">удалить</a>
									</div>
									{if $file.order != 1}
									<div class="js-media-main-container">
										<a href="#" class="js-media-main">сделать главной</a>
									</div>
									{/if}

									<div class="js-media-restore-container">
										<a href="#" class="js-media-restore">восстановить</a>
									</div>
								</td>
							</tr>
							{/foreach}
						</table>
					{/if}
				</td>
			</tr>
			{/foreach}
			<tr>
				<td class="titl" align="left">В какой ты физической форме сейчас:</td>
				<td>
					<input type="text" name="men_participate" value='{$inputs.men_participate}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Есть ли у тебя молодой человек?</td>
				<td>
					<input type="text" name="men_army" value='{$inputs.men_army}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Вредные привычки:</td>
				<td>
					<input type="text" name="men_city" value='{$inputs.men_city}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Cнималась ли ранее в телепроектах? Если ДА, то в каких?</td>
				<td>
					<input type="text" name="men_social1" value='{$inputs.men_social1}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Cнималась ли ранее в телепроектах? Если ДА, то в каких?</td>
				<td>
					<input type="text" name="men_social2" value='{$inputs.men_social2}' />
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Cнималась ли ранее в телепроектах? Если ДА, то в каких?</td>
				<td>
					<input type="text" name="men_social3" value='{$inputs.men_social3}' />
				</td>
			</tr>

			<tr class="unic_tbl">
				<td colspan="2" class="caption">Модерация</td>
			</tr>
			<tr>
				<td colspan="2" class="titl" align="left">Комментарий:</td>
			</tr>
			<tr>
				<td colspan="2" align="left">
					<textarea name="comment" class="js-wysiwyg">{$inputs.comment}</textarea>
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Статус:</td>
				<td align="left">
					<select name="status">
						{foreach $lists.ankets.statuses as $id => $title}
							<option value="{$id}"{if $inputs.status == $id}{$selected}{/if}>
								{$title}{if $inputs.status == $id}*{/if}
							</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td class="titl" align="left">Рейтинг:</td>
				<td align="left">
					{include
						file="lk/incl/rating.tpl"
						rating_count=$smarty.const.CASTING_RATING_MAX
						index="rating"
						value=$inputs.rating
					}
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<input type="hidden" name="referer" value='{$referer}' />
					<input type="submit" value="сохранить" class="js-form-submit" />

					{include file="lk/incl/redirect-select.tpl"}

					<img src="{$uri}/assets/images/lk/loading.gif" align="absmiddle" class="form-loading-img" />
				</td>
			</tr>
		</table>
		</form>
	</center>
</div>

{include file="lk/incl/footer.tpl"}
