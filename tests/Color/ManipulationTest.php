<?php
declare(strict_types=1);

namespace Tests\Color;

use
    Fyre\Color\Color;

trait ManipulationTest
{

    public function testDarken(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->darken(.5);

        $this->assertSame(
            '#204020',
            $color1->toString(),
        );

        $this->assertSame(
            $color1,
            $color2
        );
    }

    public function testInvert(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->invert();

        $this->assertSame(
            '#bf80bf',
            $color1->toString(),
        );

        $this->assertSame(
            $color1,
            $color2
        );
    }

    public function testLighten(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->lighten(.5);

        $this->assertSame(
            '#95ca95',
            $color1->toString()
        );

        $this->assertSame(
            $color1,
            $color2
        );
    }

    public function testShade(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->shade(.3);

        $this->assertSame(
            '#2d592d',
            $color1->toString(),
        );

        $this->assertSame(
            $color1,
            $color2
        );
    }

    public function testTint(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->tint(.3);

        $this->assertSame(
            '#79a679',
            $color1->toString(),
        );

        $this->assertSame(
            $color1,
            $color2
        );
    }

    public function testTone(): void
    {
        $color1 = Color::fromHSV(120, 50, 50);
        $color2 = $color1->tone(.3);

        $this->assertSame(
            '#538053',
            $color1->toString(),
        );

        $this->assertSame(
            $color1,
            $color2
        );
    }

}
