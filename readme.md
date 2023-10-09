# SIONIC


### Тестовое задание: PHP Разработчик

Создать базу данных:

```
mysql -uroot -p
CREATE DATABASE sionic CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
quit
```

Запустите PHP-сервер:

С помощью команды

```
php -S localhosr:8000 
```

В файле `Connection.php` нужно поменять константы `DB_NAME` , `DB_PASS`, `DB_USER`, `DB_SERVER` на свои данные.

### Как работает данная программа

Данные нужно поместить в папку `data`.

При переходе по адресу [http://localhost:8000/](http://localhost:8000/) будет страница с пустой таблицей и кнопкой `"Загрузка данных"`.

Нажмите на кнопку для начало преобразования.