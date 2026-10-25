<?php namespace lib;
	if (!defined('VOCU_FWK')) die();
	if (!in_array('user', $RoleGroup) && !in_array('user', $RoleUser)) die();

$userarr = CUser::getMe();

$avatar = ($userarr['avatar'] == 'nophoto.png') ? '/cdn/lib/man.png' : '/'. $userarr['avatar'];

echo '<div class="flex profile">
	<div>
		<div ava class="hex"><img class="hex-img" id="photo_user" src="'. $avatar .'"><span class="delete_ava">&times;</span>
	</div>
	<form method="post" action="json.php">
		<div><input type="hidden" value="CUser" name="func" /></div>
		<div><input type="hidden" value="saveAll" name="action" /></div>
		<div><input type="hidden" value="'. $JSCat['token'] .'" name="token" /></div>
		<div><input type="hidden" value="'. $JSCat['domain'] .'" name="domain" /></div>
		<div><input type="text" value="'. $userarr['name'] .'" id="name" name="name" placeholder="Ваше имя" /></div>
		<div><input type="text" value="'. $userarr['job'] .'" id="job" name="job" placeholder="Должность" /></div>
		<div><input type="text" value="'. $userarr['phone'] .'" id="phone" name="phone" placeholder="+7 (999) 999-99-99" /></div>
		<div><input type="text" value="'. $userarr['email'] .'" id="email" name="email" placeholder="mail@mail.ru" /></div>
		<button type="submit" id="href">Обновить данные профиля</button>
	</form>
	</div>
	<div>
		<div><textarea id="textarea" type="text" value="'. $userarr['textarea'] .'" placeholder="Дополнительно"></textarea></div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr><td colspan="2"><h3>Изменение учетных данных</h3></td></tr>
			<tr id="login_user"><td>Логин</td><td><span class="buffer"><input id="login" type="text" value="'. $userarr['username'] .'"/><span class="input-buffer"></span><btn>Сохранить</btn></span></td></tr>
			<tr id="pass_old"><td>Старый пароль</td><td><span class="buffer"><input type="password"/><span class="input-buffer"></span></span></td></tr>
			<tr id="pass_new"><td>Новый пароль</td><td><span class="buffer"><input type="password"/><span class="input-buffer"></span></span></td></tr>
			<tr id="pass_new2"><td>Новый пароль еще раз</td><td><span class="buffer"><input type="password"/><span class="input-buffer"></span><btn>Сохранить</btn></span></td></tr>
		</table>		
	</div>
</div>'; 
?>


<script>
	
	function profile(params) {
		$.extend(this.options, params);
	}
	
	profile.prototype = {
		cfg: {
			selectors: {
				name_user: 'name_user',
				job_user: 'job_user',
				phone_user: 'phone_user',
				photo_user: 'photo_user',
				delete_ava: 'delete_ava',
				login_user: 'login_user',
				email_user: 'email_user',
				pass_old: 'pass_old',
				pass_new: 'pass_new',
				pass_new2: 'pass_new2'
			}
		},
		start: function() {
			$('#phone').mask('+7 (999) 999-99-99');
			//$('#href').click(profile.action.saveAll.bind(this));
			$('#'+ profile.cfg.selectors.photo_user).click(profile.action.photo_user.bind(this));	
			$('#'+ profile.cfg.selectors.pass_old).click(profile.action.rename.bind(this, profile.cfg.selectors.pass_old));
			$('#'+ profile.cfg.selectors.pass_new).click(profile.action.rename.bind(this, profile.cfg.selectors.pass_new));
			$('#'+ profile.cfg.selectors.pass_new2).click(profile.action.rename.bind(this, profile.cfg.selectors.pass_new2));
			$('#'+ profile.cfg.selectors.login_user).click(profile.action.rename.bind(this, profile.cfg.selectors.login_user));
			$('#'+ profile.cfg.selectors.email_user).click(profile.action.rename.bind(this, profile.cfg.selectors.email_user));
			$( '.' + profile.cfg.selectors.delete_ava ).click(profile.action.delete_ava.bind(this));
		},
		action: {
			rename: function(id) {
				var input = $('#'+ id +' input');
				    input.css("border-color", "#d2d2d2");
				var buffer = $('#'+ id +' .input-buffer');
				var btn = $('#'+ id +' btn');
				input.focus();
				if (id == profile.cfg.selectors.phone_user) btn.css("opacity", "1");
				input.on('input', function() {
					var item = $(this);
				    buffer.text(item.val());
				    item.width(buffer.width()).css("border-color", "#d2d2d2");
        			btn.css("opacity", "1");
				});
    			btn.unbind().click(function() {
					var value = input.val();
					input.css("border-color", "transparent");
					btn.css('opacity', '0');
					if (id == profile.cfg.selectors.login_user) profile.action.savelogin(profile.cfg.selectors.login_user);
					if (id == profile.cfg.selectors.phone_user) profile.action.save(profile.cfg.selectors.phone_user);
					if (id == profile.cfg.selectors.email_user) profile.action.save(profile.cfg.selectors.email_user);
					if (id == profile.cfg.selectors.name_user) profile.action.save(profile.cfg.selectors.name_user);
					if (id == profile.cfg.selectors.pass_new2) profile.action.changepass();
					if (id == profile.cfg.selectors.passnow) profile.action.deleteme();
					return false;
				});
				return false;
			},
			save: function(id) {
				var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
				json["action"] 	= "saveMe";
				json["param"] 	= [id, $( '#' + id + ' input' ).val()];
				$.post("/json/", json, function(result) {
					if (typeof result !== 'object' ) result = JSON.parse(result);
					alert(result);
					return false;
				});
				return false;
			},
// 			saveAll: function() {
// 				var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
// 				json["action"] = "saveAll";
// 				json["job"] 	= $('#job').val();
// 				json["name"] 	= $('#name').val();
// 				json["phone"] 	= $('#phone').val();
// 				json["email"] 	= $('#email').val();
// 				$.post("/json/", json, function(result) {
// 					if (typeof result !== 'object' ) result = JSON.parse(result);
// 					alert(result);
// 					return false;
// 				});
// 				return false;
// 			},
			savelogin: function(id) {
				confirm({
					text: "При изменении учетных данных, вам нужно будет авторизоваться заново. Продолжить?",
					ok: function () {
						var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
						json["action"] 	= "saveMe";
						json["param"] 	= [id, $( '#' + id + ' input' ).val()];
						$.post("/json/", json, function(result) {
							if (typeof result !== 'object' ) result = JSON.parse(result);
							if (result != 'Выполнено') alert(result);
							else profile.action.logoutdone();
							return false;
						});
					}
				});
				return false;
			},
			logoutdone: function() {
				setTimeout(function() {
					location.href = '/?logout&logoutAll';
				}, 1e3);
			},
			delete_ava: function() {
				var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
				json["action"] = "removeAvatar";
				$.post("/json/", json, function() {
					$('#photo_user').attr('src','/cdn/lib/man.png');
				});
			},
			photo_user: function() {
				lib("image", {content:"#cabinet"});
			},
			changepass: function() {
				confirm({
					text: "При изменении учетных данных, вам нужно будет авторизоваться заново. Продолжить?",
					ok: function() {
						var old = md5($( '#pass_old input' ).val()).toUpperCase();
						var new1 = md5($( '#pass_new input' ).val()).toUpperCase();
						var new2 = md5($( '#pass_new2 input' ).val()).toUpperCase();
						if (new1 == new2) {
							var json = {func:'CUser', domain:JSCat.domain, token:JSCat.token};
							json["action"] = "changePass";
							json["param"] = [old, new1];
							$.post("/json/", json, function(result) {
								if (typeof result !== 'object' ) result = JSON.parse(result);
								if (result != 'Выполнено') alert(result)
								else profile.action.logoutdone();
								return false;
							});
						} else alert("Новые пароли не совпадают");
					}
				});
				return false;
			}
		}
	}

	$(function() {
		profile = new profile();
		profile.start();
	});
</script>
