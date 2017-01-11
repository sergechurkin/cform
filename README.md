# cform

Библиотека для формирования WEB страничек (меню, формы, таблицы). 
Пример использования в тестовом приложении
[Гостевая книга](https://github.com/sergechurkin/guestbook).
Расширение зарегистрировано на
[packagist](https://packagist.org/packages/sergechurkin/cform)
и может быть включено в проект. Если указать зависимость

```
    "require-dev": {
        "php": ">=5.4.0",
        "sergechurkin/cform": "1.1.x-dev"
    },
```

то [composer](http://getcomposer.org/download/) сформирует автозагрузчик,
который можно использовать в проекте:

```
$loader = require( __DIR__ . '/vendor/autoload.php' );
```

## Installation

Библиотеку можно установить отдельно:

```
composer create-project sergechurkin/cform path "1.1.x-dev"
```
