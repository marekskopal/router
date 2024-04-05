<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\RouteProvider;

use MarekSkopal\Router\Provider\RouteProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(RouteProvider::class)]
class RouteProviderTest extends TestCase
{
    public function testGetRoutes(): void
    {
        $routeProvider = new RouteProvider(__DIR__ . '/../TestFile');
        $routes = $routeProvider->getRoutes();

        $this->assertCount(3, $routes);
        $this->assertArrayHasKey('MarekSkopal\Router\Tests\TestFile\TestFileOneClass::__invoke()', $routes);
        $this->assertArrayHasKey('MarekSkopal\Router\Tests\TestFile\TestFileTwoClass::__invoke()', $routes);
        $this->assertArrayHasKey('MarekSkopal\Router\Tests\TestFile\TestFileThreeClass::__invoke()', $routes);
    }
}
