
<div class="js-inline-edit inline-editor">

	<input type="hidden" class="js-inline-ajax-url" value="{$ajax}" />
	<input type="hidden" class="js-inline-id" value="{$id}" />

	<span class="js-inline-comment">{$comment|lfToBr}</span>

	{if empty($right) || $rights->allow($right)}
	<img src="{$uri}/assets/images/lk/edit.png" align="absmiddle" class="js-inline-do-edit" title="быстрое редактирование" />

	<div class="container js-inline-edit-container">
		{if isset($use_input)}
		<input class="js-inline-value js-stop-propagation-click" value='{$comment}' />
		{else}
		<textarea class="js-inline-value js-stop-propagation-click">{$comment}</textarea>
		{/if}

		<span class="inline-edit-actions-container">
			<img src="{$uri}/assets/images/lk/filesave.png" align="absmiddle" class="js-inline-do-save" title="сохранить изменения" />
			<img src="{$uri}/assets/images/lk/cancel.png" align="absmiddle" class="js-inline-do-cancel" title="отменить изменения" />
		</span>
	</div>
	{/if}
</div>
