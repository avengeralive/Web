{include file="lk/incl/header.tpl"}
{include file="lk/incl/submenu.tpl"}
{include file="lk/incl/notices.tpl"}

<div id="module-content">

	<table width="100%">

		{if $rights->allow('lk-ankets-moderate')}
		<tr>
			<td class="std-filters">
				{include file="lk/incl/filters-ankets.tpl"}
			</td>
		</tr>
		{/if}

		<tr>
			<td align="left">
				{if $rights->allow('lk-ankets-moderate') || $rights->allow('lk-ankets-insert')}
					<span><a href="{$linker}{$selected_module}/insert/" class="button_add_blue"><img src="{$uri}/assets/images/lk/plus.png" /> Добавить анкету</a></span>
				{/if}
			</td>
		</tr>

		{include file="lk/incl/paginator.tpl"}
		<tr>
			<td>
				<div>
					{if !empty($rows_count)}
					Записей найдено: {$rows_count}
					{/if}

					<div class="action_menu">
						<ul>
							{if $rights->allow('lk-ankets-moderate') || $rights->allow('lk-ankets-delete')}
							<li><a href="{$linker}{$adm_module}?{filter}&delete" id="multi_delete" confirm-text="Выделенные записи будут удалены, продолжить?">удалить</a></li>
							{/if}

							{if $rights->allow('lk-ankets-moderate') || $rights->allow('lk-ankets-delete')}
							<li>
								<a href="{$linker}{$adm_module}?{filter}&change_status" class="multi_confirm" confirm-text="Статус будет обновлен, продолжить?" check-func="init._anketsListingCheckStatusEdit">изменить статус выбранных на</a>
								<select id="ankets_new_status">
									{foreach $lists.ankets.statuses as $id => $title}
									<option value="{$id}">{$title}</option>
									{/foreach}
								</select>
							</li>
							{/if}
						</ul>
					</div>
				</div>

				<table border="0" cellspacing="1" cellpadding="2" id="tbl_lst" width="100%">
					<tr class="header">
						<th align="center"><input type="checkbox" id="multi_select_all"/></th>
						<th align="left">{sort name="id" title="#" by="id"}</th>
						<th align="center">{sort name="rating" title='Рейтинг' by='рейтингу'}</th>
						<th align="center">Превью фото</th>
						<th align="center" style="width:150px;">{sort name="fio" title="Фамилия" by="фамилии"}</th>
						<th align="center" style="width:150px;">Имя</th>
						<th align="center">{sort name="age" title="Возр." by="возрасту"}</th>
						<th align="center">Город проживания</th>
						<th align="center">Гражданство</th>
						<th align="center">Соцсети</th>
						<th align="center">Видео</th>
						<th align="center">Информация</th>
						<th align="center">Комментарии</th>
						{*<th align="center">Word</th>
						<th align="center">{sort name="status" title="Анкета" by="статусу анкеты"}</th>
						
						<th align="center">{sort name="created" title='создано' by='дате создания'}</th>
						<th align="center">{sort name="updated" title='обновлено' by='дате обновления'}</th>
						*}
						<th align="center">&nbsp;</th>
						<th align="center">&nbsp;</th>
					</tr>
					{foreach $items as $item}
						<tr class="object_tr" data-item-id="{$item.id}">
							<td align="center" class="td-checkbox">
								<input type="checkbox" class="checkbox-multi" item-id="{$item.id}" />
							</td>
							<td align="left">{$item.id}</td>
							<td align="center" class="td-item-rating">
								{include
									file="lk/incl/rating.tpl"
									rating_count=$smarty.const.CASTING_RATING_MAX
									index="rating"
									value={$item.rating}
									changeHook="init.anketsRatingChange"
									ratingGroup="ankets"
									confirmText="Вы уверены, что хотите поменять рейтинг?"
									itemId={$item.id}
								}
							</td>
							<td align="left" style="display: inline-block;">

								{foreach $item.photos as $image}

									{if (($image@first && $image.order!=2) || $image.order==1)}
										<span  style="float: left;padding-right: 1em;">
										<a rel="gallery-{$item.id}" href="{$image.uri}" class="swipebox" target="blank" title='{$image.filename}'>
											<img src="{$image.uri}" alt="image" width="100">
										</a></span>
										{*<br />*}
									{else}
										<a rel="gallery-{$item.id}" href="{$image.uri}" class="swipebox" target="blank" title='{$image.filename}'>
											<img src="{$image.uri}" alt="image" width="30">
										</a>
									{/if}
								{/foreach}
							</td>
							<td align="left" style="min-width:120px;"><p>{$item.last_name}</p></td>
							<td align="left" style="min-width:120px;"><p>{$item.first_name}</p></td>
							<td align="center">{$item.date_birthday|age}</td>
							<td align="center" width="50"><p>{$item.city}</p></td>
							<td align="center" width="50"><p>{$item.citizenship}</p></td>
							<td align="left">
								{if !empty($item.social1)}
									<a href=
									{if $item.social1[0]!=="h" }
										"https://{$item.social1}"
									   {else}
										{$item.social1}
									{/if}
									   target="blank">{$item.social1}</a><br />
								{/if}
								{if !empty($item.social2)}
									<a href={if $item.social1[0]!=="h" }
									   "https://{$item.social2}"
											{else}
											{$item.social2}
											{/if} target="blank">{$item.social2}</a><br />
								{/if}
								{if !empty($item.social3)}
									<a href={if $item.social3[0]!=="h" }
									   "https://{$item.social3}"
											{else}
											{$item.social3}
											{/if} target="blank">{$item.social3}</a><br />
									{*<a href="{$item.social3}" target="blank">{$item.social3|domain}</a><br />*}
								{/if}
							</td>
							<td align="center">
								{foreach $item.videos as $video}
									<div class="js-video">
										<div>
											{if $video.conv_files['webm.orig'].conv_state == "processed"}
												<a href="{$video.uri}" class="js-video">
													<img src="{$video.conv_files['thumb.orig'].uri}" data-video-uri="{$video.conv_files['webm.orig'].uri}" class="js-video-play" />
												</a>
											{else}
												{if $video.conv_files['thumb.orig'].conv_state == "processed"}
													<img src="{$video.conv_files['thumb.orig'].uri}" data-video-uri="{$video.uri}" class="js-video-processing" />
												{else}
													<img src="{$uri}/assets/images/stub/video.png" data-video-uri="{$video.uri}" class="js-video-processing" />
												{/if}
											{/if}
										</div>
										<div class="js-video-download">
											<a href="{$uri}/lk/ajax/ankets-get-file/?file_id={$video.file_id}">скачать</a>
										</div>
									</div>
								{/foreach}
							</td>
							<td align="left" width="350">
								<p>
									{*1. {if $item.men_participate == "1"}Готов{else}Не готов{/if} <br />*}
									1. ф/п : {$item.men_participate} <br />
									{*2. {if $item.men_army == "1"}Прошел{else}Не прошел{/if} <br />*}
									2. м/ч : {$item.men_army} <br />
									3. в/п : {$item.men_city} <br />
									4. ПР  :

									{if !empty($item.men_social1)}
											{$item.men_social1} </a><br />
										{/if}
		{if !empty($item.men_social2)}
											{$item.men_social2} </a><br />
										{/if}
		{if !empty($item.men_social3)}
											{$item.men_social3} </a><br />
										{/if}

										{*{if !empty($item.men_social2)}*}
											{*<a href="{$item.men_social2}" target="blank">{$item.men_social2|domain}</a><br />*}
										{*{/if}*}
										{*{if !empty($item.men_social3)}*}
											{*<a href="{$item.men_social3}" target="blank">{$item.men_social3|domain}</a><br />*}
										{*{/if}*}
								</p>
							</td>
							<td align="left">
								{$item.comment}
							</td>
							{*<td align="center">
								{foreach $item.docs as $doc}
									<a class="js-word" href="{$smarty.const.URL_GDOCS_VIEW}{$smarty.const.HTTP}{$smarty.server.HTTP_HOST}{$doc.uri}&embedded=true">
										<img src="{$uri}/assets/images/lk/document.png" />
									</a><br />
								{/foreach}
							</td>

							<td align="center" class="item-td-status js-item-status" data-item-id="{$item.id}">
								{foreach $lists.ankets.statuses as $id => $title}
									<div class="std-site-status {$id}{if $id==$item.status} selected{/if}" data-item-status="{$id}">{$title}</div>
								{/foreach}
							</td>

							
							<td align="center" class="item-td-created"><p>{$item.date_created|date_format:"Y.m.d"}</p></td>
							<td align="center" class="item-td-created"><p>{$item.date_updated|date_format:"Y.m.d"}</p></td>
							*}

							<td width="30" align="center" class="action">
								{if $rights->allow('lk-ankets-moderate') || ($rights->allow('lk-ankets-edit') && $item.author_id==$user.id)}
								<a href="{$linker}{$selected_module}/edit/id-{$item.id}/"><img src="{$uri}/assets/images/lk/edit.png" title="редактировать анкету" align="absmiddle" /></a>
								{/if}
							</td>
							<td width="30" align="center" class="action">
								{if $rights->allow('lk-ankets-moderate') || ($rights->allow('lk-ankets-delete') && $item.author_id==$user.id)}
								<a href="{$linker}{$selected_module}/?delete&ids[]={$item.id}&{filter}" class="js-delete-item-confirm" confirm-text="Анкета будет удалена, продолжить?"><img src="{$uri}/assets/images/lk/delete.png" title="удалить анкету" align="absmiddle" /></a>
								{/if}
							</td>
{*
							<td align="left">
								Гражданство: {$lists.ankets.citizenships[$item.citizenship]}<br />

								{foreach $lists.ankets.info_rows as $index => $title}
									{if !empty($item[$index])}
										{$title}: {$item[$index]}<br />
									{/if}
								{/foreach}

								{foreach $lists.ankets.files_groups as $group_id => $group_info}
									{if !empty($item[$group_id])}
										<br /><b>{$group_info.title}</b><br />

										{if $group_info.type == 'image'}
										{foreach $item[$group_id] as $image}
											<a rel="gallery-{$item.id}" href="{$image.uri}" class="swipebox" target="blank" title='{$image.filename}'>
												<img src="{$image.uri}" alt="image" width="100">
											</a>
										{/foreach}
										{/if}

										{if $group_info.type == 'video'}
											{foreach $item[$group_id] as $video}
												<a href="{$video.uri}">видео id#{$video.id}</a>
											{/foreach}
										{/if}

										{if $group_info.type == 'doc'}
											{foreach $item[$group_id] as $doc}
												<a href="{$doc.uri}">документ id#{$doc.id}</a>
											{/foreach}
										{/if}
										<br />
									{/if}
								{/foreach}
							</td>
							*}
						</tr>
					{foreachelse}
						<tr><td colspan="100" align="center">по заданному фильтру не найдено ни одной записи</td></tr>
					{/foreach}
				</table>
			</td>
		</tr>
		{include file="lk/incl/paginator.tpl"}

	</table>
</div>


{include file="lk/incl/footer.tpl"}
