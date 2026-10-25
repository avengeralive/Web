

	<tr>
		<td class="title" width="200">{$title}</td>
		<td>
			<select name="{$index}"{if !empty($dom_id)} id="{$dom_id}"{/if}>
				{if !empty($title_null)}
				<option value=''{if $filter_vars[$index] == ''}{$selected}{/if}>{$title_null}</option>
				{/if}

				{foreach $options as $id => $title}
				<option value="{$id}"{if !empty($optsHighlight)} class="select-{$index}-{$id}"{/if}{if $filter_vars[$index] == $id}{$selected}{/if}>
					{if empty($arr_title_index)}
						{$title}
					{else}
						{$title[$arr_title_index]}

						{if !empty($arr_title_index2)}
							{$title[$arr_title_index2]}
						{/if}
					{/if}
					{if $filter_vars[$index] == $id}*{/if}
				</option>
				{/foreach}
			</select>
		</td>
	</tr>
