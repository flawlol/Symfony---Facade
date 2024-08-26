<?php

namespace Flawlol\Facade\Exception;

class ContainerIsNotSetException extends \Exception
{
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}
