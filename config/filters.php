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
