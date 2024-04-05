<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\Builder;

use League\Route\Router;
use MarekSkopal\Router\Builder\RouterBuilder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(RouterBuilder::class)]
class RouterBuilderTest extends TestCase
{
    public function testConstruct(): void
    {
        $routerBuilder = new RouterBuilder();
        $routerBuilder->setClassDirectories([__DIR__ . '/../TestFile']);

        $router = $routerBuilder->build();

        $this->assertInstanceOf(Router::class, $router);
    }
}
