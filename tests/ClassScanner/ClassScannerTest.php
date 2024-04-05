<?php

declare(strict_types=1);

namespace MarekSkopal\Router\Tests\ClassScanner;

use MarekSkopal\Router\Scanner\ClassScanner;
use MarekSkopal\Router\Tests\TestFile\TestFileOneClass;
use MarekSkopal\Router\Tests\TestFile\TestFileThreeClass;
use MarekSkopal\Router\Tests\TestFile\TestFileTwoClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;

#[CoversClass(ClassScanner::class)]
class ClassScannerTest extends TestCase
{
    #[TestWith([__DIR__ . '/../TestFile/TestFileOneClass.php', 1, [TestFileOneClass::class]])]
    #[TestWith([__DIR__ . '/../TestFile/TestFileTwoClass.php', 2, [TestFileTwoClass::class, TestFileThreeClass::class]])]
    public function testGetClasses(string $filePath, int $expectedCount, array $expectedClasses): void
    {
        $classScanner = new ClassScanner($filePath);
        $classes = $classScanner->findClasses();

        $this->assertCount($expectedCount, $classes);
        foreach ($expectedClasses as $expectedClass) {
            $this->assertContains($expectedClass, $classes);
        }
    }
}
