<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Color\Color;

trait ManipulationTestTrait
{
    public function testDarken(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->darken(.5);

        $this->assertSame(
            '#408040',
            $color1->toString()
        );

        $this->assertSame(
            '#204020',
            $color2->toString(),
        );
    }

    public function testInvert(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->invert();

        $this->assertSame(
            '#408040',
            $color1->toString()
        );

        $this->assertSame(
            '#bf80bf',
            $color2->toString(),
        );
    }

    public function testLighten(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->lighten(.5);

        $this->assertSame(
            '#408040',
            $color1->toString()
        );

        $this->assertSame(
            '#95ca95',
            $color2->toString(),
        );
    }

    public function testShade(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->shade(.3);

        $this->assertSame(
            '#408040',
            $color1->toString()
        );

        $this->assertSame(
            '#2d592d',
            $color2->toString(),
        );
    }

    public function testTint(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->tint(.3);

        $this->assertSame(
            '#408040',
            $color1->toString()
        );

        $this->assertSame(
            '#79a679',
            $color2->toString(),
        );
    }

    public function testTone(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->tone(.3);

        $this->assertSame(
            '#408040',
            $color1->toString()
        );

        $this->assertSame(
            '#538053',
            $color2->toString(),
        );
    }
}
