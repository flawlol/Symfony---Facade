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