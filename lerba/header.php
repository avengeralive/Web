<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
	IncludeTemplateLangFile(__FILE__);
	ini_set('display_errors',0);
	CUtil::InitJSCore(array('ajax'));
	$curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="<?echo  LANGUAGE_ID;?>" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="<?echo  LANGUAGE_ID;?>" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="<?echo  LANGUAGE_ID;?>"> <!--<![endif]-->
<head>

    <!-- Meta -->
    <meta charset="<?echo LANG_CHARSET?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Favicon -->
    <link rel="shortcut icon" href="<?echo SITE_DIR;?>favicon.ico">

    <!-- Web Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

    <!-- CSS Global Compulsory -->
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/plugins/bootstrap/css/bootstrap.min.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/css/style.css")?>" />

    <!-- CSS Header and Footer -->
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/css/headers/header-v6.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/css/footers/footer-v1.css")?>" />

    <!-- CSS Implementing Plugins -->
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/plugins/animate.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/plugins/line-icons/line-icons.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/plugins/font-awesome/css/font-awesome.min.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/plugins/owl-carousel/owl-carousel/owl.carousel.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/plugins/fancybox/source/jquery.fancybox.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/plugins/revolution-slider/rs-plugin/css/settings.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css")?>" />
    
	<!-- CSS Theme -->

	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/css/theme-skins/dark.css")?>" />
	<?if ($themeColor = $_COOKIE["THEME_COLOR"]) {?>
		<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/css/theme-colors/".$themeColor.".css")?>" id="style_color" />
		<?/*<link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH;?>/assets/favicon/<?=$themeColor;?>.png">*/?>
	<?} else {?>
		<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colors.css")?>" id="style_color" />
		<link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH;?>/favicon.ico">
	<?}?>
	<!-- Style Switcher -->
    <link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/css/plugins/style-switcher.css")?>" />  
	<!-- CSS Customization -->
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/assets/css/custom.css")?>" />	
	
	<script>
		var SITE_TEMPLATE_PATH = "<?=SITE_TEMPLATE_PATH?>";
		var SITE_DIR = "<?=SITE_DIR?>";
	</script>
	<?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle();?></title>
</head>

<body class="header-fixed header-fixed-space">
<?
global $USER;
if ($USER->IsAdmin()){?>
	<!--=== Style Switcher ===-->    
	<i class="style-switcher-btn fa fa-cogs hidden-xs"></i>
	<div class="style-switcher animated fadeInRight">
		<div class="style-swticher-header">
			<div class="style-switcher-heading"><?echo GetMessage("THEME_COLORS")?></div>            
			<div class="theme-close"><i class="icon-close"></i></div>
		</div>

		<div class="style-swticher-body">
			<!-- Theme Colors -->
			<ul class="list-unstyled">
				<li class="theme-cobalt" data-style="cobalt" data-header="light" title="Cobalt"></li>
				<li class="theme-darkblue" data-style="darkblue" data-header="light" title="Darkblue"></li>
				<li class="theme-royalblue theme-active" data-style="royalblue" data-header="light" title="Royalblue"></li>
				<li class="theme-smalt" data-style="smalt" data-header="light" title="Smalt"></li>
				<li class="theme-blue" data-style="blue" data-header="light" title="Blue"></li>
				<li class="theme-basil last" data-style="basil" data-header="light" title="Basil"></li>

				<li class="theme-green" data-style="green" data-header="light" title="Green"></li>
				<li class="theme-mint" data-style="mint" data-header="light" title="Mint"></li>
				<li class="theme-teal" data-style="teal" data-header="light" title="Teal"></li>
				<li class="theme-olive" data-style="olive" data-header="light" title="Olive"></li>
				<li class="theme-chocolate" data-style="chocolate" data-header="light" title="Chocolate"></li>
				<li class="theme-purple last" data-style="purple" data-header="light" title="Purple"></li>

				<li class="theme-strawberry" data-style="strawberry" data-header="light" title="Strawberry"></li>
				<li class="theme-punch" data-style="punch" data-header="light" title="Punch"></li>
				<li class="theme-orange" data-style="orange" data-header="light" title="Orange"></li>
				<li class="theme-black" data-style="black" data-header="light" title="Black"></li>
				<li class="theme-grey" data-style="grey" data-header="light" title="Grey"></li>
				<li class="theme-stone last" data-style="stone" data-header="light" title="Stone"></li>

				<li class="theme-metal" data-style="metal" data-header="light" title="Metal"></li>

			</ul>
		</div>
	</div><!--/style-switcher-->
	<!--=== End Style Switcher ===-->
<?}?>
<div class="wrapper">
	<div id="page-preloader">
		<div class="tp-loader spinner0">
			<div class="dot1"></div>
			<div class="dot2"></div>
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	</div>
    <!--=== Header v6 ===-->
    <div class="header-v6 header-classic-white header-sticky">
	<div id="panel">
		<?$APPLICATION->ShowPanel();?>
	</div>
        <!-- Topbar -->
        <div class="topbar-v1 visible-lg visible-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-inline top-v1-contacts">
                            <li>
                                <i class="fa fa-envelope"></i><?echo GetMessage("HEADER_EMAIL")?>
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/email.php",
										"EDIT_TEMPLATE" => ""
									),
								   false,
								   array('HIDE_ICONS' => 'Y')
								);?>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i><?echo GetMessage("HEADER_PHONE")?> 
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/phone.php",
										"EDIT_TEMPLATE" => ""
									),
								   false,
								   array('HIDE_ICONS' => 'Y')
								);?>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6">
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"apsel_header", 
							array(
								"ALLOW_MULTI_SELECT" => "N",
								"CHILD_MENU_TYPE" => "header",
								"COMPONENT_TEMPLATE" => "apsel_header",
								"DELAY" => "N",
								"MAX_LEVEL" => "2",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"ROOT_MENU_TYPE" => "header",
								"USE_EXT" => "N"
							),
							false,
							array('HIDE_ICONS' => 'N')
						);?>
						<?/*
                        <ul class="list-inline top-v1-data">
                            <li><a href="#"><i class="fa fa-home"></i></a></li>
                            <li><a href="#"><i class="fa fa-globe"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            <li><a href="#">Quicklinks</a></li>
                            <li><a href="#">My Account</a></li>
                        </ul>*/?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <!-- Navbar -->
        <div class="navbar mega-menu" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="menu-container">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Navbar Brand -->
                    <div class="navbar-brand">
                        <a href="<?echo SITE_DIR;?>">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/logo.php",
								"EDIT_TEMPLATE" => ""
							),
						   false,
						   array('HIDE_ICONS' => 'Y')
						);?>
                        </a>
                    </div>
                    <!-- ENd Navbar Brand -->

                    <!-- Header Inner Right -->
                    <div class="header-inner-right">
                        <ul class="menu-icons-list">
							<?/*
                            <li class="menu-icons shopping-cart">
                                <i class="menu-icons-style radius-x fa fa-shopping-cart"></i>
                                <span class="badge">0</span>
                                <div class="shopping-cart-open">
                                    <span class="shc-title">No products in the Cart</span>
                                    <button type="button" class="btn-u"><i class="fa fa-shopping-cart"></i> Cart</button>
                                    <span class="shc-total">Total: <strong>$0.00</strong></span>
                                </div>
                            </li>
							*/?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:search.title",
								"visual-tp",
								Array(
									"CATEGORY_0" => array("no"),
									"CATEGORY_0_TITLE" => "",
									"CATEGORY_0_iblock_catalog" => array("1"),
									"CHECK_DATES" => "Y",
									"COMPONENT_TEMPLATE" => "visual-tp",
									"CONTAINER_ID" => "title-search",
									"INPUT_ID" => "title-search-input",
									"NUM_CATEGORIES" => "1",
									"ORDER" => "date",
									"PAGE" => "#SITE_DIR#search/index.php",
									"PREVIEW_HEIGHT" => "75",
									"PREVIEW_TRUNCATE_LEN" => "",
									"PREVIEW_WIDTH" => "75",
									"PRICE_CODE" => array(),
									"PRICE_VAT_INCLUDE" => "N",
									"SHOW_INPUT" => "Y",
									"SHOW_OTHERS" => "N",
									"SHOW_PREVIEW" => "Y",
									"TOP_COUNT" => "5",
									"USE_LANGUAGE_GUESS" => "Y"
								),
								array("HIDE_ICONS" => "Y")
							);?>
                        </ul>
                    </div>
                    <!-- End Header Inner Right -->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <div class="menu-container">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"apsel-main",
						Array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "left",
							"COMPONENT_TEMPLATE" => "main",
							"DELAY" => "N",
							"MAX_LEVEL" => "2",
							"MENU_CACHE_GET_VARS" => array(),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"ROOT_MENU_TYPE" => "top",
							"USE_EXT" => "Y"
						)
					);?>
                    </div>
                </div><!--/navbar-collapse-->
            </div>
        </div>
        <!-- End Navbar -->
    </div>
    <!--=== End Header v6 ===-->
	<?
	if($APPLICATION->GetCurPage(false)==SITE_DIR)
	{	
		$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."include/banner.php",
				"EDIT_TEMPLATE" => ""
			)
		);
	}
	else
	{
		?>
	<!--=== Breadcrumbs ===-->
	<div class="breadcrumbs hidden-xs hidden-sm">
		<div class="container">
			<h1 class="pull-left"><?$APPLICATION->ShowTitle();?></h1>
			<?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb", 
				"apsel-breadcrumb", 
				array(
					"START_FROM" => "0",
					"PATH" => "",
					"SITE_ID" => "-"
					),
				array("HIDE_ICONS" => "Y"),
				false
			);
			?>
		</div>
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->
		<?
	}
	?>
	<?
	$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		".default",
		Array(
			"AREA_FILE_SHOW" => "page",
			"AREA_FILE_SUFFIX" => "inc-top",
			"EDIT_TEMPLATE" => ""
		),
		Array(
		"ACTIVE_COMPONENT" => "Y",
		"HIDE_ICONS" => "Y"
		)
	);?>

    <!--=== Content ===-->
    <div class="container content">