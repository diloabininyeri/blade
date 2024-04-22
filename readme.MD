### The blade template renders

install  
```console
composer require zeus/blade
 ```
### An example of using
```php

use Zeus\Blade\Blade;


echo Blade::in(__DIR__)
    ->renderFile('test.blade.php');
```