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
