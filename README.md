# My Album
Сайт для создания и просмотра Альбомов

DIRECTORY STRUCTURE
-------------------

```       
app/                 ядро
config/              конфигурация
public/              публичные файлы
tmp/                 временный файлы
vendor/              подключенные библиотеки
```
***
## Установка
Установка осуществляется с помощью менеджера пакетов Composer

1. Забираем проект

        git clone https://github.com/vitalbu/myalbum.git
2. Устанавливаем зависимости

        cd myalbum 
        composer install
3. Настраиваем подключение к БД в файле config/config_db.php. База данных должна быть создана заранее. Экспортировать БД. Тестовая база данных находится в корне проекта.
4. В режиме разработки в файле config/init.php устанавливаем константу DEBUG = 1. В рабочем режиме значение константы равно 0.

### Тестовые пользователи: ###

* логин: admin | пароль: 123456
* логин: user  | пароль: 123456