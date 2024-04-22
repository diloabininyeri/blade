### The blade template renders

```php

use Zeus\Blade\Blade;


echo Blade::in(__DIR__)
    ->renderFile('test.blade.php');
```