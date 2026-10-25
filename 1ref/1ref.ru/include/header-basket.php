<?php

use Bitrix\Main\ArgumentNullException;
use Bitrix\Sale\BasketItem;
use Palladiumlab\Catalog\AvailableQuantityManager;
use Palladiumlab\Catalog\Basket;
use Palladiumlab\Helpers\SvelteComponent;

$items = [];
$productIdList = [];

/** @var BasketItem $item */
foreach (Basket::getInstance()->getItems() as $item) {
    try {
        $productIdList[] = $item->getProductId();
        $items[] = [
            'id' => $item->getProductId(),
            'quantity' => $item->getQuantity(),
            'price' => $item->getPrice(),
        ];
    } catch (ArgumentNullException $e) {
    }
}
/** For static cache */
(new AvailableQuantityManager())->getList($productIdList);

$basketCount = array_sum(array_column($items, 'quantity'));
$basketCountTitle = plural_mess($basketCount, [
    'товар',
    'товара',
    'товаров',
]);

$componentId = SvelteComponent::start(
    ['id' => 'svelte-basket-mini'],
    ['items' => $items]
);
?>
    <a href="/cart/" class="header-link header-link-cart">
        <span class="header-link-icon">
            <svg width="16" height="16"><use xlink:href="#icon-cart"></use></svg>
        </span>
        <span class="header-link-text"><b><?= $basketCount ?></b> <?= $basketCountTitle ?></span>
    </a>
<?php
SvelteComponent::end($componentId);
