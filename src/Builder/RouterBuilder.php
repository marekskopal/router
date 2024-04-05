<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Builder;

use League\Route\Router;
use MarekSkopal\Router\Attribute\Route;
use MarekSkopal\Router\Provider\RouteProvider;
use Psr\SimpleCache\CacheInterface;

class RouterBuilder
{
    private const CacheKey = 'routes';

    /** @var list<string> */
    private array $classDirectories = [];

    private ?CacheInterface $cache = null;

    private string $cacheKey = self::CacheKey;

    public function build(): Router
    {
        $router = new Router();

        /** @var array<string,Route>|null $routes */
        $routes = $this->cache?->get($this->cacheKey);
        if ($routes !== null) {
            $this->mapRoutes($router, $routes);

            return $router;
        }

        foreach ($this->classDirectories as $classDirectory) {
            $routeProvider = new RouteProvider($classDirectory);

            $routes = $routeProvider->getRoutes();

            $this->mapRoutes($router, $routes);

            $this->cache?->set($this->cacheKey, $routes);
        }

        return $router;
    }

    /** @param list<string> $classDirectories */
    public function setClassDirectories(array $classDirectories): self
    {
        $this->classDirectories = $classDirectories;

        return $this;
    }

    public function setCache(?CacheInterface $cache): self
    {
        $this->cache = $cache;

        return $this;
    }

    public function setCacheKey(string $cacheKey): self
    {
        $this->cacheKey = $cacheKey;

        return $this;
    }

    /** @param array<string,Route> $routes */
    private function mapRoutes(Router $router, array $routes): void
    {
        foreach ($routes as $classWithMethod => $routeAttribute) {
            $router->map(
                method: $routeAttribute->getMethod()->value,
                path: $routeAttribute->getPath(),
                handler: explode('::', $classWithMethod),
            );
        }
    }
}
