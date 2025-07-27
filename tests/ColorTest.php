<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Color\Color;
use Fyre\Utility\Traits\MacroTrait;
use PHPUnit\Framework\TestCase;

use function class_uses;

final class ColorTest extends TestCase
{
    use AttributesTestTrait;
    use CreateTestTrait;
    use FormattingTestTrait;
    use ManipulationTestTrait;
    use PaletteTestTrait;
    use SchemesTestTrait;
    use StaticTestTrait;

    public function testMacroable(): void
    {
        $this->assertContains(
            MacroTrait::class,
            class_uses(Color::class)
        );
    }
}
