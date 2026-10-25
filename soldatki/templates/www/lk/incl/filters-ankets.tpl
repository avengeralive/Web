{include file="lk/incl/filter-top.tpl"}


	<tr>
		<td class="title" width="200">Рейтинг</td>
		<td>
			{include
				file="lk/incl/rating.tpl"
				rating_count=$smarty.const.CASTING_RATING_MAX
				index="rating"
				value={$filter_vars.rating}
				buttonReset="1"
				ratingAny="1"
			}
		</td>
	</tr>

	{include file="lk/incl/filter-item-status.tpl" statuses=$lists.ankets.statuses}
	{include file="lk/incl/filter-item-input-text.tpl" title="ID" index="id"}
	{include file="lk/incl/filter-item-input-text.tpl" title="ФИО / Email" index="text"}
	{include file="lk/incl/filter-item-on-page.tpl" index="ankets"}
	{include file="lk/incl/filter-item-submit.tpl"}
{include file="lk/incl/filter-bottom.tpl"}
