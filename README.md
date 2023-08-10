# data-mapper
data mapper package

 ### install

```
composer require ehsanmoradi/data-mapper
```

### publish config `data-mapper.php`
```
php artisan vendor:publish --tag=data-mapper
```

## how to use
Edit the configuration file (`config/data-mapper.php`) according to your needs.

```php
<?php

return [
    'default' => [
        'name'         => 'first_name',
        'family'       => 'last_name',
        'birthdayDate' => 'birthday',
    ],

  // ...
];
```

Get your data from the API and give it to the `Mapper` class. Input data can be `xml` or `json`.
```php
use EhsanMoradi\DataMapper\Mapper;
use Illuminate\Support\Facades\Http;

$data = Http::get('/api/json')->body();

$mapper = new Mapper($data);
// or
$mapper = new Mapper($data, config('data-mapper.nested'));

dd([
    $mapper->name(),
    $mapper->family(),
    $mapper->birthdayDate(),
]);

```

If your input data from the API is in the form of child objects, you must mark them in the config file with `.` Separate from each other. Like the sample code in the config file

```php
<?php

return [
    'nested' => [
        'plate'              => 'plate',
        'include'            => 'include',
        'brickEachThen'      => 'brick.each.then',
        'brickEachExamine'   => 'brick.each.examine',
        'brickEachSoil'      => 'brick.each.soil',
        'brickEachSpeed'     => 'brick.each.speed',
        'brickEachTherefore' => 'brick.each.therefore',
        'brickEachLearn'     => 'brick.each.learn',
        'brickPeriod'        => 'brick.period',
        'brickEntirely'      => 'brick.entirely',
        'brickDevelop'       => 'brick.develop',
        'brickWeek'          => 'brick.week',
        'brickWent'          => 'brick.went',
        'win'                => 'win',
        'lay'                => 'lay',
        'beat'               => 'beat',
    ],
   // ...
];
```

