# Компонент для избранных товаров пользователей
## Принимаемые параметры 
```
$APPLICATION->IncludeComponent('bitrixApiComponent:favorites',
	'',
	[
		'id'       => 24600, - ID пользователя
		'json'     => false, - не возращать json
		'method'   => 'GET', - тип запроса
	]
);
```

Данный компонент достает у пользователя ,пользовательское поле UF_FAVORIT

GET /api/favorites

## Пример возвращение данных
```
Array
(
    Array
    (
    [status] => success
    [data] => Array       - id товаров
        (
            [0] => 2770
            [1] => 2776
            [2] => 2890
            [3] => 22362
            [4] => 22634
        )    
)
```