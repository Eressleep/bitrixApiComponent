# Компонент личные данные пользователя

## Принимаемые параметры
```
$APPLICATION->IncludeComponent('bitrixApiComponent:personalAccount',
	'',
	[
		'id'   => 123,   - id пользователя
		'json' => false, - возвращать json или нет
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
            [surname] 	 => Олеговна
            [patronymic] => Олеговна
            [mail] 	 => ivanov@microsoft.com
            [login] 	 => ivan
        )
)
```
