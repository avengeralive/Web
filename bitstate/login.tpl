{include file="header.tpl"}
	{literal}
	<script language=javascript>
	function checkform() {
	  if (document.mainform.username.value=='') {
	    alert("Please type your username!");
	    document.mainform.username.focus();
	    return false;
	  }
	  if (document.mainform.password.value=='') {
	    alert("Please type your password!");
	    document.mainform.password.focus();
	    return false;
	  }
	  return true;
	}
	</script>
	{/literal}

	{if $frm.say eq 'invalid_login'}
		<h1>Login error:</h1><br />
		<p>Your login or password or turing image code is wrong. Please check this information.</p><br />
	{/if}
	<form class="form" method=post name=mainform onsubmit="return checkform()">
		<h1>Login:</h1><br />
		<input type=hidden name=a value='do_login'>
		<input type=hidden name=follow value='{$frm.follow}'>
		<input type=hidden name=follow_id value='{$frm.follow_id}'>
		<div class="field clearfix">
			<label for="username">Username:</label>
			<div class="text-field"><div><input type=text name=username value='{$frm.username|escape:"html"}' class=inpts size=30></div></div>
		</div>		
		<div class="field clearfix">
			<label for="password">Password:</label>
			<div class="text-field"><div><input type=password name=password value='' class=inpts size=30></div></div>
		</div>	
		{if $userinfo.validation_enabled == 1}
			<img src="?a=show_validation_image&{$userinfo.session_name}={$userinfo.session_id}&rand={$userinfo.rand}">
			<div class="text-field">/div><input type=text name=validation_number class=inpts size=30></div></div>
		{/if}
		<br />
		<div class="clearfix">
			<div class="submit submit-ml"><div><input type="submit" value="Login" /></div></div>
		</div>
	</form>
	<br /><br />
	or <a href=?a=forgot_password >remember your login information</a>.
	<br /><br /><br />
{include file="footer.tpl"}
