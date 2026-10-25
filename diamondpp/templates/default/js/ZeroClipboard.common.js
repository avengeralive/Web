var client = new ZeroClipboard($('.btn-copy'));

client.on('ready', function( readyEvent ) {
    alert( "ZeroClipboard SWF is ready!" );
    client.on('aftercopy', function(event) {
    alert('Ссылка скопирована в буфер обмена');
    });
});

var client2 = new ZeroClipboard($('.btn-copy-iframecode'));

client2.on('ready', function( readyEvent ) {
	client2.on('aftercopy', function(event) {
    	alert('Ссылка скопирована в буфер обмена');
  	});
});