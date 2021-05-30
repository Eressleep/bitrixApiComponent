# Битрикс компоненты для restApi
Компоненты которые  получились при споре с душнилой
## https://www.notion.so/05bb771577454172933c9f86f4b18848

- [Личные данные пользователя и изменения их(удаление самого пользователя)](https://github.com/Eressleep/bitrixApiComponent/tree/personalAccount/personalAccount)
- [Список разделов](https://github.com/Eressleep/bitrixApiComponent/tree/section/section)
- [Избранные пользователя](https://github.com/Eressleep/bitrixApiComponent/tree/favorites/favorites)


## Git modules

Каждый уважающий себя компонент вынесен в отдельную ветку (ссылки выше на них не действительны).
И подключаться в проект они будут с помощью gitmodules.

Это сделано для того, чтобы можно было нужные модули подключать по отдельности, и не тащить весь репозиторий в каждый проект.

Для добавления нового компонента надо в папке проекта выполнить команду

```git submodule add -b <component> -f https://github.com/odvapro/bitrixComponents.git local/components/odva/<component>```

где ```<component>``` - название компонента, например, ```elements```

Если попытаться склонировать проект, в котором уже есть добавленные модули, обычной командой git clone,
то модули склонируются как пустые папки. Для того, чтобы скачать содержимое папок, надо будет в корне проекта запустить две команды:

```
git submodule init
git submodule update
```

Если надо склонировать проект сразу с содержимым модулей, можно в команду ```git clone``` добавить флаг ```--recursive```

***Внимание! При добавлении модуля его надо загрузить на сервер тоже. Либо спулить на сервере и запустить две команды, описанные выше.***
