<?php
declare(strict_types=1);

namespace Tests\Color;

use
    PHPUnit\Framework\TestCase;

final class ColorTest extends TestCase
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
