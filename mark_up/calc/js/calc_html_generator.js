function removeExistingTags(){
    $('#tablist li').remove();    
    $('#checkbox div').remove();
}
function cancelCheckboxes(id){   
    $(id).prop("checked",  false);
    $(id).parents('label').removeClass('active');
    let img  = $(id).next('i').find('img');
    img.removeClass('filter_black');
    img.addClass('filter_white');
}
function fillCheckboxes(id){   
    $(id).prop("checked", "checked");
    $(id).parents('label').addClass('active');
}
function loadAdminPanelType(startFromStep = 2){
    removeExistingTags();
    generateCheckboxAndTabs(adminPanelType, startFromStep);
    generateSendRequestCheckboxAndTab(adminPanelType.length);
    fillCheckboxes("#platform_web");
    fillCheckboxes("#type_admin_panel");
}
function loadShopType(startFromStep = 2){
    removeExistingTags();
    generateCheckboxAndTabs(shopType, startFromStep);
    generateSendRequestCheckboxAndTab(shopType.length);
    fillCheckboxes("#platform_web");
    fillCheckboxes("#type_shop");
}
function loadCorpSiteType(startFromStep = 2){
    removeExistingTags(); 
    generateCheckboxAndTabs(corpSiteType, startFromStep);
    generateSendRequestCheckboxAndTab(corpSiteType.length);
    fillCheckboxes('#platform_web');
    fillCheckboxes('#type_corp_site');
}
function loadCorpPortlaType(startFromStep = 2) {
  removeExistingTags();
  generateCheckboxAndTabs(corpPortalType, startFromStep);
  generateSendRequestCheckboxAndTab(corpPortalType.length);
  fillCheckboxes("#platform_web");
  fillCheckboxes("#type_corp_portal");
}
function loadLandingTypeSite(startFromStep = 2){
    removeExistingTags();
    generateCheckboxAndTabs(landingType, startFromStep);
    generateSendRequestCheckboxAndTab(landingType.length);
    fillCheckboxes("#platform_web");
    fillCheckboxes("#type_landing");
}
function loadWebPlatform(startFromStep = 1){
    $('#calc_header').html('Цены на разработку веб-сервисов');
    $('#calc_text').html('Узнайте стоимость создания приложения, ответив на несколько простых вопросов!');
    removeExistingTags();
    generateCheckboxAndTabs(webData, startFromStep);
    generateSendRequestCheckboxAndTab(webData.length);
    fillCheckboxes('#platform_web');
}
function loadIosAndroidPlatform(startFromStep = 1){
    $('#calc_header').html('Цены на разработку приложений для iOS и Android');
    $('#calc_text').html('Узнайте стоимость создания приложения, ответив на несколько простых вопросов! Перед тем, как заказывать услугу, выберите в калькуляторе нужный функционал и набор опций. Меняя эти настройки, вы поймете от чего зависит итоговая цена приложения.');
    removeExistingTags();
    generateCheckboxAndTabs(iosAndroidData, startFromStep);
    generateSendRequestCheckboxAndTab(iosAndroidData.length);
}
function generateCheckboxAndTabs(data, startFromStep, counter = 1){
    var event = '';
    data.forEach(stepItems => {
        listenEventsWhenSwitchTabs();
        classN = startFromStep == counter ? 'active' : "";
        generateTablist(stepItems, counter, classN);
        counter++;
        var label = '';
        stepItems.items.forEach(item => {
            event ='';
            label = `${label}${generateCheckbox(item, event)}`;
        });
		
		classShow = classN == 'active' ? 'show' : "";
        let checkbox = `
                <div
                role="tabpanel"
                class="tab-pane ${classShow} ${classN}"
                id="${stepItems.id}" aria-labelledby="${stepItems.id}-tab">
                <div class="btn-group"
                data-toggle="buttons"
                >
                 ${label}
                </div>
                </div>`;
        $('#checkbox').append(checkbox);
    });
    hideTabs();

    $('.checkbox-label').click(function(){
        let input_id = $(this).find('input').attr('id')
        let img = $(this).find('img');
        if(input_id == 'platform_web'){
            cancelCheckboxes('#platform_apple');
            cancelCheckboxes('#platform_android');
        } else if(input_id == 'platform_apple' || input_id == 'platform_android'){
            cancelCheckboxes('#platform_web');
        }
        if($(img).attr('class') == 'filter_black'){
            $(img).removeClass('filter_black');
            $(img).addClass('filter_white');
        } else if ($(img).attr('class') == 'filter_white'){
            $(img).removeClass('filter_white');
            $(img).addClass('filter_black');
        }
    })
}

function generateTablist(itemTablist, counter, classN){
	ariaSelected = classN == 'active' ? 'true' : 'false';
    let link = `
        <a class="link_tablist disable_link nav-link ${classN}" id="${itemTablist.id}-tab" href=${itemTablist.href} aria-controls="${itemTablist.id}" role="tab" data-toggle="tab" aria-selected="${ariaSelected}">
            ${itemTablist.step}
        </a>
     `
    let counterTag = `<b>${counter}</b>`;
    $('#tablist').append(`<li role="presentation" class="nav-item">${counterTag}${link}</li>`)

}
function generateSendRequestCheckboxAndTab(length){
    let checkbox = `
    <div role="tabpanel" class="tab-pane calc-send" id="calc_send" aria-labelledby="calc_send-tab">
    <div class="container">
            <h3>Предварительная стоимость вашего приложения или проекта:</h3>
            <h2><b id="sum"></b> руб.</h2>
            <br/>
            <div id="calcRequest" class="clearfix"></div>
            <a id="btnModal" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#calcSend"><b>Отправить заявку</b></a>
        </div>
    </div>
    `;
    let tab = `
         <li role="presentation">
         <b>${length + 1}</b>
            <a
            href="#calc_send"
            aria-controls="calc_send"
            role="tab" data-toggle="tab">
            &nbsp;&nbsp;Отправить
          </a>
          </li>
    `;
    $('#checkbox').append(checkbox);
    $('#tablist').append(tab);
    hideTabs();
}
function generateCheckbox(itemCheckbox, event){
    let label = `
        <label
        onclick="${event}"
        class="btn btn-default checkbox-label">
        <input
            class="chekbox_input"
            type="checkbox"
            id="${itemCheckbox.input.id}"
            name="${itemCheckbox.input.name}"
            value="${itemCheckbox.input.value}"/>
         <i class="icn">
         <img class="filter_white" src="/wp-content/themes/mark_up/calc/icons/${itemCheckbox.input.icon}.svg" alt="${itemCheckbox.input.id}">
         </i>
        <span>
        ${itemCheckbox.input.value}
        </span>
        </label>
    `;
    return label;
}
