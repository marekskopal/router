<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\TestFile;

use MarekSkopal\Router\Attribute\RouteGet;

#[RouteGet('/test-two-class')]
class TestFileTwoClass
{
    public function __invoke(): void
    {
        //empty body
    }
}

#[RouteGet('/test-three-class')]
class TestFileThreeClass
{
    public function __invoke(): void
    {
        //empty body
    }
}
