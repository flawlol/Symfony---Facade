<?php

namespace Flawlol\Facade\Abstract;

use Flawlol\Facade\Exception\ContainerIsAlreadySetException;
use Flawlol\Facade\Exception\ContainerIsNotSetException;
use Flawlol\Facade\Interface\FacadeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Abstract class Facade.
 *
 * This abstract class provides a base implementation for a facade that interacts with a container.
 */
abstract class Facade implements FacadeInterface
{
    /**
     * @var ContainerInterface|null The container instance.
     */
    protected static ?ContainerInterface $container = null;

    /**
     * Get the container instance.
     *
     * @return ContainerInterface|null The container instance or null if not set.
     */
    public static function getContainer(): ?ContainerInterface
    {
        return self::$container;
    }

    /**
     * Set the container instance.
     *
     * @param ?ContainerInterface $container The container instance to set.
     *
     * @throws ContainerIsAlreadySetException If the container is already set.
     *
     * @return void
     */
    public static function setContainer(?ContainerInterface $container): void
    {
        if (null === $container) {
            throw new \InvalidArgumentException('Container cannot be null');
        }

        if (null !== self::$container) {
            throw new ContainerIsAlreadySetException('Container is already set');
        }

        self::$container = $container;
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param string $method The method name being called.
     * @param array  $args   The arguments passed to the method.
     *
     * @throws ContainerIsNotSetException If the container is not set.
     * @throws \BadMethodCallException    If the method does not exist on the service.
     *
     * @return mixed The result of the method call.
     */
    public static function __callStatic(string $method, array $args): mixed
    {
        if (null === self::$container) {
            throw new ContainerIsNotSetException('Container is not set');
        }

        $static = static::class;
        $accessor = $static::getFacadeAccessor();

        $service = self::$container->get($accessor);

        if (!method_exists($service, $method)) {
            throw new \BadMethodCallException(sprintf('Method %s does not exist', $method));
        }

        return call_user_func_array([$service, $method], $args);
    }

    /**
     * Get the facade accessor.
     *
     * This method should be implemented by the concrete facade class to return the key
     * used to retrieve the service from the container.
     *
     * @return string The facade accessor key.
     */
    abstract protected static function getFacadeAccessor(): string;
}
