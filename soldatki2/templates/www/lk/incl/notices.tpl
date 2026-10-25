
{if !empty($errors)}
<div class="static-errors error">
	{foreach from=$errors item="error"}
	<li>{$error}</li>
	{/foreach}
</div>
{/if}

{if !empty($notices)}
<div class="static-notices notice">
	{foreach from=$notices item="notice"}
	<li>{$notice}</li>
	{/foreach}
</div>
{/if}