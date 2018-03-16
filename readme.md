# Простой движок блога на чистом PHP

Тестовое задание на PHP-разработчика.
Движок блога без внешних зависимостей.

Классы в ООП получились достаточно связными,
потому что я преднамеренно не хотел создавать глобальных объектов
приложения, как это сделано в большинстве современных фреймворков
(например, объект `Yii::$app` во фреймворке Yii2).

Блог запоминает имя автора в формах.

Модели данных в данном движке валидируются и на клиенте, и на сервере.

Стиль кодирования PHP — [PSR-2T](https://github.com/maximal/psr-2t) (PSR-2 со смарт-табуляцией).
Для CSS и JavaScript используется похожий стиль.


## Демо

https://php-test-blog.sijeko.ru


## Требования

 * **PHP** 5.4 и выше
 * **composer** (для автозагрузки классов)
 * **git**


## Установка

### 1. Склонировать репозиторий
```sh
git clone https://github.com/maximal/php-test-blog
```

### 2. Развернуть базу данных MariaDB/MySQL
Дамп базы данных лежит в директории `data`.

```sh
cd /path/to/php-test-blog/data
cat phptestblog.mariadb.sql | mysql -u user_name -p database_name
# После этого система спросит пароль пользователя `user_name`
```

Прописать настройки подключения к базе данных в файле `config/db.php`:
```php
return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host=localhost;dbname=имя_базы_данных',
	'username' => 'имя_пользователя_базы_данных',
	'password' => 'пароль_пользователя_базы_данных',
	'charset' => 'utf8mb4',
];
```

### 3. Настроить веб-сервер
Самый простой способ — воспользоваться встроенным в PHP веб-сервером.

Откройте в командной строке директорию `web` и запустите оттуда встроенный веб-сервер:
```sh
cd /path/to/php-test-blog
php -S 0.0.0.0:6789
```

Если порт 6789 занят другим процессом, подберите свободный порт.

### 4. Открыть блог в браузере
Откройте в браузере адрес <http://localhost:6789> (либо аналогичный с вашим номером порта).

### 5. Готово
Вы восхитительны!


## Автор

 * Сайт компании: https://sijeko.ru
 * Личный сайт: https://maximals.ru
 * Телеграм: https://t.me/maximal
 