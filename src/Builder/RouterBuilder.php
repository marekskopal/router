<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Builder;

use League\Route\Router;
use MarekSkopal\Router\Provider\RouteProvider;

class RouterBuilder
{
    /** @var list<string> */
    private array $classDirectories = [];

    public function build(): Router
    {
        $router = new Router();

        foreach ($this->classDirectories as $classDirectory) {
            $routeProvider = new RouteProvider($classDirectory);
            foreach ($routeProvider->getRoutes() as $classWithMethod => $routeAttribute) {
                $router->map(
                    method: $routeAttribute->getMethod()->value,
                    path: $routeAttribute->getPath(),
                    handler: explode('::', $classWithMethod),
                );
            }
        }

        return $router;
    }

    /** @param list<string> $classDirectories */
    public function setClassDirectories(array $classDirectories): self
    {
        $this->classDirectories = $classDirectories;

        return $this;
    }
}
