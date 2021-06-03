# Компонент личные данные пользователя
## Принимаемые параметры для получения данных
GET /api/personalAccount
```
$metod = \Bitrix\Main\Context::getCurrent()->getRequest()->getRequestMethod();

$APPLICATION->IncludeComponent('bitrixApiComponent:personalAccount',
	'',
	[
		'id'             => 123,   //- id пользователя
		'methodRequest'  => metod  //- тип метода(GET)
		'json'           => false, //- возвращать json
	]
);
```
## Пример возвращение данных
```
Array
(
    [status] => success
    [data] => Array
        (
            [name] 	 => Сергей
            [surname] 	 => Иванов
            [patronymic] => Олеговна
            [mail] 	 => ivanov@microsoft.com
            [login] 	 => ivan
        )
)
```
## Принимаемые параметры для изменения данных
### Валидирует данные, в случае ошибки вернет массив error
POST /api/personalAccount

```
$metod = \Bitrix\Main\Context::getCurrent()->getRequest()->getRequestMethod();

$APPLICATION->IncludeComponent('bitrixApiComponent:personalAccount',
	'',
	[
		'id'   => 123,                   	//- id пользователя
		'methodRequest'  => $metod, 		//- тип метода(POST)
		'changeUserData' =>
		[
			'name'       => '123Zalupa',
			'surname'    => 'asd dsadsad',
			'patronymic' => 'dsadsad',
			'mail'       => 'asd@sad.ru',
			'login'      => 'ssss',
		],
		'json' => false,                 	//- возвращать json
	]
);
```
### Пример возвращение данных
```
Array
(
    [status] => success
)
```
## Принимаемые параметры для удаления пользователя
DELETE /api/personalAccount
```
$metod = \Bitrix\Main\Context::getCurrent()->getRequest()->getRequestMethod();

$APPLICATION->IncludeComponent('bitrixApiComponent:personalAccount',
	'',
	[
		'id'             => 123,   //- id пользователя
		'methodRequest'  => $metod //- тип метода(DELETE)
		'json'           => false, //- возвращать json
	]
);
```
### Пример возвращение данных
```
Array
(
    [status] => success
)
```
