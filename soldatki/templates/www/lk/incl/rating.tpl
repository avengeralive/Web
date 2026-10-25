{if empty($ratingGroup)}
	{$ratingGroup = 'default'}
{/if}
{if empty($itemId)}
	{$itemId = ""}
{/if}
{if empty($changeHook)}
	{$changeHook = ""}
{/if}
{if empty($confirmText)}
	{$confirmText = ""}
{/if}
{if empty($buttonReset)}
	{$buttonReset = ""}
{/if}

<div class="rating" data-change-hook="{$changeHook}" data-rating-group="{$ratingGroup}" data-item-id="{$itemId}" data-confirm-text="{$confirmText}">
	<ul>
	{section name='rating' loop=$rating_count}<li value="{$smarty.section.rating.iteration}"><img src="{$uri}/assets/images/lk/stars.png" /></li>{/section}
	</ul>

	<input type="hidden" name="{$index}" class="js-rating-input" value='{$value}' />
	{if !empty($ratingAny)}
		<a href="#" class="js-rating-any">любой</a>
	{/if}
	{if !empty($buttonReset)}
		<a href="#" class="js-rating-reset">сбросить</a>
	{/if}
</div>
