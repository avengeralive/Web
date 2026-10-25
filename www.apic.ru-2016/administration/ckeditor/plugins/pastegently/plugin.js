(function()
{
	function forceHtmlMode( evt ) { evt.data.mode = 'html'; }

	CKEDITOR.plugins.add( 'pastegently',
	{
		init : function( editor )
		{
			editor.on( 'paste', function( evt )
			{
				var data = evt.data;
				//console.dir(data);
				if ( ( /([<>])/ ).test( data[ 'html' ] ) )
				{
					data[ 'html' ] = data[ 'html' ].replace( /<\/?(html|head|body)>/gi, '' );
					data[ 'html' ] = data[ 'html' ].replace( /<!--(.*?)-->/gi, '' );
					data[ 'html' ] = data[ 'html' ].replace( /\s*(id|class|style)="[^"]+"/gi, '' );
					data[ 'html' ] = data[ 'html' ].replace( /\s*(id|class|style)='[^']+'/gi, '' );	// Если используются одинарные кавычки
					data[ 'html' ] = data[ 'html' ].replace( /\s*(id|class|style)=[^\s>]*/gi, '' );	// Если не используются кавычки
					data[ 'html' ] = data[ 'html' ].replace( /<\/?font[^>]*>/gi, '' );
					data[ 'html' ] = data[ 'html' ].replace( /<object[^>]*>\/object>/gi, '' );
					data[ 'html' ] = data[ 'html' ].replace( /<iframe[^>]*><\/iframe>/gi, '' );
					data[ 'html' ] = data[ 'html' ].replace( /<script[^>]*><\/script>/gi, '' );
					data[ 'html' ] = data[ 'html' ].replace( /<style[^>]*><\/style>/gi, '' );
					data[ 'html' ] = data[ 'html' ].replace( /<(\/?)(h\d)>/gi, '<$1p>' );			// Дивы заголовки на абзацы
					data[ 'html' ] = data[ 'html' ].replace( /<\/?span>/gi, '' );					// Спаны не несут смысловой нагрузки — их лесом
					//editor.fire( 'paste', data );
				}
				//console.dir(data);
			}, this );
		},

		requires : [ 'clipboard' ]
	});
})();
