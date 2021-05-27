# Компонент личные данные пользователя

## Принимаемые параметры для получения данных
```
$APPLICATION->IncludeComponent('bitrixApiComponent:personalAccount',
	'',
	[
		'id'   => 123,                   - id пользователя
		'json' => false,                 - возвращать json
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
### валидирует данные, в случае ошибки вернет массив error
```
$APPLICATION->IncludeComponent('bitrixApiComponent:personalAccount',
	'',
	[
		'id'   => 123,                   - id пользователя
		'changeUserData' =>
		[
			'name'       => '123Zalupa',
			'surname'    => 'asd dsadsad',
			'patronymic' => 'dsadsad',
			'mail'       => 'asd@sad.ru',
			'login'      => 'ssss',
		],
		'json' => false,                 - возвращать json
	]
);
```
## Пример возвращение данных
```
Array
(
    [status] => fail
    [error]  => Array
        (
            [name] => Invalid name 123Zalupa
            [surname] => Invalid surname asd dsadsad
        )
)
```
