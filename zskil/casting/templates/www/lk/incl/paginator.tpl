
		{if ($pages>1 && $filter_vars.on_page) || !empty($rows_count)}
		<tr>
			<td align="center">
				{if $pages > 1 && $filter_vars.on_page}
				<div>
					{if $filter_vars.page != 1}
					<a href="?{filter vals='page;'|cat:($filter_vars.page-1)}" class="js-filter-href">&lt;&lt;&lt;</a>
					{/if}

					{section name='pagenav' loop=$pages+1 start=1}
						{if $smarty.section.pagenav.index == $filter_vars.page}
							<b>{$filter_vars.page}</b>
						{else}
							<a href="?{filter vals='page;'|cat:$smarty.section.pagenav.index}" class="js-filter-href">{$smarty.section.pagenav.index}</a>
						{/if}
					{/section}

					{if $filter_vars.page != $pages}
					<a href="?{filter vals='page;'|cat:($filter_vars.page+1)}" class="js-filter-href">&gt;&gt;&gt;</a>
					{/if}
				</div>
				{/if}
			</td>
		</tr>
		{/if}