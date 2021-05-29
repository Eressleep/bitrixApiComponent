# Компонент для секций
## Принимаемые параметры для получения данных
GET /api/personalAccount
```
$APPLICATION->IncludeComponent('bitrixApiComponent:section',
	'',
	[
		'iblockId' => 4,     - название инфоблока секций
		'json'     => false, - возращение данных
		'method'   => 'GET', - принимает токлько get 
	]
);
```
### Данный модуль достает секции до 3 уровня вложения

## Пример возвращение данных
```
Array
(
    [section] => Array
        (
            [16] => Array - секция первого уровня
                (
                    [id]       => 16
                    [name]     => Текстиль для дома
                    [sort]     => 70
                    [children] => Array
                        (
                            [17] => Array - секция второго урованя
                                (
                                    [id]      => 17
                                    [name]     => Покрывала
                                    [sort]     => 40
                                    [children] => Array
                                    (
                                        [25] => Array - секция третьего урованя
                                            (
                                                [id]   => 25
                                                [name] => Пики точеные
                                                [sort] => 40
                                            )
                                    )
                            
```