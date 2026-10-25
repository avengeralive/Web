
	<tr>
		<td class="title" width="200">{$title}</td>
		<td>
			<input type="text" name="{$index}" value='{$filter_vars[$index]}'{if !empty($dom_id)} id="{$dom_id}"{/if}{if !empty($class)} class="{$class}"{/if}{if !empty($autocomplete)} autocomplete="{$autocomplete}"{/if} />
		</td>
	</tr>