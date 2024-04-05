<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\RouteProvider;

use MarekSkopal\Router\Provider\ClassRouteProvider;
use MarekSkopal\Router\Tests\TestFile\TestFileClassAndMethod;
use MarekSkopal\Router\Tests\TestFile\TestFileOneClass;
use MarekSkopal\Router\Tests\TestFile\TestFileOneMethod;
use MarekSkopal\Router\Tests\TestFile\TestFileTwoMethod;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

#[CoversClass(ClassRouteProvider::class)]
class ClassRouteProviderTest extends TestCase
{
    #[TestWith([TestFileOneClass::class, 1, [TestFileOneClass::class . '::__invoke']])]
    #[TestWith([TestFileOneMethod::class, 1, [TestFileOneMethod::class . '::actionGet']])]
    #[TestWith([TestFileTwoMethod::class, 2, [TestFileTwoMethod::class . '::actionGetOne', TestFileTwoMethod::class . '::actionGetTwo']])]
    #[TestWith([
        TestFileClassAndMethod::class,
        2,
        [
            TestFileClassAndMethod::class . '::__invoke',
            TestFileClassAndMethod::class . '::action',
        ],
    ])]
    public function testGetRoutes(string $class, int $expectedCount, array $expectedClassAndMethods): void
    {
        $routeProvider = new ClassRouteProvider($class);
        $routes = $routeProvider->getRoutes();

        $this->assertCount($expectedCount, $routes);
        foreach ($expectedClassAndMethods as $expectedClassAndMethod) {
            $this->assertArrayHasKey($expectedClassAndMethod, $routes);
        }
    }
}
