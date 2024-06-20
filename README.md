# Introduction
Unofficial Zenlayer Cloud API Software Developer Kit (SDK),

At present, the integration of virtual machine related interfaces has been achieved. Other interfaces can be improved on their own if needed, or help to improve this package.

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
// test.php
require_once ("vendor/autoload.php");

use BigbugGg\Zenlayer\Instance;

$appId = 'YOUR-APP-ID';
$secretKey = 'YOUR-SECRET-KEY';
$instance = new Instance($appId, $secretKey);

$zoneId = 'PAR-A';
$data = $instance->describeZones([$zoneId]);
var_dump($data);

```
Output:
```shell
 php .\test.php
array(1) {
  [0]=>
  object(BigbugGg\Zenlayer\Value\ZoneValue)#6 (2) {
    ["zoneId"]=>
    string(5) "PAR-A"
    ["zoneName"]=>
    string(5) "Paris"
  }
}
```

# How to extend other interfaces
Inheriting the Fetch class, which encapsulates the signature and request

```php
require_once ("vendor/autoload.php");

use BigbugGg\Zenlayer\Fetch;

class SimpleExample extends Fetch
{
    /**
     * @throws JsonException
     */
    public function zenlayerCallName(): array
    {
        $dataArr = $this->fetch('ZenlayerCallName', [
            // Parameters  => Values
        ]);
        // other logic codes
        return $dataArr;
    }
}
```
Usage

```php
$appId = 'YOUR-APP-ID';
$secretKey = 'YOUR-SECRET-KEY';
$instance = new SimpleExample($appId, $secretKey);
$data = $instance->zenlayerCallName();
var_dump($data);
```
