<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
global $APPLICATION;
CJSCore::Init(array('fx', 'popup'));

if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}
//if(isset($_REQUEST['set_filter']))
//	$APPLICATION->AddHeadString('<meta name="robots" content="noindex,nofollow" />');
?>