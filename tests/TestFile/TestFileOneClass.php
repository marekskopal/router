<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\TestFile;

use MarekSkopal\Router\Attribute\RouteGet;

#[RouteGet('/test-one-class')]
class TestFileOneClass
{
    public function __invoke(): void
    {
        //empty body
    }
}
