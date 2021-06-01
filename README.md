# Битрикс компоненты для restApi
Компоненты которые  получились при споре с душнилой
<p align="center">
  <img src="https://www.intervolga.ru/upload/medialibrary/712/712cd23ab77b7f514419acefc048805f.jpg">
</p>

## https://www.notion.so/05bb771577454172933c9f86f4b18848

- [Личные данные пользователя и изменения их(удаление самого пользователя)](https://github.com/Eressleep/bitrixApiComponent/tree/personalAccount/personalAccount)
- [Список разделов](https://github.com/Eressleep/bitrixApiComponent/tree/section/section)
- [Избранные пользователя](https://github.com/Eressleep/bitrixApiComponent/tree/favorites/favorites)
- [История заказов](https://github.com/Eressleep/bitrixApiComponent/tree/historyOrders/historyOrders)


## Git modules

```
git submodule add -b <component> -f https://github.com/Eressleep/bitrixApiComponent.git local/components/bitrixApiComponent/<component>
```
где ```<component>``` - название компонента, например, ```sections```

Если попытаться склонировать проект, в котором уже есть добавленные модули, обычной командой git clone,
то модули склонируются как пустые папки. Для того, чтобы скачать содержимое папок, надо будет в корне проекта запустить две команды:

```
git submodule init
git submodule update
```

Если надо склонировать проект сразу с содержимым модулей, можно в команду ```git clone``` добавить флаг ```--recursive```

***Внимание! При добавлении модуля его надо загрузить на сервер тоже. Либо спулить на сервере и запустить две команды, описанные выше.***
