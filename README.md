# Laravel Request Filter

This package allows you to easily create / use filters which transform input values, by removing or changing characters within the value.

#### Installation

`composer require abstractrs/laravel-filters`

Laravel will discover the package by itself. If you feel old-school, disable auto-discovery and add `Abstractrs\Form\Request\RequestFilterProvider::class` to the providers array in your config/app.php.

#### Config - publish vendor

```
php artisan vendor:publish --tag=laravel-filters
```

* `config/filters.php`

```php
<?php

return [
    'aliases' => [
        'encrypt' => \Abstractrs\Form\Request\Filters\EncryptFilter::class,
        'decrypt' => \Abstractrs\Form\Request\Filters\DecryptFilter::class,
        'hash'    => \Abstractrs\Form\Request\Filters\HashFilter::class,
        'lower'   => \Abstractrs\Form\Request\Filters\StringToLowerFilter::class,
        'upper'   => \Abstractrs\Form\Request\Filters\StringToUpperFilter::class,
        'null'    => \Abstractrs\Form\Request\Filters\ToNullFilter::class,
        'int'     => \Abstractrs\Form\Request\Filters\ToIntFilter::class,
    ],
    'namespace' => 'Http\\Filters'
];

```

#### Create custom filter

```
php artisan make:filter RemoveCharsFilter
```

#### Usage

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {
    
    //Filter
    public function filters()
    {
        return [
            'name' => 'lower|hash',
            'names' => 'array:lower', // Call lower filter for each array value
            'id'   => 'int',
        ];
    }
    
    //...
    
}
```
