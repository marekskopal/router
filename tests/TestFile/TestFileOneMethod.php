<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\TestFile;

use MarekSkopal\Router\Attribute\RouteGet;

class TestFileOneMethod
{
    #[RouteGet('/action-get')]
    public function actionGet(): void
    {
        //empty body
    }
}
