
{if !empty($submenu)}
<div id="m_objects">
	<ul>
	{foreach $submenu as $name => $title}
		<li {if $name==$submenu_selected} class="active"{/if}>
			<a href="{$linker}{$selected_module}/{$name}/{if $name == 'edit'&&!empty($inputs.id)}id-{$inputs.id}/{/if}{if !empty($submenu_postfix_url)}{$submenu_postfix_url}{/if}">{$title}</a>
		</li>
	{/foreach}
	</ul>
</div>
{/if}


{if !empty($subsubmenu)}
	<div class="subcat">
	{foreach $subsubmenu as $id => $data}
		<span class="{if $id == $subsubmenu_selected}active-subcat{/if}{if isset($data.is_disabled) && !empty($data.is_disabled)} disabled-subcat{/if}">
			<a href="{$data.url}">{$data.title}</a>
		</span>
	{/foreach}
	</div>
{/if}
