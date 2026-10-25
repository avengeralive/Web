
    <div class="modal modal--login js-modal" id="js-modal-login">
        <h2 class="modal__title">Авторизация</h2>
        <form name="login_form" class="login-form" action="./" id="loginForm" method="post">
            <p class="errormsgLogin"></p>
            <div class="form-group">
                <input class="login-form__input" type="text" name="login_email" placeholder="Ваш e-mail" required maxlength="40">
            </div>
            <div class="form-group">
                <input class="login-form__input" type="password" name="login_password" placeholder="Ваш пароль" required maxlength="40">
            </div>
            <div class="clearfix">
                <a class="login-form__link login-form__link--green js-login-btn" href="#js-modal-access">Забыл пароль</a>
                <a class="login-form__link login-form__link--blue js-login-btn" href="#js-modal-registr">Регистрация</a>
            </div>
            <button class="login-form__btn" name="login_submit" type="submit">Войти</button>
        </form>
        <a href="#" class="close__btn js-modal-close"></a>
    </div>
    <div class="modal modal--registr js-modal" id="js-modal-registr">
        <h2 class="modal__title">Регистрация</h2>
        <form name="registration_form" class="reg-form" action="./" id="regForm" method="post" onsubmit="yaCounter40021805.reachGoal('reg'); return true;">
            <p class="errormsgLogin"></p>
            <div class="form-group" style="margin-bottom: 25px;margin-top: -15px;">
                <input class="login-form__input" type="text" name="registration_email" placeholder="Ваш e-mail" required>
            </div>
            <div class="form-group" style="margin-bottom: 25px;">
                <input class="login-form__input" type="text" name="registration_skype" placeholder="Skype" required>
            </div>            
            <div class="form-group" style="margin-bottom: 25px;">
                <input class="login-form__input" id="registration_password_1" type="password" name="registration_password_1" placeholder="Желаемый пароль" required>
            </div>
            <div class="form-group" style="margin-bottom: 25px;">
                <input class="login-form__input" type="password" name="registration_password_2" placeholder="Пароль повторно" required>
            </div>
            <div class="reg-form-group clearfix" style="margin-bottom: 25px;">
                <input class="reg-form__radio" id="reg1" type="radio" name="registration_tip" value="10" checked>
                <label class="reg-form__label reg-form__label--radio reg-form__label--green" for="reg1">Я вебмастер</label>
                <input class="reg-form__radio" id="reg2" type="radio" name="registration_tip" value="40">
                <label class="reg-form__label reg-form__label--radio" for="reg2">Я продавец</label>
            </div>
            <div class="reg-form-group">
                <input class="reg-form__checkbox" id="reg3" type="checkbox" name="registration_agree_rules" checked>
                <!-- <label class="reg-form__label" for="reg3">Принимаю <a class="js-rules-btn" href="#js-modal-rules">правила</a> системы</label> -->
            </div>
            <button class="login-form__btn" type="submit" name="registration_submit">Зарегистрироваться</button>
        </form>
        <a href="#" class="close__btn js-modal-close"></a>
    </div>
    <div class="modal modal--privacy js-modal" id="js-modal-privacy">
        <h2 class="modal__title">Политика конфиденциальности</h2>
        <div class="privacy-txt js-scroll">
            <p>Регистрируя новый аккаунт в системе, вы обязуетесь использовать функционал системы только по прямому назначению, и даете согласие на получение от нас e-mail и смс-рассылок о новых офферах, акциях и специальных предложениях.</p>
            <p>Ваши персональные данные не передаются третьим лицам.</p>
            <p class="privacy-txt--green">Техподдержка</p>
            <p>
				<?php 
				// Данные выводятся из базы MySQL, таблица "settings"
				// Data is output from the MySQL database, table "settings"
				if (isset($settings_icq) && $settings_icq!='') 
					{echo $loc['contacts.php']['t06'].'&nbsp;'.$settings_icq.'<br />';}
				if (isset($settings_skype) && $settings_skype!='') 
					{echo $loc['contacts.php']['t07'].'&nbsp;<a href="skype:'.$settings_skype.'?add">'.$settings_skype.'</a><br />';}
				if (isset($settings_email) && $settings_email!='') 
					{echo $loc['contacts.php']['t08'].'&nbsp;<a href="mailto:'.$settings_email.'">'.$settings_email.'</a><br />';}
				if (isset($settings_phone) && $settings_phone!='') 
					{echo $loc['contacts.php']['t09'].'&nbsp;'.$settings_phone.'<br />';}
				?>						
			</p>
        </div>
        <a href="#" class="close__btn js-modal-close"></a>
    </div>
    <div class="modal modal--access js-modal" id="js-modal-access">
        <h2 class="modal__title">Восстановление доступа</h2>
        <form class="access-form"  id="accessForm" action="./recover.php" name="recover_form" method="post">
            <p class="errormsgLogin"></p>
            <div class="form-group">
                <input class="login-form__input" type="text" name="recover_email" placeholder="Ваш e-mail" required>
            </div>
            <button class="login-form__btn" type="submit" name="recover_submit">Продолжить</button>
        </form>
        <a href="#" class="close__btn js-modal-close"></a>
    </div>
    <div class="modal modal--privacy js-modal" id="js-modal-rules">
        <h2 class="modal__title">Правила системы</h2>
        <div class="privacy-txt js-scroll">
			<p>
				<b>Правила системы и политика конфиденциальности</b>
			</p>
			<p>
				&nbsp;
			</p>
			<p>
				Регистрируя новый аккаунт в системе, Вы обязуетесь использовать функционал системы только по прямому назначению, и даете согласие на получение от нас e-mail и смс-рассылок о новых офферах, акциях и специальных предложениях.<br /><br />Ваши персональные данные не передаются третьим лицам.</p>
			<p>
				&nbsp;
			</p>
			<p>
				<b>УВЕДОМЛЕНИЕ ОБ ОТВЕТСТВЕННОСТИ</b>
			</p>
			<p>
				&nbsp;
				</p>
			<p>
				Предлагаемые товары и услуги предоставляются не по заказу лица либо предприятия, эксплуатирующего систему WebMoney Transfer. Мы являемся независимым предприятием, оказывающим услуги, и самостоятельно принимаем решения о ценах и предложениях. Предприятия, эксплуатирующие систему WebMoney Transfer, не получают комиссионных вознаграждений или иных вознаграждений за участие в предоставлении услуг и не несут никакой ответственности за нашу деятельность.<br /><br />Аттестация, произведенная со стороны WebMoney Transfer, лишь подтверждает наши реквизиты для связи и удостоверяет личность. Она осуществляется по нашему желанию и не означает, что мы каким-либо образом связаны с продажами операторов системы WebMoney.</p>
			<p>
				&nbsp;
			</p>
           <p class="privacy-txt--green">Техподдержка</p>
            <p>
				<?php 
				// Данные выводятся из базы MySQL, таблица "settings"
				// Data is output from the MySQL database, table "settings"
				if (isset($settings_icq) && $settings_icq!='') 
					{echo $loc['contacts.php']['t06'].'&nbsp;'.$settings_icq.'<br />';}
				if (isset($settings_skype) && $settings_skype!='') 
					{echo $loc['contacts.php']['t07'].'&nbsp;<a href="skype:'.$settings_skype.'?add">'.$settings_skype.'</a><br />';}
				if (isset($settings_email) && $settings_email!='') 
					{echo $loc['contacts.php']['t08'].'&nbsp;<a href="mailto:'.$settings_email.'">'.$settings_email.'</a><br />';}
				if (isset($settings_phone) && $settings_phone!='') 
					{echo $loc['contacts.php']['t09'].'&nbsp;'.$settings_phone.'<br />';}
				?>			
			</p>
        </div>
        <a href="#" class="close__btn js-modal-close"></a>
    </div>
	