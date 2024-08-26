<?php

namespace Flawlol\Facade\Exception;

class ContainerIsAlreadySetException extends \Exception
{
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}
