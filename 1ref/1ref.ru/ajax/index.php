<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Error;
use Bitrix\Main\Result;
use Palladiumlab\Catalog\Basket;
use Palladiumlab\Catalog\Item;
use Palladiumlab\Helpers\TemplateManager;
use Palladiumlab\Helpers\WebFormHandler;
use Palladiumlab\Helpers\SvelteComponent;

header('Content-Type: application/json');
$request = bitrix_request();
$result = new Result();
$action = $request->getPost('action');
if ($request->isAjaxRequest() && $action && check_bitrix_sessid()) {
    switch ($action) {
        case 'addToBasket':
            list($id, $quantity) = [
                (int)$request->getPost('id'),
                (float)$request->getPost('quantity')
            ];
            if ($id > 0 && $quantity > 0) {
                $result = Basket::getInstance()->setQuantity($id, $quantity);

                $item = (new Item($id))->getBasketData();

                $result->setData(array_merge(
                    $result->getData(),
                    ['svelte' => SvelteComponent::getComponentHtml(
                        ['class' => 'js-svelte-cart-item cart-item'],
                        array_merge($item['properties'], [
                            'detailPageUrl' => $item['element']['DETAIL_PAGE_URL'],
                            'previewPicture' => $item['element']['PREVIEW_PICTURE']['SRC'],
                            'name' => $item['element']['NAME'],
                        ]) + ['isModal' => true]
                    )]
                ));
            } else {
                $result->addError(new Error('Empty parameters'));
            }
            break;
        case 'deleteFromBasket':
            if ($id = (int)$request->getPost('id')) {
                $result = Basket::getInstance()->basketDelete($id);
            } else {
                $result->addError(new Error('Empty parameter'));
            }
            break;
        case 'modal-preorder':
            $result = WebFormHandler::modalPreorder();
            break;
        case 'configurator':
            $result = WebFormHandler::configurator();
            break;
        default:
            $result->addError(new Error('Action not found', 404));
            break;
    }
} else {
    if (!$request->isAjaxRequest()) {
        $result->addError(new Error('Request is not ajax'));
    }
    if (empty($action)) {
        $result->addError(new Error('Action is empty'));
    }
    if (!check_bitrix_sessid()) {
        $result->addError(new Error('User session id is invalid'));
    }
}
echo json_encode([
    'status' => $result->isSuccess(),
    'data' => $result->getData(),
    'errors' => $result->getErrorCollection()->toArray(),
]);
die();
