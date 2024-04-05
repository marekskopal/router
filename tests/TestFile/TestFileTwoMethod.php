<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\TestFile;

use MarekSkopal\Router\Attribute\RouteGet;

class TestFileTwoMethod
{
    #[RouteGet('/action-get-one')]
    public function actionGetOne(): void
    {
        //empty body
    }

    #[RouteGet('/action-get-two')]
    public function actionGetTwo(): void
    {
        //empty body
    }
}
