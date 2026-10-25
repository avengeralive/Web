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
        <form class="col s12 m12 l12 xl8 offset-xl2" method="POST" id="anket_form" enctype="multipart/form-data">
            <input type="hidden" name="action" value="send_anket"/>
            {*<div class="col s12 m12 l12 xl8 offset-xl2">*}

            <div class="row">
                <div class="col s12">
                    <h5 class="center">Личное дело добровольца</h5>
                </div>
            </div>

            <div class="row">
                <div class="input-field col m12 s12">
                    <input id="last_name" name="last_name" type="text" class="validate"
                           value='{$inputs.last_name}'{$required}>
                    <label for="last_name">Фамилия*</label>
                </div>
                <div class="input-field col m12 s12">
                    <input id="first_name" name="first_name" type="text" class="validate"
                           value='{$inputs.first_name}'{$required}>
                    <label for="first_name">Имя*</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col m12 s12">
                    <input type="text" name="date_birthday" class="datepicker"
                           value='{$inputs.date_birthday}' {$required}>
                    <label for="birthday">Дата рождения*</label>
                </div>
                <div class="input-field col m12 s12">
                    <input id="email" name="email" type="text" class="validate" value='{$inputs.email}'{$required} />
                    <label for="email">E-mail*</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col m12 s12">
                    <input id="city" name="city" type="text" class="validate" value='{$inputs.city}'{$required} />
                    <label for="city">Город проживания*</label>
                </div>
                <div class="input-field col m12 s12">
                    <input id="phone" name="phone" type="text" class="js-mask-phone validate"
                           value='{$inputs.phone}'{$required} />
                    <label for="phone">Телефон*</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col m12 s12">
                    <input id="citizenship" name="citizenship" type="text" class="validate"
                           value='{$inputs.citizenship}' {$required} >
                    <label for="citizenship">Гражданство</label>
                    <div class="chip rus">РФ</div>
                    <div class="chip another">ДРУГОЕ</div>
                </div>
                <!--<div class="col m12 s12" style="padding: 1em;">
                    <div class="chip rus">Россия</div>
                    <div class="chip another">другое</div>
                </div>-->

                {*<div class="input-field col s6">*}
                {*<input id="citizenship" name="citizenship" type="text" class="validate" value='{$inputs.citizenship}'>*}
                {*<label for="citizenship">Гражданство</label>*}
                {*</div>*}
                {*<div class="col s6">*}
                {*{foreach $lists.ankets.citizenships as $citizenship_tpl}*}
                {*<div class="chip">{$citizenship_tpl}</div>*}
                {*{/foreach}*}
                {*</div>*}

            </div>
            <div class="row">
                <div class="col s12">
                    <h5 class="center">Ссылки на соцсети</h5>
                </div>
                <div class="input-field col s12">

                    <input id="grpSocial" name="social1" type="url"
                           class="social-validate js-mask-url validate" value='{$inputs.social1}'/>
                </div>
                <div class=" input-field col s12">
                    <input name="social2" type="url" class="social-validate js-mask-url validate "
                           value='{$inputs.social2}'/>
                </div>
                <div class=" input-field col s12">
                    <input name="social3" type="url" class="social-validate js-mask-url validate "
                           value='{$inputs.social3}'/>
                </div>
            </div>


            <div class="row">
                <div class="col m12 s12 js-file-upload" data-file-group="photos">
                    <div class="file-field input-field">
                        <div class="btn white black-text">
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
                <div class="col m12 s12 js-file-upload" data-file-group="videos">
                    <div class="file-field input-field">
                        <div class="btn white black-text">
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
                                        src="/assets/images/success-icon.gif"></span>Сними короткое видео, где ты
                            рассказываешь о себе и о том,
                            почему хочешь служить в армии. Креатив и импровизация приветствуются.
                        </li>
                        <li class="collection-item"><span class="secondary-content"><img
                                        src="/assets/images/success-icon.gif"></span>Не более 3-х видео
                        </li>
                        <li class="collection-item"><span class="secondary-content"><img
                                        src="/assets/images/success-icon.gif"></span>Размер видео не должен превышать
                            1гб
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <h5 class="center">Дополнительная информация</h5>
                </div>
            </div>
            <div class="row">
                <div class="col  m12 s12">
                    1. В какой ты физической форме сейчас?
                </div>
                <div class="input-field col  m12 s12">
                    <input class="with-gap" name="men_participate" type="text" value='{$inputs.men_participate}'>
                </div>
            </div>
            <div class="row">
                <div class=" col  m12 s12">
                    2. Есть ли у тебя молодой человек?
                </div>
                <div class="input-field col  m12 s12">
                    <input class="with-gap" name="men_army" type="text" value='{$inputs.men_army}'>
                </div>
            </div>
            <div class="row">
                <div class=" col  m12 s12">
                    3. Есть ли у тебя вредные привычки? Если ДА, то какие?
                </div>
                <div class="input-field col  m12 s12">
                    <input id="men_city" name="men_city" type="text" class="validate" name="men_city"
                           value='{$inputs.men_city}'>
                </div>
            </div>
            <div class="row">
                <div class="col  s12">
                    4. Снималась ли ранее в телепроектах? Если ДА, то в каких?
                </div>
                <div class="input-field col  s12">
                    <input name="men_social1" type="text" class="validate" value='{$inputs.men_social1}'/>
                </div>
                <div class="input-field col s12">
                    <input name="men_social2" type="text" class="validate" value='{$inputs.men_social2}'/>
                </div>
                <div class="input-field col s12">
                    <input name="men_social3" type="text" class="validate" value='{$inputs.men_social3}'/>
                </div>
            </div>

            <div class="row ">
                <div class="col m12 s12" style="display: flex;">
                    <input style="margin: auto;" type="submit" id="js-form-submit"
                           class="waves-effect waves-light btn black white" value="Отправить анкету"/>
                </div>
                <div class="col m12 s12">
                    <div style="background: white;padding: 1em; border-radius: 10px; margin-top: 40px;" class="confirmation-text-box">
                        <input type="checkbox" name="confirm_personal_process" class="filled-in"
                               id="confirm-personal-process"{$required}{if isset($smarty.post.confirm_personal_process)}{$checked}{/if} />
                        <label for="confirm-personal-process" class="black-text" style="font-size: smaller">Я
                            подтверждаю свое согласие с условиями
                            <a class="js-word" href="https:{$smarty.const.URL_GDOCS_VIEW}{$smarty.const.HTTP}{$smarty.server.HTTP_HOST}/assets/termsofuse.doc&embedded=true">
                                <span style="color: #FF0000;text-decoration: underline">пользовательского соглашения</span></a>
                            и даю согласие на обработку моих персональных данных, содержащихся в
                            анкете.

                        </label>
                    </div>
                </div>
                <div class="col s12" style="margin-top: 1em;">
                    <div style="background: none;padding: 0.5em;">
                       <span style="font-size: 12px;">Если по какой-то причине ваша анкета не отправляется, пришлите свои данные на почту armygirls@mail.ru
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

            {*<div class="row">*}
            {*<div class="col s12">*}
            {*<i>Если по каким-либо причинам не удалось отправить анкету, сообщите нам об этом на e-mail*}
            {*{mailto address=$smarty.const.ANKET_CONTACT_EMAIL encode="javascript_charcode"}</i>*}
            {*</div>*}
            {*</div>*}
            {*</div>*}

        </form>
    </div>
</div>
