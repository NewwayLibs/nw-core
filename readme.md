# Ядро платформы для разработки сайтов

Базовый набор инструментов для быстрого старта.
Завязан на Laravel 5.1 + Ruby + Node.js + Gulp

Включает в себя:
* [Bower] (http://bower.io/)
* [Sass] (https://ru.wikipedia.org/wiki/Sass)
* [CoffeeScript] (http://coffeescript.org/)
* etc (@todo)


## Установка

Устанавливаем ruby пакеты
~~~bash
composer create-project newway/nw-core=dev-master .
~~~

## Подготовка окружения

Устанавливаем ruby пакеты
~~~bash
bundle install
~~~

Устанавливаем node.js  пакеты

~~~bash
npm install
~~~

Устанавливаем bower библиотеки

~~~bash
bower install
~~~

Запускаем build + watch

~~~bash
gulp
~~~

## Запуск сервера

~~~bash
	php artisan serve
~~~




## Запуск мониторинга исходного кода

~~~bash
	gulp watch
~~~
