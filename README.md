# cform

Библиотека для формирования WEB страничек (меню, формы, таблицы). 
Примеры использования в тестовых приложениях:
[sergechurkin/guestbook](https://github.com/sergechurkin/guestbook),
[sergechurkin/ratecb](https://github.com/sergechurkin/ratecb).
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

Библиотеку можно установить отдельно в каталог vendor:

```
composer require sergechurkin/cform "1.1.x-dev"
```

