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

To define a facade, create a class that extends the Facade abstract class and implements the getFacadeAccessor method. This method should return the name of the service in the container that the facade will interact with.

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
The container is automatically set during the bundle boot process. Ensure that your bundle extends FacadeBundle.
    
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

- ContainerIsAlreadySetException: Thrown when attempting to set the container more than once.
-  ContainerIsNotSetException: Thrown when attempting to use the facade without setting the container.

## License
This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
