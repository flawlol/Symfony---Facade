<?php

namespace Flawlol\Facade\Interface;

use Psr\Container\ContainerInterface;

/**
 * Interface FacadeInterface.
 *
 * This interface defines the contract for a facade that interacts with a container.
 */
interface FacadeInterface
{
    /**
     * Get the container instance.
     *
     * @return ContainerInterface|null The container instance or null if not set.
     */
    public static function getContainer(): ?ContainerInterface;

    /**
     * Set the container instance.
     *
     * @param ContainerInterface $container The container instance to set.
     *
     * @return void
     */
    public static function setContainer(ContainerInterface $container): void;

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param string $method The method name being called.
     * @param array  $args   The arguments passed to the method.
     *
     * @return string The result of the method call.
     */
    public static function __callStatic(string $method, array $args): string;
}
