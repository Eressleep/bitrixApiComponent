# Компонент для избранных товаров пользователей
## Принимаемые параметры для получения данных 
```
$metod = \Bitrix\Main\Context::getCurrent()->getRequest()->getRequestMethod();

$APPLICATION->IncludeComponent('bitrixApiComponent:favorites',
	'',
	[
		'id'        => 24600,  //- ID пользователя
		'json'      => false,  //- не возращать json
		'method'    => $metod, //- тип запроса
        	'page'      => 2,      //- текущая страница
		'onThePage' => 5,      //- избранных товаров на странице
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
    [data]   => Array       - товаровы
        (
            [0] => Array
                (
                    [id] => 3416
                    [name] => Диван Гейша
                )

            [1] => Array
                (
                    [id] => 3421
                    [name] => Диван Гейша
                )
        )
    [totalPages] => 7       - всего страниц
)
```
