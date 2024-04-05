<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Provider;

use MarekSkopal\Router\Attribute\Route;
use MarekSkopal\Router\Scanner\ClassScanner;
use Nette\Utils\Finder;

class RouteProvider
{
    public function __construct(private readonly string $directory)
    {
    }

    /** @return array<string,Route> */
    public function getRoutes(): array
    {
        $routes = [];

        $phpFiles = Finder::findFiles($this->directory . '/**/*.php');

        foreach ($phpFiles as $phpFile) {
            $classScanner = new ClassScanner($phpFile->getRealPath());

            foreach ($classScanner->findClasses() as $class) {
                $routeProvider = new ClassRouteProvider($class);
                $routes = array_merge($routes, $routeProvider->getRoutes());
            }
        }

        return $routes;
    }
}
