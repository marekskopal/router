<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\RouteProvider;

use MarekSkopal\Router\Provider\ClassRouteProvider;
use MarekSkopal\Router\Tests\TestFile\TestFileOneClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ClassRouteProvider::class)]
class ClassRouteProviderTest extends TestCase
{
    public function testGetRoutes(): void
    {
        $routeProvider = new ClassRouteProvider(TestFileOneClass::class);
        $routes = $routeProvider->getRoutes();

        $this->assertCount(1, $routes);
        $this->assertArrayHasKey('MarekSkopal\Router\Tests\TestFile\TestFileOneClass::__invoke()', $routes);
    }
}
