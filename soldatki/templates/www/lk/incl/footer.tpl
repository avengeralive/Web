		</div>

		<div id="footer">
			{$smarty.now|date_format:"%Y"}
			<span id="build">
				<span>build {$smarty.const.BUILD}</span>
			</span>
		</div>
	</div>
	</center>
	<div id="basic-modal-content"></div>

	<script type="text/javascript">{$javascript}</script>

	{section name=i loop=$js_libs}
	<script type="text/javascript" src="{$uri}/assets/js/{$js_libs[i]}.js"></script>
	{/section}

	{if $include_tinymce}
	<script type="text/javascript" src="{$tinymce_url}"></script>
	{/if}
</body>
</html>
