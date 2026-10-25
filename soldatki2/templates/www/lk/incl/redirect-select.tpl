
{if !isset($act) && isset($ACT)}
{$act = $ACT}
{/if}

{if !isset($redirect_checked)}
{$redirect_checked = 1}
{/if}

{if isset($smarty.get.redirect)}
	{$redirect_checked = $smarty.get.redirect}
{else}
	{if isset($smarty.post.redirect)}
		{$redirect_checked = $smarty.post.redirect}
	{/if}
{/if}

			<span class="js-form-to-hide">
				и
				<label>
					<input type="radio" name="redirect" value="1"{if $redirect_checked}{$checked}{/if} />
					вернуться к списку
				</label>
				<label>
					<input type="radio" name="redirect" value="0"{if !$redirect_checked}{$checked}{/if} />
					остаться на странице
				</label>
			</span>