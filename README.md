# Introduction
This is unoffical Zenlayer Cloud API Software Developer Kit (SDK),
Currently includes only the essential interfaces for virtual machines,
while other interfaces have not yet been integrated. 

We warmly welcome all developers to contribute and further enhance this SDK.

# Requirements
* You must use PHP 8.3.x or later.
* A Zenlayer Cloud account is created and an Access Key ID and an Access Key Password are created. See Generate an API Access Key for more details.

# Installation
Use composer:

``` shell
composer require bigbug-gg/zenlayer
```

# Quick Examples

``` php

// Init
$appId = 'YOUR-APP-ID';
$secretKey = 'YOUR-SECRET-KEY';
$instance = new Instance($appId, $secretKey);

// Request
$zoneId = 'PAR-A';
$data = $instance->describeZones([$zoneId]);

var_dump($data);

```