
	<tr>
		<td class="title" width="200">Записей на странице</td>
		<td>
			<select name="on_page">
				{foreach $lists.filters.lk[$index].on_page as $id => $title}
				<option value="{$id}"{if $filter_vars.on_page == $id}{$selected}{/if}>{$title}</option>
				{/foreach}
			</select>
		</td>
	</tr>