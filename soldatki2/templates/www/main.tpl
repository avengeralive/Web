{include file="incl/header.tpl"}
		<div class="bg"></div>
		<header class="container-fluid">
			<div class="row pc">
				<div class="col-md-3">
					<img src="/assets/images/2020/goodstory.png" class="goodstory">
				</div>
				<div class="col-md-6 text-center logosbox">
					<p style="font-size: 20px; color:#fff; text-transform: uppercase;">от создателей нашумевших сериалов</p>
					<img src="/assets/images/2020/logos.png" class="logos-logo">
				</div>
				<div class="col-md-3 text-right">
					<img src="/assets/images/2020/tnt-logo.png" class="tntlogo">
					<img src="/assets/images/2020/LOGO_TNT4_NEW_.png" class="tnt4logo">
				</div>
			</div>
			<div class="row mob">
				<div class="col-6">
					<img src="/assets/images/2020/goodstory.png" class="goodstory">
				</div>
				<div class="col-6 text-right">
					<img src="/assets/images/2020/tnt-logo.png" class="tntlogo">
					<img src="/assets/images/2020/LOGO_TNT4_NEW_.png" class="tnt4logo">
				</div>
				<div class="col-12 text-center logosbox">
					<p style="font-size: 20px; color:#fff; text-transform: uppercase;">от создателей нашумевших сериалов</p>
					<img src="/assets/images/2020/logos.png" class="logos-logo">
				</div>	
			</div>
		</header>
		<section class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h4 style="color: #fff; text-align: center; margin: 0px;">РЕГИСТРАЦИЯ НА УЧАСТИЕ В КАСТИНГЕ</h4>
					<img src="/assets/images/2020/soldatki.png" class="main-logo">
				</div>
			</div>
			<div class="row">
				<!--<div class="col-6 text-right">
					<p style="font-size: 37px; text-transform: uppercase; color: #355133; line-height: 38px;"><b>Смотри Солдатки</b><br>
НА тнт и тнт4<br>
<b>этой весной!</b></p>
				</div>
				<div class="col-6">
					<p style="font-size: 37px; text-transform: uppercase; color: #fff; line-height: 38px;">А у нас уже<br>
открыт кастинг<br>
<b>на ВТОРОЙ СЕЗОН!</b></p>
				</div>
				<div class="col-12 text-center">
					<p style="font-size: 25px; color: #fff;">Если ты хочешь в настоящую АРМИЮ или просто мечтаешь стать ЗНАМЕНИТОЙ,<br>
или ищешь ПРИКЛЮЧЕНИЙ, ОЩУЩЕНИЙ, качественных ИЗМЕНЕНИЙ,<br>
а может, у тебя есть ДРУГАЯ ПРИЧИНА?</p>

<p style="font-size: 25px; color: #fff;">Расскажи о своей мотивации и стань участницей первого в России реалити-сериала!</p>
				</div>-->
				<div class="col-12 text-center">
					<p style="font-size: 25px; color: #fff;">Если тебе от 18 до 32 лет и ты уверена, что выдержишь все тяготы и<br>
					лишения армейской жизни, то мы ищем тебя! Вне зависимости от твоего<br>
					телосложения, уровня физической подготовки и цвета волос!</p>
					<h2 style="color: #fff;">СТАНЬ ЗВЕЗДОЙ РЕАЛИТИ "СОЛДАТКИ"!</h2>
				</div>
			</div>
		</section>
		<section class="container-fluid">
			<div class="row" style="margin-bottom: 0px;">
				<div class="col-md-4"></div>
				<div class="col-md-4">
			        <form method="POST" id="anket_form" enctype="multipart/form-data">
			            <input type="hidden" name="action" value="send_anket"/>
			            <div class="row">
			                <div class="col-12">
			                    <h5 class="center">Личное дело добровольца</h5>
			                </div>
			            </div>
			            <div class="row">
			                <div class="input-field col-12">
			                    <input id="last_name" name="last_name" type="text" placeholder="Фамилия*" class="validate" value='{$inputs.last_name}'{$required}>
			                    <!--<label for="last_name">Фамилия*</label>-->
			                </div>
			                <div class="input-field col-12">
			                    <input id="first_name" name="first_name" type="text" placeholder="Имя*" class="validate" value='{$inputs.first_name}'{$required}>
			                    <!--<label for="first_name">Имя*</label>-->
			                </div>
			                <div class="input-field col-12">
			                    <input type="text" name="date_birthday" class="datepicker" placeholder="Дата рождения*" value='{$inputs.date_birthday}' {$required}>
			                    <!--<label for="birthday">Дата рождения*</label>-->
			                </div>
			                <div class="input-field col-12">
			                    <input id="email" name="email" type="text" class="validate" placeholder="E-mail*" value='{$inputs.email}'{$required} />
			                    <!--<label for="email">E-mail*</label>-->
			                </div>
			                <div class="input-field col-12">
			                    <input id="city" name="city" type="text" class="validate" placeholder="Город проживания*" value='{$inputs.city}'{$required} />
			                    <!--<label for="city">Город проживания*</label>-->
			                </div>
			                <div class="input-field col-12">
			                    <input id="phone" name="phone" type="text" class="js-mask-phone validate" placeholder="Телефон*" value='{$inputs.phone}'{$required} />
			                    <!--<label for="phone">Телефон*</label>-->
			                </div>
			                <div class="input-field col-12">
			                    <input id="citizenship" name="citizenship" type="text" class="validate" placeholder="Гражданство" value='{$inputs.citizenship}' {$required} >
			                    <!--<label for="citizenship">Гражданство</label>-->
			                    <div class="chip rus">РФ</div>
			                    <div class="chip another">ДРУГОЕ</div>
			                </div>
			            </div>
			            <div class="row">
			                <div class="col s12">
			                    <h5 class="center">Ссылки на соцсети</h5>
			                </div>
			                <div class="input-field col-12">
			                    <input id="grpSocial" name="social1" type="url" class="social-validate js-mask-url validate" placeholder="https://" value='{$inputs.social1}'/>
			                </div>
			                <div class=" input-field col-12">
			                    <input name="social2" type="url" class="social-validate js-mask-url validate" placeholder="https://" value='{$inputs.social2}'/>
			                </div>
			                <div class=" input-field col-12">
			                    <input name="social3" type="url" class="social-validate js-mask-url validate" placeholder="https://" value='{$inputs.social3}'/>
			                </div>
			            </div>


			            <div class="row">
			                <div class="col-12 js-file-upload" data-file-group="photos">
			                    <div class="file-field input-field">
			                        <div class="btn">
			                            <span>+</span>
			                            <input type="file" id="photos" name="photos[]"
			                                   accept="{$lists.ankets.files_groups.photos.form_accept}" multiple>
			                        </div>
			                        <div class="file-path-wrapper">
			                            <input class="file-path validate" type="text" placeholder="Загрузить фото">
			                        </div>
			                    </div>
			                    <div class="uploaded-files" id="files-list-photos"></div>
			                    <div class="progress blue lighten-3 file-upload-progress">
			                        <div class="indeterminate blue"></div>
			                    </div>
			                    <ul class="collection">
			                        {*<li class="collection-item"><span class="secondary-content"><i class="material-icons black-text">check</i></span>Не более 3-х фото</li>*}
			                        <li class="collection-item"><span class="secondary-content"><img
			                                        src="/assets/images/success-icon.gif"></span>Не более 3-х фото
			                        </li>
			                        <li class="collection-item"><span class="secondary-content"><img
			                                        src="/assets/images/success-icon.gif"></span>Фото в формате jpg
			                        </li>
			                        <li class="collection-item"><span class="secondary-content"><img
			                                        src="/assets/images/success-icon.gif"></span>Размер фото не должен превышать
			                            1000x1000 px
			                        </li>
			                    </ul>
			                </div>
			                <div class="col-12 js-file-upload" data-file-group="videos">
			                    <div class="file-field input-field">
			                        <div class="btn">
			                            <span>+</span>
			                            <input type="file" name="videos[]" accept="{$lists.ankets.files_groups.videos.form_accept}">
			                        </div>
			                        <div class="file-path-wrapper">
			                            <input class="file-path validate" type="text" placeholder="Загрузить видео">
			                        </div>
			                    </div>
			                    <div class="uploaded-files" id="files-list-videos"></div>
			                    <div class="progress blue lighten-3 file-upload-progress">
			                        <div class="indeterminate blue"></div>
			                    </div>
			                    <ul class="collection">
			                        <li class="collection-item"><span class="secondary-content"><img
			                                        src="/assets/images/success-icon.gif"></span>Сними короткое видео, где тебя хорошо видно и слышно, на котором ты рассказываешь ПОЧЕМУ ХОЧЕШЬ В АРМИЮ. 
			                        </li>
			                        <li class="collection-item"><span class="secondary-content"><img
			                                        src="/assets/images/success-icon.gif"></span>Не более 3-х видео
			                        </li>
			                        <li class="collection-item"><span class="secondary-content"><img
			                                        src="/assets/images/success-icon.gif"></span>Размер видео не должен превышать
			                            1гб
			                        </li>
			                        <li class="collection-item"><span class="secondary-content"><img
			                                        src="/assets/images/success-icon.gif"></span>*Без видео анкеты не принимаются
			                        </li>
			                    </ul>
			                </div>
			            </div>

			            <div class="row adds">
			                <div class="col-12">
			                    <h5 class="center">Дополнительная информация</h5>
			                </div>
			            </div>
			            <div class="row adds">
			                <div class="col-12">
			                    1. В какой ты физической форме сейчас?
			                </div>
			                <div class="input-field col-12">
			                    <input class="with-gap" name="men_participate" type="text" value='{$inputs.men_participate}'>
			                </div>
			            </div>
			            <div class="row adds">
			                <div class="col-12">
			                    2. Состоишь ли ты в отношениях?
			                </div>
			                <div class="input-field col-12">
			                    <input class="with-gap" name="men_army" type="text" value='{$inputs.men_army}'>
			                </div>
			            </div>
			            <div class="row adds">
			                <div class=" col-12">
			                    3. Есть ли у тебя вредные привычки? Если ДА, то какие?
			                </div>
			                <div class="input-field col-12">
			                    <input id="men_city" name="men_city" type="text" class="validate" name="men_city" value='{$inputs.men_city}'>
			                </div>
			            </div>
			            <div class="row adds">
			                <div class="col-12">
			                    4. Снималась ли ранее в телепроектах? Если ДА, то в каких?
			                </div>
			                <div class="input-field col-12">
			                    <input name="men_social1" type="text" class="validate" value='{$inputs.men_social1}'/>
			                </div>
			                <!--<div class="input-field col-12">
			                    <input name="men_social2" type="text" class="validate" value='{$inputs.men_social2}'/>
			                </div>
			                <div class="input-field col-12">
			                    <input name="men_social3" type="text" class="validate" value='{$inputs.men_social3}'/>
			                </div>-->
			            </div>

			            <div class="row ">
			                <div class="col-12" style="display: flex;">
			                    <input style="margin: auto;" type="submit" id="js-form-submit"
			                           class="btn" value="Отправить анкету"/>
			                </div>
			                <div class="col-12">
			                    <div style="background: white;padding: 1em; border-radius: 10px; margin-top: 40px;" class="confirmation-text-box">
			                        <input type="checkbox" name="confirm_personal_process" class="filled-in" id="confirm-personal-process"{$required}{if isset($smarty.post.confirm_personal_process)}{$checked}{/if} />
			                        <label for="confirm-personal-process" style="font-size: smaller; color:#d90a72;">Я подтверждаю свое согласие с условиями
			                            <a class="js-word" href="https:{$smarty.const.URL_GDOCS_VIEW}{$smarty.const.HTTP}{$smarty.server.HTTP_HOST}/assets/termsofuse.doc&embedded=true">
			                                <span style="color: #FF0000;text-decoration: underline">пользовательского соглашения</span></a>
			                            и даю согласие на обработку моих персональных данных, содержащихся в
			                            анкете.
			                        </label>
			                    </div>
			                </div>
			                <div class="col-12" style="margin-top: 1em;">
			                    <div style="background: none;padding: 0.5em;">
			                       <span style="font-size: 8px;color: #fff;">Если по какой-то причине ваша анкета не отправляется, пришлите свои данные на почту armygirls@mail.ru Информация по телефону 89262467988 
			                           </span>
			                    </div>
			                </div>
			            </div>

			            <div class="row js-loading">
			                <div class="col s12">
			                    <div class="progress blue lighten-3">
			                        <div class="indeterminate blue"></div>
			                    </div>
			                </div>
			            </div>

			        </form>
		    	</div>
		    	<div class="col-md-4"></div>
		    </div>
		</section>
{include file="incl/footer.tpl"}