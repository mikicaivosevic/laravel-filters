# Laravel Request Filter

This package allows you to easily create / use filters which transform input values, by removing or changing characters within the value.

#### Config - publish vendor

```
php artisan vendor:publish --tag=laravel-filters
```

* config/filters.php

```php
<?php

return [
    'aliases' => [
        'encrypt' => \Abstractrs\Form\Request\Filters\EncryptFilter::class,
        'decrypt' => \Abstractrs\Form\Request\Filters\DecryptFilter::class,
        'hash'    => \Abstractrs\Form\Request\Filters\HashFilter::class,
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
            'name' => 'encrypt|hash'
        ];
    }
    
    //...
    
}
```
