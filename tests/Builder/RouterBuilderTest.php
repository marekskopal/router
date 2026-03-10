<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\Builder;

use League\Route\Route;
use League\Route\Router;
use MarekSkopal\Router\Builder\RouterBuilder;
use MarekSkopal\Router\Tests\TestFile\TestFileClassAndMethod;
use MarekSkopal\Router\Tests\TestFile\TestFileOneClass;
use MarekSkopal\Router\Tests\TestFile\TestFileOneMethod;
use MarekSkopal\Router\Tests\TestFile\TestFileTwoMethod;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

#[CoversClass(RouterBuilder::class)]
class RouterBuilderTest extends TestCase
{
    public function testBuildReturnsRouter(): void
    {
        $router = (new RouterBuilder())
            ->setClassDirectories([__DIR__ . '/../TestFile'])
            ->build();

        self::assertInstanceOf(Router::class, $router);
    }

    public function testBuildRegistersAllRoutes(): void
    {
        $router = (new RouterBuilder())
            ->setClassDirectories([__DIR__ . '/../TestFile'])
            ->build();

        /** @var Route[] $routes */
        $routes = (new ReflectionClass($router))->getProperty('routes')->getValue($router);
        self::assertIsArray($routes);

        self::assertCount(8, $routes);
    }

    public function testBuildMergesRoutesFromMultipleDirectories(): void
    {
        $testFileDir = __DIR__ . '/../TestFile';

        // Same directory twice: identical class+method keys are merged, so count stays 8
        $router = (new RouterBuilder())
            ->setClassDirectories([$testFileDir, $testFileDir])
            ->build();

        /** @var Route[] $routes */
        $routes = (new ReflectionClass($router))->getProperty('routes')->getValue($router);
        self::assertIsArray($routes);

        self::assertCount(8, $routes);
    }

    public function testBuildRegistersCorrectPaths(): void
    {
        $router = (new RouterBuilder())
            ->setClassDirectories([__DIR__ . '/../TestFile'])
            ->build();

        /** @var Route[] $routes */
        $routes = (new ReflectionClass($router))->getProperty('routes')->getValue($router);
        self::assertIsArray($routes);

        $pathsByHandler = [];
        foreach ($routes as $route) {
            $handler = (new ReflectionClass($route))->getProperty('handler')->getValue($route);
            self::assertIsString($handler);
            $pathsByHandler[$handler] = $route->getPath();
        }

        self::assertSame('/test-one-class', $pathsByHandler[TestFileOneClass::class . '::__invoke']);
        self::assertSame('/action-get', $pathsByHandler[TestFileOneMethod::class . '::actionGet']);
        self::assertSame('/action-get-one', $pathsByHandler[TestFileTwoMethod::class . '::actionGetOne']);
        self::assertSame('/action-get-two', $pathsByHandler[TestFileTwoMethod::class . '::actionGetTwo']);
        self::assertSame('/test-one-class', $pathsByHandler[TestFileClassAndMethod::class . '::__invoke']);
        self::assertSame('/action', $pathsByHandler[TestFileClassAndMethod::class . '::action']);
    }
}
