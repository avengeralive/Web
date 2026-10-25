
	<tr>
		<td class="title" width="200">Статус</td>
		<td>
			<select name="status">
				<option value=''{if $filter_vars.status == ''}{$selected}{/if}>- любой -</option>

				{foreach $statuses as $id => $title}
				<option value="{$id}"{if $filter_vars.status == $id}{$selected}{/if}>{$title}{if $filter_vars.status==$id}*{/if}</option>
				{/foreach}
			</select>
		</td>
	</tr>