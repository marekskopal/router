<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\TestFile;

use MarekSkopal\Router\Attribute\RouteGet;

#[RouteGet('/test-one-class')]
class TestFileClassAndMethod
{
    public function __invoke(): void
    {
        //empty body
    }

    #[RouteGet('/action')]
    public function action(): void
    {
        //empty body
    }
}
