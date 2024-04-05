<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Provider;

use MarekSkopal\Router\Attribute\Route;
use ReflectionClass;

class ClassRouteProvider
{
    private readonly ReflectionClass $reflectionClass;

    /** @param class-string $className */
    public function __construct(private readonly string $className)
    {
        $this->reflectionClass = new ReflectionClass($this->className);
    }

    /** @return array<string,Route> */
    public function getRoutes(): array
    {
        $routes = [];

        $routes = array_merge($routes, $this->getClassRoutes());

        $routes = array_merge($routes, $this->getMethodRoutes());

        return $routes;
    }

    /** @return array<string,Route> */
    private function getClassRoutes(): array
    {
        $routes = [];

        $attributes = $this->reflectionClass->getAttributes();
        foreach ($attributes as $attribute) {
            $attributeInstance = $attribute->newInstance();

            if ($attributeInstance instanceof Route) {
                $routes[$this->className . '::__invoke'] = $attributeInstance;
            }
        }

        return $routes;
    }

    /** @return array<string,Route> */
    private function getMethodRoutes(): array
    {
        $routes = [];

        $methods = $this->reflectionClass->getMethods();
        foreach ($methods as $method) {
            $attributes = $method->getAttributes();
            foreach ($attributes as $attribute) {
                $attributeInstance = $attribute->newInstance();

                if ($attributeInstance instanceof Route) {
                    $routes[$this->className . '::' . $method->getName()] = $attributeInstance;
                }
            }
        }

        return $routes;
    }
}
