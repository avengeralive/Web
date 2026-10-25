<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<a href="/personal/cart/" style="display: flex;"><span class="top-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.5 49.5"><g id="e3a4fd4e-f2ab-450a-8b71-45877b4e5b49" data-name="Layer 2"><g id="5177fe22-6232-47fd-91ef-5a97b65b5750" data-name="Слой 1"><path d="M38.9,20.1v-.2a1,1,0,0,0-1-1H32.1l-.3-4.2a.37.37,0,0,0-.1-.3,3.9,3.9,0,0,0-.6-1.1,1.07,1.07,0,0,0-.3-.5,6.79,6.79,0,0,0-5.1-2.9H24.6a6.63,6.63,0,0,0-5.1,2.9.7.7,0,0,0-.4.5,3.88,3.88,0,0,0-.6,1.1.37.37,0,0,0-.1.3l-.2,4.2H12.3a1.08,1.08,0,0,0-.7.3.91.91,0,0,0-.3.7v.2h0a1.33,1.33,0,0,0-.3.8v11c0,.2.1.3.1.5a12.56,12.56,0,0,0,4.2,4.5c.1.2.3.2.5.2H34.3c.3,0,.5,0,.6-.2a12.57,12.57,0,0,0,4.2-4.5.9.9,0,0,0,.1-.5v-11A1.33,1.33,0,0,0,38.9,20.1Zm-18-5.9.1-.1a4.6,4.6,0,0,1,3.7-2.2h.9a4.75,4.75,0,0,1,3.7,2.2v.1c0,.1,0,.1.1.2s.3.4.4.6l.3,3.9H20.2l.2-3.9a6,6,0,0,0,.4-.6C20.8,14.3,20.8,14.3,20.9,14.2Zm16.3,6.7V31.6a9.27,9.27,0,0,1-3.1,3.5H16.2A10.55,10.55,0,0,1,13,31.6V20.9h5.1l-.3,4.7a1,1,0,0,0,.4.8c.1.2.4.2.6.2a1.2,1.2,0,0,0,.8-.2,1,1,0,0,0,.2-.7l.3-4.8H30.2l.1,4.8a.87.87,0,0,0,.4.7c.1.2.4.2.7.2a.84.84,0,0,0,.7-.2,1.2,1.2,0,0,0,.2-.8l-.1-4.7Z" style="fill:#fff"/></g></g></svg></span>
<span class="text">В корзине <span class="items-counter">
	<?
		if (!$compositeStub)
		{
			if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] >= 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'))
			{
				echo '<span class="items-counter">'.$arResult['NUM_PRODUCTS'].'</span> товар</span>';
			}
		}
?>
</a>