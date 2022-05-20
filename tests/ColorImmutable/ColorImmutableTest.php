<?php
declare(strict_types=1);

namespace Tests\ColorImmutable;

use
    PHPUnit\Framework\TestCase;

final class ColorImmutableTest extends TestCase
{

    use
        AttributesTest,
        CreateTest,
        FormattingTest,
        ManipulationTest,
        PaletteTest,
        SchemesTest,
        StaticTest;

}
