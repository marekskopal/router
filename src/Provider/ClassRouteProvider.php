<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Provider;

use MarekSkopal\Router\Attribute\Route;
use ReflectionClass;

class ClassRouteProvider
{
    /** @param class-string $className */
    public function __construct(private readonly string $className)
    {
    }

    /** @return array<string,Route> */
    public function getRoutes(): array
    {
        $routes = [];

        $attributes = (new ReflectionClass($this->className))->getAttributes();
        if (count($attributes) === 0) {
            return [];
        }

        foreach ($attributes as $attribute) {
            $attributeInstance = $attribute->newInstance();

            if ($attributeInstance instanceof Route) {
                $routes[$this->className . '::__invoke()'] = $attributeInstance;
            }
        }

        return $routes;
    }
}
