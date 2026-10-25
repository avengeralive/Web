<aside class="sidebar">
    <div class="sidebar-widget">
        <? $APPLICATION->IncludeComponent("bitrix:menu", "sidebar", Array(
                "ROOT_MENU_TYPE" => "sidebar",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "top",
                "USE_EXT" => "N",
                "ALLOW_MULTI_SELECT" => "N",
                "MENU_CACHE_TYPE" => "Y",
                "MENU_CACHE_TIME" => "360000",
                "MENU_CACHE_USE_GROUPS" => "N",
                "MENU_CACHE_GET_VARS" => "N",
            )
        ); ?>
    </div>
</aside>
