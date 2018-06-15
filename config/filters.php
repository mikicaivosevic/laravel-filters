<?php

return [
    'aliases' => [
        'encrypt' => \Abstractrs\Form\Request\Filters\EncryptFilter::class,
        'decrypt' => \Abstractrs\Form\Request\Filters\DecryptFilter::class,
        'hash'    => \Abstractrs\Form\Request\Filters\HashFilter::class,
    ],
    'namespace' => 'Http\\Filters'
];
