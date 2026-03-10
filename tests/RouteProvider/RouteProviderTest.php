<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\RouteProvider;

use MarekSkopal\Router\Provider\RouteProvider;
use MarekSkopal\Router\Tests\TestFile\TestFileClassAndMethod;
use MarekSkopal\Router\Tests\TestFile\TestFileOneClass;
use MarekSkopal\Router\Tests\TestFile\TestFileOneMethod;
use MarekSkopal\Router\Tests\TestFile\TestFileThreeClass;
use MarekSkopal\Router\Tests\TestFile\TestFileTwoClass;
use MarekSkopal\Router\Tests\TestFile\TestFileTwoMethod;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(RouteProvider::class)]
class RouteProviderTest extends TestCase
{
    public function testGetRoutes(): void
    {
        $routeProvider = new RouteProvider(__DIR__ . '/../TestFile');
        $routes = $routeProvider->getRoutes();

        $this->assertCount(8, $routes);
        $this->assertArrayHasKey(TestFileOneClass::class . '::__invoke', $routes);
        $this->assertArrayHasKey(TestFileTwoClass::class . '::__invoke', $routes);
        $this->assertArrayHasKey(TestFileThreeClass::class . '::__invoke', $routes);
        $this->assertArrayHasKey(TestFileOneMethod::class . '::actionGet', $routes);
        $this->assertArrayHasKey(TestFileTwoMethod::class . '::actionGetOne', $routes);
        $this->assertArrayHasKey(TestFileTwoMethod::class . '::actionGetTwo', $routes);
        $this->assertArrayHasKey(TestFileClassAndMethod::class . '::__invoke', $routes);
        $this->assertArrayHasKey(TestFileClassAndMethod::class . '::action', $routes);
    }
}
