

		<div class="section anket">

			{if !empty($errors)}
			<div class="row">
				{foreach $errors as $error}
				<div class="col s12 m12 l12 xl8 offset-xl2">
					<li class="red-text">{$error}</li>
				</div>
				{/foreach}
			</div>
			{/if}

			{if !empty($notices)}
			<div class="row">
				{foreach $notices as $notice}
				<div class="col s12 m12 l12 xl8 offset-xl2">
					<li class="green-text">{$notice}</li>
				</div>
				{/foreach}
			</div>
			{/if}

			<div class="row">
				<form method="POST" id="anket_form" enctype="multipart/form-data">
					<input type="hidden" name="action" value="send_anket" />
					<div class="col s12 m12 l12 xl8 offset-xl2">

						<div class="row">
							<div class="col s12">
								<h5 class="center">Личное дело добровольца</h5>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s6">
								<input id="last_name" name="last_name" type="text" class="validate" value='{$inputs.last_name}'{$required}>
								<label for="last_name">Фамилия*</label>
							</div>
							<div class="input-field col s6">
								<input id="first_name" name="first_name" type="text" class="validate" value='{$inputs.first_name}'{$required}>
								<label for="first_name">Имя*</label>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s6">
								<input type="text" name="date_birthday" class="datepicker" value='{$inputs.date_birthday}' {$required}>
								<label for="birthday">Дата рождения*</label>
							</div>
							<div class="input-field col s6">
								<input id="email" name="email" type="text" class="validate" value='{$inputs.email}'{$required} />
								<label for="email">E-mail*</label>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s6">
								<input id="city" name="city" type="text" class="validate" value='{$inputs.city}'{$required} />
								<label for="city">Город*</label>
							</div>
							<div class="input-field col s6">
								<input id="phone" name="phone" type="text" class="js-mask-phone validate" value='{$inputs.phone}'{$required} />
								<label for="phone">Телефон*</label>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s6">
								<input id="citizenship" name="citizenship" type="text" class="validate" value='{$inputs.citizenship}'>
								<label for="citizenship">Гражданство</label>
							</div>
							<div class="col s6">
								{foreach $lists.ankets.citizenships as $citizenship_tpl}
									<div class="chip">{$citizenship_tpl}</div>
								{/foreach}
							</div>
						</div>

						<div class="row">
							<div class="input-field col s12">
								<label>Ссылки на соцсети</label>
								<input name="social1" type="text" class="validate s2 m3" value='{$inputs.social1}' />
								<input name="social2" type="text" class="validate s2 m3" value='{$inputs.social2}' />
								<input name="social3" type="text" class="validate s2 m3" value='{$inputs.social3}' />
							</div>
						</div>

						<div class="row">
							<div class="col s12 m6 js-file-upload" data-file-group="photos">
								<div class="file-field input-field">
									<div class="btn blue">
										<span>+</span>
										<input type="file" name="photos[]" accept="{$lists.ankets.files_groups.photos.form_accept}">
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
									<li class="collection-item"><span class="secondary-content"><i class="material-icons">check</i></span>Не более 3-х фото</li>
									<li class="collection-item"><span class="secondary-content"><i class="material-icons">check</i></span>Фото в формате jpg</li>
									<li class="collection-item"><span class="secondary-content"><i class="material-icons">check</i></span>Размер фото не должен превышать 1000x1000 px</li>
								</ul>
							</div>
							<div class="col s12 m6 js-file-upload" data-file-group="videos">
								<div class="file-field input-field">
									<div class="btn blue">
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
									<li class="collection-item"><span class="secondary-content"><i class="material-icons">check</i></span>В видео нужно рассказать о себе и о своих отношениях. Креатив и импровизация приветствуются.</li>
									<li class="collection-item"><span class="secondary-content"><i class="material-icons">check</i></span>Не более 3-х видео</li>
									<li class="collection-item"><span class="secondary-content"><i class="material-icons">check</i></span>Размер видео не должен превышать 1гб</li>
								</ul>
							</div>
						</div>

						<div class="row">
							<div class="col s12">
								<h5 class="center">Дополнительная информация</h5>
							</div>
						</div>
						<div class="row">
							<div class="col s6">
								1. Готов ли твой молодой человек принять участие в съемках?
							</div>
							<div class="col s6">
								<input class="with-gap" name="men_participate" type="radio" id="anket_participate_1" value="1"{if !empty($inputs.men_participate)}{$checked}{/if} />
								<label for="anket_participate_1">Да</label>
								<input class="with-gap" name="men_participate" type="radio" id="anket_participate_0" value="0"{if empty($inputs.men_participate)}{$checked}{/if} />
								<label for="anket_participate_0">Нет</label>
							</div>
						</div>
						<div class="row">
							<div class="col s6">
								2. Прошел ли он службу в армии?
							</div>
							<div class="col s6">
								<input class="with-gap" name="men_army" type="radio" id="anket_army_1" value="1"{if !empty($inputs.men_army)}{$checked}{/if} />
								<label for="anket_army_1">Да</label>
								<input class="with-gap" name="men_army" type="radio" id="anket_army_0" value="0"{if empty($inputs.men_army)}{$checked}{/if} />
								<label for="anket_army_0">Нет</label>
							</div>
						</div>
						<div class="row">
							<div class="col s6">
								3. В каком городе он живет?
							</div>
							<div class="input-field input-line col s6">
								<input id="men_city" name="men_city" type="text" class="validate" name="men_city" value='{$inputs.men_city}'>
							</div>
						</div>
						<div class="row">
							<div class="col s12">
								4. Ссылки на профили твоего парня в соцсетях
							</div>
							<div class="input-field col s12">
								<input name="men_social1" type="text" class="validate" value='{$inputs.men_social1}' />
								<input name="men_social2" type="text" class="validate" value='{$inputs.men_social2}' />
								<input name="men_social3" type="text" class="validate" value='{$inputs.men_social3}' />
							</div>
						</div>

						<div class="row">
							<div class="col s7 xl5">
								<input type="submit" id="js-form-submit" class="waves-effect waves-light btn blue" value="Отправить анкету" />
							</div>
							<div class="col s5 xl7">
								<input type="checkbox" name="confirm_personal_process" class="filled-in" id="confirm-personal-process"{$required}{if isset($smarty.post.confirm_personal_process)}{$checked}{/if} />
								<label for="confirm-personal-process">Я подтверждаю свое согласие на обработку моих персональных данных, содержащихся в анкете</label>
							</div>
						</div>

						<div class="row js-loading">
							<div class="col s12">
								<div class="progress blue lighten-3">
									<div class="indeterminate blue"></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12">
								<i>Если по каким-либо причинам не удалось отправить анкету, сообщите нам об этом на e-mail
								{mailto address=$smarty.const.ANKET_CONTACT_EMAIL encode="javascript_charcode"}</i>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
