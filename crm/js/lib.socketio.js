
function socketio_cl( params ) {
	$.extend( this.options, params );
	console.log(this.options);
	console.log(params);
	this.init.call( this );
}
socketio_cl.prototype = {
	build:	'1.0',
	socket:	null,
	flags:	{
		requests_ymap_drawed:			false,
		requests_root_formed:			false,
		requests_cars_formed:			false,
		requests_saving:				false,
		requests_refreshing_companies:	false,
		requests_companies_selection:	false,
		loading_correspondence:			false,
		sending_socketio_msg:				false,
		stat_drawed:					false
	},
	cfg:	{
		debug: true
	},
	data:	{
		requests_struct:	null,
		current:	{
			session: 		{},

			request:		{
				id: 0,
				id_user:	0,
				room_id:	0
			}
		}
	},
	is:	{
		authorized:	function() {
			return !util.isEmpty( this.data.current.session ) && this.data.current.session.authorized == true;
		},
		customer:	function() {
			return this.data.current.session.usertype == 1; /////////////////////////////
		}
	},
	draw:	{
		socketio:	function(room_id) {
			//получаем список комнат
			var context = this;
			this.draw.dialogs.call( this );
		},
		dialogs: function(room_id) {
			var context = this;

			util.ajax({
				url_prefix:	util.cfg.url.func_socketio,
				action: 'dialogs',
				post: {
					param: 'get',
					user_id:	JSCat.user
				},
				callback:	function( response ) {
					for (var i = 0; i < 2; i++) {
						if (i == 0){
							var room = JSCat.domain;
							context.socket.emit('create', room);
							socketio.request.send.call( context, {
								name:	'auth_in_room',
								room_id:	room
							});
						} else {
							context.socket.emit('create', i);
							socketio.request.send.call( context, {
								name:	'auth_in_room',
								room_id:	i
							});
						}
						
					}
				}
			});
		},
		timeConverter: function(UNIX_timestamp) {
			var a = new Date(UNIX_timestamp * 1000);
			var hour = a.getHours();
			var min = (a.getMinutes() < 10 ? '0' : '') + a.getMinutes();
			var time = hour + ':' + min;
			return time;
		}
	},
	request:	{
		handlers:	{
			session_checked:	{
				allow_unauthorized:	true,
				allow_authorized:	true,
				onFinish:			function( data ) {},
				callback:			function( response ) {

					this.data.current.session = response.data;
					
					if( this.is.authorized.call( this ) ) {
						this.draw.socketio.call( this );
						console.log('session_checked');
					}

				}
			}
		},
		send:	function( data ) {
			this.socket.emit( 'request', data );
		},
		process:	function( response ) {

			var founded_handler = null;
			console.log('process');
			if( typeof(this.request.handlers[response.name]) != 'undefined' ) {
				founded_handler = this.request.handlers[response.name];
			}

			if( founded_handler ) {

				if(
					this.is.authorized.call(this) &&
					founded_handler.allow_authorized

						||

					!this.is.authorized.call(this) &&
					founded_handler.allow_unauthorized
				) {
					founded_handler.callback.call( this, response );
				} else {
					util.log( 'response "'+response.name+'" access error', response );
				}

			} else {
				util.log( 'unknown response "'+response.name+'"', response );
			}
		}
	},
	init:		function() {


		var socketio = this;
		//wss://cr.intelcom.su:8089/ws
		this.socket = io( JSCat.domain+'/1v1crm.ru/',{ upgrade: true} );
// 		this.socket = io( '1v1crm.ru:8888',{ upgrade: true} );
//  		this.socket = io(JSCat.domain+'/node/' , { transports: [ 'websocket' ],secure:false});
		//this.socket = io(JSCat.domain, { transports: [ 'websocket' ],secure:true});
				
		this.socket.on('create', function(room) {
    			this.socket.join(room);
    			console.log(this.socket.rooms);
  		});
  		
		
		this.socket.on( 'connect', function() {
			console.log('connect');
			// отправляем запрос с авторизованным статусом
			socketio.request.send.call( socketio, {
				name:	'auth',
				token:	JSCat.token,
				user:	JSCat.user
			});
				
		}).on( 'response', function( response ) {
			console.log('response');
			socketio.request.process.call( socketio, response );
		});
  		

// 		var sock = this;
// 
// 		this.socket = io( JSCat.domain+'/'+JSCat.domain+'/' );
// 		this.socket
// 			.on( 'connect', function() {
// 
// 				// отправляем запрос с авторизованным статусом
// 				socketio.request.send.call( sock, {
// 					name:	'auth',
// 					token:	JSCat.token,
// 					user:	JSCat.user
// 				});
// 				
// 			})
// 			.on( 'response', function( response ) {
// 				socketio.request.process.call( sock, response );
// 			})
// 		;
// 		
// 		


	},
	options: {
		scheme:	'//',
		port:	8888,
		host:	 JSCat.domain,
		uri:	'/'
	}
}

