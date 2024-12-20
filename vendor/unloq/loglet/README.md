## Loglet.io - Encrypted Log Management System

Simple library to connect to Loglet.io API and save encrypted logs.

### Instalation
$ composer require unloq/loglet
### Basic usage

```php
<?php

use Unloq\Loglet;

$logger = new Loglet( 'App-Name', 'bearer-key-generated-inside-loglet-account-for-each-app');

$data = [
    'firstKey' => 'firstValue',
    'secondKey' => 'secondValue'
];

$logger->log('Application started', 'WARN', $data);

```

### Requirements
* PHP >= 5.6
* GuzzleHttp

### Author
Florin Popescu - florin@ltsdevelopment.com - http://www.ltsdevelopment.com

### License
MIT license. Please see LICENSE for more