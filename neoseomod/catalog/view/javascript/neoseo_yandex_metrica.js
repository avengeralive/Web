function sendYandexECommerceTransaction(order) {

    if (window.dataLayer) {
        var eproducts = [];
        for (var key in order['products']) {
            var product = order['products'][key];
            eproducts.push({
                'id': product['sku'],
                'name': product['name'],
                'price': product['price'],
                'brand': product['manufacturer'],
                'category': product['category'],
                'quantity': product['quantity']
            });
        }
        window.dataLayer.push({
            "ecommerce": {
                "purchase": {
                    "actionField": {
                        "id": order['order_id'],
                        "goal_id": window.ym_ecommerce_goal
                    },
                    "products": eproducts
                }
            }
        });
    }
}
