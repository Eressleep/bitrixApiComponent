# Компонент история пользователя

Пример подключения

```
$APPLICATION->IncludeComponent('bitrixApiComponent:historyOrders',
	'',
	[
		'id'        => 24600, - id пользователя
		'json'      => false, - не возращать 
		'method'    => "GET", - тип запроса
		'page'      => 1,     - страницы пагинации
		'onThePage' => 2,     - элементов на странице
	]
);
```
## Пример возвращение данных
```
Array
(
    [status] => success - статутс запроса
    [totalPages] => 2   - всего старниц
    [data] => Array     - массив то
        (
            [0] => Array  - заказы
                (
                    [DELIVERY_ID]    => 17
                    [PRICE_DELIVERY] => 1599.0000           - цена доставки 
                    [PRICE]          => 1258785.0000        - общая цена заказа
                    [DATE_STATUS]    => 30.04.2021 14:41:59 - время создание заказа
                    [PAY_SYSTEM_ID]  => Array               - описание доставки
                        (
                            [NAME]        => Доставка Gachimuchi
                            [DESCRIPTION] => Доставка вы серьезно ?
                        )

                    [products] => Array - товары заказа
                        (
                            [0] => Array
                                (
                                    [id]    => 691598
                                    [name]  => Диван Visconte
                                    [cnt]   => 14
                                    [price] => 89799
                                )
                        )
                )
```
