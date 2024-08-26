[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/flawlol/symfony-facade/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/flawlol/symfony-facade/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/flawlol/symfony-facade/badges/build.png?b=main)](https://scrutinizer-ci.com/g/flawlol/symfony-facade/build-status/main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/flawlol/symfony-facade/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)

[![Latest Stable Version](https://poser.pugx.org/flawlol/facade/v)](https://packagist.org/packages/flawlol/facade)
[![Total Downloads](https://poser.pugx.org/flawlol/facade/downloads)](https://packagist.org/packages/flawlol/facade)
[![Latest Unstable Version](https://poser.pugx.org/flawlol/facade/v/unstable)](https://packagist.org/packages/flawlol/facade)
[![License](https://poser.pugx.org/flawlol/facade/license)](https://packagist.org/packages/flawlol/facade)
[![PHP Version Require](https://poser.pugx.org/flawlol/facade/require/php)](https://packagist.org/packages/flawlol/facade)
# Symfony - Facade

## Author
- name: **Norbert Kecső**
- email: **flawlesslol123@gmail.com**

## Overview

This project provides a facade implementation for Symfony applications. The facade pattern is used to provide a simplified interface to a complex subsystem. In this case, the facade interacts with a container to manage dependencies.

## Installation

To install the package, use Composer:

```bash
composer require flawlol/facade
```

## Usage
Defining a Facade

To define a facade, create a class that extends the `Facade` abstract class and implements the `getFacadeAccessor` method. This method should return the name of the service in the container that the facade will interact with.

```php
<?php

namespace App\Facade;

use Flawlol\Facade\Abstract\Facade;

class MyFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'my_service';
    }
}
```

## Using the Facade
Once the facade is defined, you can use it to call methods on the underlying service.

```php
use App\Facade\MyFacade;

$result = MyFacade::someMethod($arg1, $arg2);
```

## Setting the Container
The container is automatically set during the bundle boot process. Ensure that your bundle extends `FacadeBundle`.
    
```php
<?php

namespace Flawlol\Facade;

use Flawlol\Facade\Abstract\Facade;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FacadeBundle extends Bundle
{
    public function boot(): void
    {
        parent::boot();

        $container = $this->container;

        Facade::setContainer($container);
    }
}
```

## Exceptions
The package defines the following exceptions:

- `ContainerIsAlreadySetException`: Thrown when attempting to set the container more than once.
- `ContainerIsNotSetException`: Thrown when attempting to use the facade without setting the container.

## IDE Helper
The `flawlol/facade-ide-helper` package provides a command to generate IDE helper files for facades in Symfony.
Its recommended to use this package to improve IDE autocompletion and static analysis.

Its also recommended to use the `flawlol/facade-ide-helper` package as a dev dependency.

```bash
composer require --dev flawlol/facade-ide-helper
```

The `_ide-helper.php` file provides helper classes to improve IDE autocompletion and static analysis. These helpers act as proxies to the actual service methods, 
making it easier to work with facades in your IDE.

To generate the facade helpers, run the following command:
```php bin/console app:generate-facade-helpers```

### Example
The following example demonstrates the helper class generated for a facade named `Arr`:

```php
<?php

namespace App\Facade {
    class Arr
    {
        /**
         * @param array $array
         * @param string $keyPath
         * @param mixed $defaultValue
         * @return mixed
         */
        public static function get(array $array, string $keyPath, mixed $defaultValue = NULL): mixed
        {
            /** @var \App\Service\Common\Array\ArrayHelper $instance */
            return $instance->get($array, $keyPath, $defaultValue);
        }
    }
}
```
- Namespace: `App\Facade`
- Class: `Arr`
- Method: `get(array $array, string $keyPath, mixed $defaultValue = null)`

The `Arr` class provides a static method `get` to retrieve values from an array using a key path. 
This method acts as a proxy to the `get` method of the `ArrayHelper` service, allowing you to use the facade for cleaner and more readable code.

## Real World Example
If you you have a service like this:

```php
<?php

namespace App\Service\Common\Array;

class ArrayHelper
{
    public function get(array $array, string $keyPath, mixed $defaultValue = null): mixed
    {
        // implementation
    }
}
```

You can use the facade like this, and the IDE will provide autocompletion and type hints:
```php
use App\Facade\Arr;

$result = Arr::get($array, 'key.path', 'default');
```

### Inside the Facade Class
Make sure the Service is register in `getFacadeAccessor` method in the Facade class.

```php
<?php

namespace App\Facade;

use Flawlol\Facade\Abstract\Facade;

class Arr extends
{
    protected static function getFacadeAccessor(): string
    {
        return ArrayHelper::class;
    }
}
```


## License
This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
