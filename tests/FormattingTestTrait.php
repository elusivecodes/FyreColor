<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Color\Color;

trait FormattingTestTrait
{

    public function testToHexShort(): void
    {
        $this->assertSame(
            '#111',
            Color::fromRGB(17, 17, 17)->toHexString()
        );
    }

    public function testToHexShortWithAlpha(): void
    {
        $this->assertSame(
            '#1116',
            Color::fromRGB(17, 17, 17, .4)->toHexString()
        );
    }

    public function testToHex(): void
    {
        $this->assertSame(
            '#783232',
            Color::fromRGB(120, 50, 50)->toHexString()
        );
    }

    public function testToHexWithAlpha(): void
    {
        $this->assertSame(
            '#78323266',
            Color::fromRGB(120, 50, 50, .4)->toHexString()
        );
    }

    public function testToRGB(): void
    {
        $this->assertSame(
            'rgb(120 50 50)',
            Color::fromRGB(120, 50, 50)->toRGBString()
        );
    }

    public function testToRGBA(): void
    {
        $this->assertSame(
            'rgb(120 50 50 / 50%)',
            Color::fromRGB(120, 50, 50, .5)->toRGBString()
        );
    }

    public function testToHSL(): void
    {
        $this->assertSame(
            'hsl(120deg 50% 50%)',
            Color::fromHSL(120, 50, 50)->toHSLString()
        );
    }

    public function testToHSLA(): void
    {
        $this->assertSame(
            'hsl(120deg 50% 50% / 50%)',
            Color::fromHSL(120, 50, 50, .5)->toHSLString()
        );
    }

    public function testLabel(): void
    {
        $this->assertSame(
            'saddlebrown',
            Color::fromRGB(120, 50, 50)->label()
        );
    }

}
