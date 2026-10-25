define({ "api": [
  {
    "type": "get",
    "url": "/offer/:id/landings",
    "title": "getLandings",
    "version": "1.0.1",
    "group": "Offers",
    "name": "getLandings",
    "description": "<p>Получает все доступные лендинги офера</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>Апи-Ключ для запроса</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID офера</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/offer/:id/landings"
      }
    ],
    "filename": "/home/bdcpa/www/utilities/src/Api.php",
    "groupTitle": "Offers"
  },
  {
    "type": "get",
    "url": "/offers",
    "title": "getOffers",
    "version": "1.0.0",
    "group": "Offers",
    "name": "getOffers",
    "description": "<p>Получает все оферы системы</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>Апи-Ключ для запроса</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/offers"
      }
    ],
    "filename": "/home/bdcpa/www/utilities/src/Api.php",
    "groupTitle": "Offers"
  },
  {
    "type": "get",
    "url": "/offer/:id/sources",
    "title": "getSources",
    "version": "1.0.0",
    "group": "Offers",
    "name": "getSources",
    "description": "<p>Получает все разрешенные источники трафика для офера. Legal 1 - разрешено, иначе - запрещенно.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>Апи-Ключ для запроса</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID офера</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/offer/:id/sources"
      }
    ],
    "filename": "/home/bdcpa/www/utilities/src/Api.php",
    "groupTitle": "Offers"
  },
  {
    "type": "get",
    "url": "/offer/:id/transits",
    "title": "getTransits",
    "version": "1.0.0",
    "group": "Offers",
    "name": "getTransits",
    "description": "<p>Получает все транзитные страницы для офера</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>Апи-Ключ для запроса</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID офера</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/offer/:id/transits"
      }
    ],
    "filename": "/home/bdcpa/www/utilities/src/Api.php",
    "groupTitle": "Offers"
  },
  {
    "type": "post",
    "url": "/order/",
    "title": "createOrder",
    "version": "1.0.0",
    "group": "Orders",
    "name": "createOrder",
    "description": "<p>Создать новый заказ. Кодировка - UTF8<br> <B>Обратите внимание</b><br> В системе установлен фильтр, не более 1 заказа с 1 IP в течении 30 секунд.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>Апи-Ключ для запроса</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "stream",
            "description": "<p>ID потока</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ip",
            "description": "<p>IP адрес клиента (формат IP v4 (xxx.xxx.xxx.xxx))</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "clientname",
            "description": "<p>ФИО клиента</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефон клиента</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "externalWebmaster",
            "description": "<p>externalWebmaster</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "count",
            "description": "<p>Количество товаров, по дефолту 1</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "artikul",
            "description": "<p>Артикул товара, размер или код</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "comments",
            "description": "<p>Комментарии к заказу</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "sub1",
            "description": "<p>subID1, по умолчанию будут выставленны те значения, которые заданы в настройках потока</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "sub2",
            "description": "<p>subID2, по умолчанию будут выставленны те значения, которые заданы в настройках потока</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "sub3",
            "description": "<p>subID3, по умолчанию будут выставленны те значения, которые заданы в настройках потока</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "email",
            "description": "<p>Почта пользователя</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "referer",
            "description": "<p>Referer пользователя (откуда пришел)</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/order/"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Пример ответа",
          "content": "{\n     status: 200,\n     id: 3293,\n     crmid: 3293\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/bdcpa/www/utilities/src/Api.php",
    "groupTitle": "Orders"
  },
  {
    "type": "get",
    "url": "/orders/statuses",
    "title": "getBatchStatuses",
    "version": "1.0.1",
    "group": "Orders",
    "name": "getBatchStatus",
    "description": "<p>Получает статусы заказов пачкой, status и paid +комментарии<br> Расшифровка статусов: <br> status=0 - отклонено<Br> status=1 - ожидание<br> status=3 - подтвержден<br> status=5 - мусор<br> <br> Расшифрока paid: <bR> paid=1 - Новый<br>paid=2 - Перезвонить позже<br>paid=3 - Недозвон<br>paid=4 - В работе - верификация<br>paid=5 - Подтверждено<br>paid=6 - Не оставлял заявку<br>paid=7 - Купил в другом месте<br>paid=8 - Не устроила доставка<br>paid=9 - Не устроила цена<br>paid=10 - Не оригинал<br>paid=11 - Не рабочие регионы<br>paid=12 - Отменен<br>paid=13 - Прочее<br>paid=14 - Отказ от звонка<br>paid=15 - Опись<br>paid=16 - Отзывы<br>paid=17 - Не рабочие номера<br>paid=18 - Конечный недозвон<br>paid=19 - Нужен курьер<br>paid=20 - Истекший недозвон<br>paid=21 - Отмена клиента<br>paid=22 - Купил в другом месте<br>paid=23 - ПРОЧЕЕ<br>paid=24 - Отговорили знакомые<br>paid=25 - Отзывы<br>paid=26 - Нет денег<br>paid=27 - Не устраивают сроки доставки<br>paid=28 - Не оставлял заявку<br>paid=29 - Не устроила стоимость доставки<br>paid=30 - Спам<br>paid=31 - Дубликаты на удаление<br>paid=32 - Проверка на фрод<br>paid=33 - Заказ отправлен<br></p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>Апи-Ключ для запроса</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ids",
            "description": "<p>Ид заказов через запятую без пробелов, например: 1000,1020,2010,2004...</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/orders/statuses"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Ответ сервера",
          "content": "{\n  \"status\": 200,\n  \"orders\": [\n     \"id\": 1000, // ид заказа\n     \"order_status\": 1,\n     \"order_paid\": 0,\n     \"comments\": \"перезвонить\",\n     \"crmid\": \"123456\"\n  ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/bdcpa/www/utilities/src/Api.php",
    "groupTitle": "Orders"
  },
  {
    "type": "get",
    "url": "/order/:id/status",
    "title": "getStatus",
    "version": "1.0.1",
    "group": "Orders",
    "name": "getStatus",
    "description": "<p>Получает все статус заказа, status и paid +комментарии<br> Расшифровка статусов: <br> status=0 - отклонено<Br> status=1 - ожидание<br> status=3 - подтвержден<br> status=5 - мусор<br> <br> Расшифрока paid: <bR>paid=1 - Новый<br>paid=2 - Перезвонить позже<br>paid=3 - Недозвон<br>paid=4 - В работе - верификация<br>paid=5 - Подтверждено<br>paid=6 - Не оставлял заявку<br>paid=7 - Купил в другом месте<br>paid=8 - Не устроила доставка<br>paid=9 - Не устроила цена<br>paid=10 - Не оригинал<br>paid=11 - Не рабочие регионы<br>paid=12 - Отменен<br>paid=13 - Прочее<br>paid=14 - Отказ от звонка<br>paid=15 - Опись<br>paid=16 - Отзывы<br>paid=17 - Не рабочие номера<br>paid=18 - Конечный недозвон<br>paid=19 - Нужен курьер<br>paid=20 - Истекший недозвон<br>paid=21 - Отмена клиента<br>paid=22 - Купил в другом месте<br>paid=23 - ПРОЧЕЕ<br>paid=24 - Отговорили знакомые<br>paid=25 - Отзывы<br>paid=26 - Нет денег<br>paid=27 - Не устраивают сроки доставки<br>paid=28 - Не оставлял заявку<br>paid=29 - Не устроила стоимость доставки<br>paid=30 - Спам<br>paid=31 - Дубликаты на удаление<br>paid=32 - Проверка на фрод<br>paid=33 - Заказ отправлен<br></p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "key",
            "description": "<p>Апи-Ключ для запроса</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>ID заказа</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/order/:id/status"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Ответ сервера",
          "content": "{\n  \"status\": 200,\n  \"order_status\": 1,\n  \"order_paid\": 0,\n  \"comments\": \"перезвонить\"\n,\n  \"crmid\": \"123456\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/bdcpa/www/utilities/src/Api.php",
    "groupTitle": "Orders"
  },
  {
    "type": "post",
    "url": "/order/leadvertex",
    "title": "createOrder",
    "version": "1.0.0",
    "group": "Leadvertex",
    "name": "createOrder",
    "description": "<p>Создать новый заказ. Кодировка - UTF8<br> <B>Обратите внимание</b><br> В системе установлен фильтр, не более 1 заказа с 1 IP в течении 30 секунд.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "offerName",
            "description": "<p>Название проекта</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "goods",
            "description": "<p>Данные о товарах в заказе в JSON</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ip",
            "description": "<p>IP адрес клиента (формат IP v4 (xxx.xxx.xxx.xxx))</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fio",
            "description": "<p>ФИО клиента</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Телефон клиента</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "id",
            "description": "<p>Номер заказ</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "webmasterID",
            "description": "<p>ID веб-мастера, от которого пришел заказ</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "referer",
            "description": "<p>Referer пользователя (откуда пришел)</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "externalWebmaster",
            "description": "<p>Внешний ID веб-мастера</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/v1/order/leadvertex"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Пример ответа",
          "content": "{\n     status: 200,\n     id: 3293,\n     crmid: 3293\n}",
          "type": "json"
        }
      ]
    },
    "filename": "/home/bdcpa/www/utilities/src/Api.php",
    "groupTitle": "Leadvertex"
  },
] });
