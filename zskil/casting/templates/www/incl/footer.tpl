
	<script type="text/javascript">{$javascript}</script>

	{section name=i loop=$js_libs}
	<script type="text/javascript" src="{$uri}/assets/js/{$js_libs[i]}.js"></script>
	{/section}

	{if $include_tinymce}
	<script type="text/javascript" src="{$tinymce_url}"></script>
	{/if}
</body>
</html>
