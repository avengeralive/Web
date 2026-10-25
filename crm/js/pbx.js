window.AudioContext = window.AudioContext || window.webkitAudioContext;

var audioGlobalContext = new AudioContext();
var audioOutputAnalyser
var inputPoint = null,
    audioRecorder = null;
var recording = false;

// Controls the start and stop of recording
function startRecording() {
	if (!audioRecorder) return;
    recording = true;
    audioRecorder.clear();
    audioRecorder.record();
    console.log("Start recording");
}

function stopRecording() {
	if (recording == true) {
        recording = false;
        audioRecorder.stop();
        audioRecorder.getBuffers( gotBuffers );
        console.log("Stop recording");
    }
}

function toggleRecording( e ) {
    if (recording == true) {
        recording = false;
        audioRecorder.stop();
        audioRecorder.getBuffers( gotBuffers );
        console.log("Stop recording");
    } else {
        if (!audioRecorder)
            return;
        recording = true;
        audioRecorder.clear();
        audioRecorder.record();
        console.log("Start recording");
    }
}

function gotBuffers(buffers) {
    audioRecorder.exportWAV(doneEncoding);
}

function doneEncoding(blob) {
	console.log(blob);
	var reader = new FileReader();
    reader.readAsDataURL(blob); 
    reader.onloadend = function() {
        var base64data = reader.result;    
        $.ajax({
        	url: 'https://1v1-crm.ru/json/',
        	method: 'POST',
        	data: {
        		func: 'CronRobot',
        		action: 'saveWav',
        		id: $("#contents-add .ids").html(),
        		data: base64data.split(',')[1]
        	},
        	success: function(data) {
        		console.log(data);
        		console.log("ВСЕ! ЗАПИСЬ СОХРАНЕНА!!!")
        	},
        	error: function(data) {
        		console.log(data);
        	}
        })            
        //console.log(base64data);
    }
    //document.getElementById("outputAudio").pause();
    //Recorder.setupDownload(blob);
}

function gotAudioMicrophoneStream(stream) {
    var source = audioGlobalContext.createMediaStreamSource(stream);
    source.connect(inputPoint);
}

function gotAudioOutputStream() {
    var source = audioGlobalContext.createMediaElementSource(document.getElementById("outputAudio"));
    source.connect(inputPoint);
    source.connect(audioGlobalContext.destination);
}

function initAudio() {
        if (!navigator.getUserMedia)
            navigator.getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
        if (!navigator.cancelAnimationFrame)
            navigator.cancelAnimationFrame = navigator.webkitCancelAnimationFrame || navigator.mozCancelAnimationFrame;
        if (!navigator.requestAnimationFrame)
            navigator.requestAnimationFrame = navigator.webkitRequestAnimationFrame || navigator.mozRequestAnimationFrame;

    inputPoint = audioGlobalContext.createGain();

    navigator.getUserMedia({
        "audio": {
            "mandatory": {
                "googEchoCancellation": "true",
                "googAutoGainControl": "false",
                "googNoiseSuppression": "true",
                "googHighpassFilter": "false"
            },
            "optional": []
        },
    }, gotAudioMicrophoneStream, function(e) {
        alert('Error recording microphone');
        console.log(e);
    });

    //gotAudioOutputStream();

    var analyserNode = audioGlobalContext.createAnalyser();
    analyserNode.fftSize = 2048;
    inputPoint.connect(analyserNode);
    var zeroGain = audioGlobalContext.createGain();
    zeroGain.gain.value = 0.0;
    inputPoint.connect(zeroGain);
    zeroGain.connect(audioGlobalContext.destination);

    audioRecorder = new Recorder(inputPoint);
}

//window.addEventListener('load', initAudio );

//jQuery(window).on('load', function () {
	//var $btnCallPrefer = jQuery("#btn-call-prefer");
	//if (window.location.hash == '#call') {
	//	console.log('auto-call');
	//	$btnCallPrefer.trigger('click');
	//}
//});

jQuery(document).ready(function () {
	// sip line 1
	var $btnCall = jQuery('#btn-call');
	var $btnHangUp = jQuery('#btn-hangup');
	var $btnMute = jQuery('#btn-mute');
	var $iMute = $btnMute.find('i');
	var $btnCallPrefer = jQuery("#btn-call-prefer");
	var $btnsPrefer = jQuery(".btns-prefer");
	var $hangupInfo = jQuery('.hangup-cause');

	var server = '217.174.177.12';
	var userName = '074953744984';
	var password = 'yTg4fg8UgeP';
	var outboundCallTimer = false;
	var session = null;

	var remoteAudio = new window.Audio();
	remoteAudio.autoplay = true;

	var cur_call = false;
	var timer = false;
	var seconds = 0;

	var socket = new JsSIP.WebSocketInterface('wss://cr.intelcom.su:8089/ws');
	var configuration = {
		sockets: [socket],
		uri: 'sip:' + userName + '@' + server,
		password: password,
		register: false,
		contactTransport: 'wss'
	};

	var ua = new JsSIP.UA(configuration);
	ua.start();
	var extraHeaders = [];

	var eventHandlers = {
		'progress': function (e) {
			cur_call = true;
			disableButtonsWhenCalling();
			var $callLog = jQuery('.call-log');
			$callLog.text('Идет соединение...');
			$callLog.show();
			jQuery('body').trigger('pbxConnecting');
			jQuery('.call-timer').hide();
		},
		'confirmed': function (e) {
			$iMute.removeClass('fa-microphone-slash');
			$iMute.addClass('fa-microphone');
			jQuery('.call-log').hide();
			jQuery('.call-timer').show();
			disableButtonsWhenCalling();
			if (!timer) {
				timer = setInterval(function () {
					getTime(seconds++);
				}, 1000);
			}
			jQuery('body').trigger('pbxConnected');
		},
		'ended': function (e) {
			disableButtonsWhenTerminated();
			showErrorCause(e);
		},
		'failed': function (e) {
			disableButtonsWhenTerminated();
			showErrorCause(e);
		}
	};
	var options = {
		eventHandlers: eventHandlers,
		mediaConstraints: {'audio': true, 'video': false},
		pcConfig: {rtcpMuxPolicy: 'require'},
		sessionTimersExpires: 3600,
		extraHeaders: extraHeaders
	};

	$(document).on('click', '#btn-call-prefer', function () {
		console.log('why is connect');
		initAudio();
		//startRecording();
		disableButtonsWhenCalling();
		var $callLog = jQuery('.call-log');
		$callLog.text('Идет соединение...');
		$callLog.show();
		var callInterval = setInterval(function () {
			if (ua.isConnected() && !cur_call) { console.log("!");
				session = ua.call("sip:" + $('#btn-call-prefer a').attr('data-num') + "@" + server, options);
				session.connection.addEventListener('addstream', function (e) {
					if (session) {
						document.getElementById('audio-remote').srcObject = e.stream;
					}
				});
				clearInterval(callInterval);
			}
		}, 500);

		if (outboundCallTimer === false) {
			outboundCallTimer = setInterval(function () {
				var date = new Date();
				var minutes = 60;
				date.setTime(date.getTime() + (minutes * 120 * 1000));
				$.cookie('outbound_call', Math.floor(Date.now() / 1000), {expires: date, path: '/', domain: '.leadvertex.ru'});
			}, 1000);
		}
	});

	$(document).on('click', '#btn-mute', function () {
		if (session != null) session.terminate();
		disableButtonsWhenTerminated();
	});

	$(document).on('click', '#btn-hangup', function () {
		if (session != null) {
			var hold = session.isOnHold();
			if (hold.hasOwnProperty('local') && hold.local) {
				session.unhold();
			} else {
				session.hold();
			}
		}	
	});

	function disableButtonsWhenCalling() {
		$btnCallPrefer.hide();
		$btnCallPrefer.next().hide();
		jQuery('#btn-hangup').show();
		jQuery('#btn-mute').show();
	}

	function disableButtonsWhenTerminated() {
		//stopRecording();
		cur_call = false;
		$btnCallPrefer.show();
		$btnCallPrefer.next().show();
		jQuery('#btn-hangup').hide();
		jQuery('#btn-mute').hide();
		if (timer) {
			clearInterval(timer);
			timer = false;
		}
		seconds = 0;
		jQuery('body').trigger('pbxTerminated');
		removeTimer(outboundCallTimer);
	}

	function getTime(countdown) {
		var sec_num = parseInt(countdown, 10);
		var days = Math.floor(sec_num / 86400);
		var hours = Math.floor(sec_num / 3600 - days * 24);
		var minutes = Math.floor((sec_num - (hours * 3600) - days * 86400) / 60);
		jQuery('#call-duration-min').text(wrapDigit(minutes));
		var seconds = sec_num - (hours * 3600) - days * 86400 - (minutes * 60);
		jQuery('#call-duration-sec').text(wrapDigit(seconds));
	}

	//sip line 2
	var $btnCall2 = jQuery('#btn-call2');
	var $btnHangUp2 = jQuery('#btn-hangup2');
	var $btnMute2 = jQuery('#btn-mute2');
	var $iMute2 = $btnMute2.find('i');
	var $btnCallPrefer2 = jQuery("#btn-call-prefer2");
	var $btnsPrefer2 = jQuery(".btns-prefer");
	var $hangupInfo2 = jQuery('.hangup-cause');

	var server2 = '78.47.37.119:5060';
	var userName2 = '102';
	var password2 = 'NO&*yc34fkd';
	var outboundCallTimer2 = false;
	var session2 = null;

	var remoteAudio2 = new window.Audio();
	remoteAudio2.autoplay = true;

	var cur_call2 = false;
	var timer2 = false;
	var seconds2 = 0;

	var socket2 = new JsSIP.WebSocketInterface('wss://cron.blackdollar.ru:8089/ws');
	var configuration2 = {
		sockets: [socket2],
		stun_servers: 'stun:stun.ekiga.net',
		uri: 'sip:' + userName2 + '@' + server2,
		password: password2,
		register: false,
		contactTransport: 'wss'
	};

	var ua2 = new JsSIP.UA(configuration2);
	ua2.start();
	var extraHeaders2 = [];

	var eventHandlers2 = {
		'progress': function (e) {
			cur_call = true;
			disableButtonsWhenCalling2();
			var $callLog = jQuery('.call-log');
			$callLog.text('Идет соединение...');
			$callLog.show();
			jQuery('body').trigger('pbxConnecting');
			jQuery('#btn-hangup2 .call-timer').hide();
		},
		'confirmed': function (e) {
			$iMute2.removeClass('fa-microphone-slash');
			$iMute2.addClass('fa-microphone');
			jQuery('#btn-hangup2 .call-log').hide();
			jQuery('#btn-hangup2 .call-timer').show();
			disableButtonsWhenCalling2();
			if (!timer) {
				timer = setInterval(function () {
					getTime2(seconds++);
				}, 1000);
			}
			jQuery('body').trigger('pbxConnected');
		},
		'ended': function (e) {
			disableButtonsWhenTerminated2();
			showErrorCause(e);
		},
		'failed': function (e) {
			disableButtonsWhenTerminated2();
			showErrorCause(e);
		}
	};
	var options2 = {
		eventHandlers: eventHandlers2,
		mediaConstraints: {'audio': true, 'video': false},
		pcConfig: {rtcpMuxPolicy: 'require'},
		sessionTimersExpires: 3600,
		extraHeaders: extraHeaders2
	};

	$(document).on('click', '#btn-call-prefer2', function () {
		console.log('why is connect');
		initAudio();
		//startRecording();
		disableButtonsWhenCalling2();
		var $callLog = jQuery('#btn-hangup2 .call-log');
		$callLog.text('Идет соединение...');
		$callLog.show();
		var callInterval = setInterval(function () {
			if (ua2.isConnected() && !cur_call) { console.log("!");
				session2 = ua2.call("sip:" + $('#btn-call-prefer2 a').attr('data-num').replace('+7', '8') + "@" + server2, options2);
				session2.connection.addEventListener('addstream', function (e) {
					if (session2) {
						document.getElementById('audio-remote').srcObject = e.stream;
					}
				});
				clearInterval(callInterval);
			}
		}, 500);

		if (outboundCallTimer === false) {
			outboundCallTimer = setInterval(function () {
				var date = new Date();
				var minutes = 60;
				date.setTime(date.getTime() + (minutes * 120 * 1000));
				$.cookie('outbound_call', Math.floor(Date.now() / 1000), {expires: date, path: '/', domain: '.leadvertex.ru'});
			}, 1000);
		}
	});

	$(document).on('click', '#btn-mute2', function () {
		if (session2 != null) session2.terminate();
		disableButtonsWhenTerminated2();
	});

	$(document).on('click', '#btn-hangup2', function () {
		if (session2 != null) {
			var hold = session2.isOnHold();
			if (hold.hasOwnProperty('local') && hold.local) {
				session2.unhold();
			} else {
				session2.hold();
			}
		}	
	});

	function disableButtonsWhenCalling2() {
		$btnCallPrefer2.hide();
		$btnCallPrefer2.next().hide();
		jQuery('#btn-hangup2').show();
		jQuery('#btn-mute2').show();
	}

	function disableButtonsWhenTerminated2() {
		//stopRecording();
		cur_call = false;
		$btnCallPrefer2.show();
		$btnCallPrefer2.next().show();
		jQuery('#btn-hangup2').hide();
		jQuery('#btn-mute2').hide();
		if (timer) {
			clearInterval(timer);
			timer = false;
		}
		seconds = 0;
		jQuery('body').trigger('pbxTerminated');
		removeTimer(outboundCallTimer2);
	}

	function getTime2(countdown) {
		var sec_num = parseInt(countdown, 10);
		var days = Math.floor(sec_num / 86400);
		var hours = Math.floor(sec_num / 3600 - days * 24);
		var minutes = Math.floor((sec_num - (hours * 3600) - days * 86400) / 60);
		jQuery('#call-duration-min2').text(wrapDigit(minutes));
		var seconds = sec_num - (hours * 3600) - days * 86400 - (minutes * 60);
		jQuery('#call-duration-sec2').text(wrapDigit(seconds));
	}


	//sip line 3
	var $btnCall3 = jQuery('#btn-call3');
	var $btnHangUp3 = jQuery('#btn-hangup3');
	var $btnMute3 = jQuery('#btn-mute3');
	var $iMute3 = $btnMute2.find('i');
	var $btnCallPrefer3 = jQuery("#btn-call-prefer3");
	var $btnsPrefer3 = jQuery(".btns-prefer");
	var $hangupInfo3 = jQuery('.hangup-cause');

	var server3 = 'newvats.onpbx.ru';
	var userName3 = '202-test5';
	var password3 = '9OOEbGd9';
	var outboundCallTimer3 = false;
	var session3 = null;

	var remoteAudio3 = new window.Audio();
	remoteAudio3.autoplay = true;

	var cur_call3 = false;
	var timer3 = false;
	var seconds3 = 0;

	var socket3 = new JsSIP.WebSocketInterface('wss://newvats.minipbx.ru/nv1');
	var configuration3 = {
		sockets: [socket3],
		uri: 'sip:' + userName3 + '@' + server3,
		password: password3,
		register: false,
		contactTransport: 'wss'
	};

	var ua3 = new JsSIP.UA(configuration3);
	ua3.start();
	var extraHeaders3 = [];

	var eventHandlers3 = {
		'progress': function (e) {
			cur_call = true;
			disableButtonsWhenCalling3();
			var $callLog = jQuery('#btn-hangup3 .call-log');
			$callLog.text('Идет соединение...');
			$callLog.show();
			jQuery('body').trigger('pbxConnecting');
			jQuery('#btn-hangup3 .call-timer').hide();
		},
		'confirmed': function (e) {
			$iMute3.removeClass('fa-microphone-slash');
			$iMute3.addClass('fa-microphone');
			jQuery('#btn-hangup3 .call-log').hide();
			jQuery('#btn-hangup3 .call-timer').show();
			disableButtonsWhenCalling3();
			if (!timer) {
				timer = setInterval(function () {
					getTime3(seconds++);
				}, 1000);
			}
			jQuery('body').trigger('pbxConnected');
		},
		'ended': function (e) {
			disableButtonsWhenTerminated3();
			showErrorCause(e);
		},
		'failed': function (e) {
			disableButtonsWhenTerminated3();
			showErrorCause(e);
		}
	};
	var options3 = {
		eventHandlers: eventHandlers3,
		mediaConstraints: {'audio': true, 'video': false},
		pcConfig: {rtcpMuxPolicy: 'require'},
		sessionTimersExpires: 3600,
		extraHeaders: extraHeaders3
	};

	$(document).on('click', '#btn-call-prefer3', function () {
		console.log('why is connect');
		initAudio();
		//startRecording();
		disableButtonsWhenCalling3();
		var $callLog = jQuery('#btn-hangup3 .call-log');
		$callLog.text('Идет соединение...');
		$callLog.show();
		var callInterval = setInterval(function () {
			if (ua3.isConnected() && !cur_call) { console.log("!");
				session3 = ua3.call("sip:" + $('#btn-call-prefer3 a').attr('data-num') + "@" + server3, options3);
				session3.connection.addEventListener('addstream', function (e) {
					if (session3) {
						document.getElementById('audio-remote').srcObject = e.stream;
					}
				});
				clearInterval(callInterval);
			}
		}, 500);

		if (outboundCallTimer === false) {
			outboundCallTimer = setInterval(function () {
				var date = new Date();
				var minutes = 60;
				date.setTime(date.getTime() + (minutes * 120 * 1000));
				$.cookie('outbound_call', Math.floor(Date.now() / 1000), {expires: date, path: '/', domain: '.leadvertex.ru'});
			}, 1000);
		}
	});

	$(document).on('click', '#btn-mute3', function () {
		if (session3 != null) session3.terminate();
		disableButtonsWhenTerminated3();
	});

	$(document).on('click', '#btn-hangup3', function () {
		if (session3 != null) {
			var hold = session3.isOnHold();
			if (hold.hasOwnProperty('local') && hold.local) {
				session3.unhold();
			} else {
				session3.hold();
			}
		}	
	});

	function disableButtonsWhenCalling3() {
		$btnCallPrefer3.hide();
		$btnCallPrefer3.next().hide();
		jQuery('#btn-hangup3').show();
		jQuery('#btn-mute3').show();
	}

	function disableButtonsWhenTerminated3() {
		//stopRecording();
		cur_call = false;
		$btnCallPrefer3.show();
		$btnCallPrefer3.next().show();
		jQuery('#btn-hangup3').hide();
		jQuery('#btn-mute3').hide();
		if (timer3) {
			clearInterval(timer3);
			timer3 = false;
		}
		seconds3 = 0;
		jQuery('body').trigger('pbxTerminated');
		removeTimer(outboundCallTimer3);
	}

	function getTime3(countdown) {
		var sec_num = parseInt(countdown, 10);
		var days = Math.floor(sec_num / 86400);
		var hours = Math.floor(sec_num / 3600 - days * 24);
		var minutes = Math.floor((sec_num - (hours * 3600) - days * 86400) / 60);
		jQuery('#call-duration-min3').text(wrapDigit(minutes));
		var seconds = sec_num - (hours * 3600) - days * 86400 - (minutes * 60);
		jQuery('#call-duration-sec3').text(wrapDigit(seconds));
	}

	// sip ending

	$(document).on('click', '.btns-prefer', function () {
		$.cookie('callPrefer', jQuery(this).attr('data-call'), {expires: 5})
	});
	




	function wrapDigit(digit) {
		if (digit < 10) digit = "0" + digit;
		var wrap1 = digit.toString().substr(0, 1);
		var wrap2 = digit.toString().substr(1, 1);
		return wrap1 + wrap2;
	}

	function getRandomArbitrary(min, max) {
		return Math.ceil(Math.random() * (max - min) + min);
	}

	function removeTimer(timer) {
		if (timer) {
			clearInterval(timer);
			timer = false;
		}
	}

	function showErrorCause(eventData) {
		var fromDomain = false;//window.leadvertex.pbxFromDomain;
		console.log(eventData);

		var sipStatusCode = '';
		var sipReason = '';
		var errorText = '';
		var cause = '';
		var regExp = /^Q\.850.+\"(.+)\"/gmi;
		if (eventData.message !== null) {
			if (eventData.message.hasOwnProperty('status_code')) {
				sipStatusCode = eventData.message.status_code;
			}
			if (eventData.message.hasOwnProperty('reason_phrase')) {
				sipReason = eventData.message.reason_phrase;
			}
			if (eventData.message.headers.hasOwnProperty('Reason') && eventData.message.headers.Reason.hasOwnProperty(0)) {
				var exprKeyResult = regExp.exec(eventData.message.headers.Reason[0].raw);
				if (exprKeyResult !== undefined && exprKeyResult !== null && exprKeyResult.length > 0 && exprKeyResult.hasOwnProperty(1)) {
					cause = exprKeyResult[1];
				}
			} else {
				cause = eventData.message.reason_phrase;
			}
		}
		if (eventData.hasOwnProperty('originator') && eventData.hasOwnProperty('cause')) {
			if (eventData['originator'] == 'local') {
				cause = eventData['cause'];
			}
		}

		switch (cause) {
			case 'UNALLOCATED_NUMBER':
				errorText = 'Некорректный номер или неверно указан логин в настройках!';
				break;
			case 'USER_BUSY':
				errorText = 'Абонент занят';
				break;
			case 'NO_USER_RESPONSE':
				errorText = 'Нет ответа';
				break;
			case 'NO_ANSWER':
				errorText = 'Нет ответа';
				break;
			case 'CALL_REJECTED':
				if (fromDomain != 'pbx.leadvertex.ru') {
					errorText = 'Ошибка на стороне вашего провайдера телефонии "' + fromDomain + '": Вызов отклонен';
				} else {
					errorText = 'Вызов отклонен';
				}
				break;
			case 'NORMAL_TEMPORARY_FAILURE':
				if (fromDomain != 'pbx.leadvertex.ru') {
					errorText = 'Ошибка на стороне вашего провайдера телефонии "' + fromDomain + '": Временная неработоспособность';
				} else {
					errorText = 'Временная неработоспособность';
				}
				break;
			case 'RECOVERY_ON_TIMER_EXPIRE':
				if (fromDomain != 'pbx.leadvertex.ru') {
					errorText = 'Ошибка на стороне вашего провайдера телефонии "' + fromDomain + '": Время вызова истекло';
				} else {
					errorText = 'Время вызова истекло';
				}
				break;
			case 'NORMAL_UNSPECIFIED':
				errorText = 'Нормальное состояние, не уточнено (Normal, unspecified). Повторите попытку вызова еще раз';
				break;
			case 'NORMAL_CIRCUIT_CONGESTION':
				if (sipStatusCode == 480) {
					errorText = 'Абонент отключен/недоступен';
				}
				break;
			case 'GATEWAY_DOWN':
				errorText = 'SIP-шлюз не активен, попробуйте пересохранить настройки телефонии и повторить попытку';
				break;
			case 'Device or Permission Error':
				errorText = 'Доступ к микрофону запрещен, попробуйте разрешить доступ к микрофону в настройках контента вашего браузера';
				break;
			case 'User Denied Media Access':
				errorText = 'Доступ к микрофону запрещен, попробуйте разрешить доступ к микрофону в настройках контента вашего браузера';
				break;
		}
		if (errorText == '' && cause != '' && cause != 'NORMAL_CLEARING' && cause != 'NORMAL CLEARING' && cause != 'Normal call clearing' && cause != 'Terminated' && cause != 'Canceled') {
			errorText = 'Произошла неизвестная ошибка: ' + cause;
		}
		if (fromDomain == 'pbx.leadvertex.ru') {
			switch (sipStatusCode) {
				case 603:
					errorText = 'Клиент не отвечает';
					break;
				case 402:
					errorText = 'На вашем балансе недостаточно средств для осуществления звонка';
					break;
			}
		}
		if (fromDomain == 'sipnet.ru') {
			var sipnetErrorText = '';
			switch (sipStatusCode) {
				case 480:
					if (sipReason == 'Invalid Phone Number') {
						sipnetErrorText = 'Неправильный номер телефона, не соответствует к-во цифр или неправильный код страны или города';
					}
					if (sipReason == 'Temporarily Unavailable') {
						sipnetErrorText = 'Временно недоступное направление попробуйте позвонить позже';
					}
					if (sipReason == 'No money left') {
						sipnetErrorText = 'Недостаточно денег на счете';
					}
					if (sipReason == 'No address found') {
						sipnetErrorText = 'Недостаточно денег на счете';
					}
					break;
				case 486:
					sipnetErrorText = 'Абонент занят';
					break;
				case 404:
					if (sipReason == 'Not found') {
						sipnetErrorText = 'Вызываемый абонент не найден, нет такого SIP-номера';
					}
					if (sipReason == 'Undefined Reason') {
						sipnetErrorText = 'Неопределенное направление';
					}
					if (sipReason == 'Unknown user account') {
						sipnetErrorText = 'Логин и пароль не найдены';
					}
					break;
				case 402:
					sipnetErrorText = 'На вашем балансе недостаточно средств для осуществления звонка';
					break;
			}

			if (sipnetErrorText != '') {
				errorText = 'Ошибка на стороне вашего провайдера телефонии "' + fromDomain + '": ' + sipnetErrorText;
			}
		}

		if (errorText != '') {
			var errorsFAQLink = '<a href="https://leadvertex.ru/knowledgebase/80-obrabotka-oshibok" target="_blank">Подробнее об ошибке</a>';
			$hangupInfo.find('p').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' + errorText + '<br>' + errorsFAQLink);
			$hangupInfo.fadeIn();
			setTimeout(function () {
				$hangupInfo.hide();
			}, 10000);
		}
	}
});