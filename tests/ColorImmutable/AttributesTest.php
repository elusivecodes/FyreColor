<?php
declare(strict_types=1);

namespace Tests\ColorImmutable;

use
    Fyre\Color\ColorImmutable;

trait AttributesTest
{

    public function testGetAlpha(): void
    {
        $this->assertSame(
            .75,
            ColorImmutable::fromRGB(0, 0, 0, .75)->getAlpha()
        );
    }

    public function testGetBrightness(): void
    {
        $this->assertSame(
            75.0,
            ColorImmutable::fromHSV(180, 50, 75)->getBrightness()
        );
    }

    public function testGetHue(): void
    {
        $this->assertSame(
            270.0,
            ColorImmutable::fromHSV(270, 50, 50)->getHue()
        );
    }

    public function testGetSaturation(): void
    {
        $this->assertSame(
            25.0,
            ColorImmutable::fromHSV(180, 25, 50)->getSaturation()
        );
    }

    public function testLuma(): void
    {
        $this->assertSame(
            .17935225036098287,
            ColorImmutable::fromHSV(180, 50, 50)->luma()
        );
    }

    public function testSetAlpha(): void
    {
        $color1 = ColorImmutable::fromHSV(120, 50, 50);
        $color2 = $color1->setAlpha(.75);

        $this->assertSame(
            1.0,
            $color1->getAlpha(),
        );

        $this->assertSame(
            .75,
            $color2->getAlpha(),
        );
    }

    public function testSetBrightness(): void
    {
        $color1 = ColorImmutable::fromHSV(120, 50, 50);
        $color2 = $color1->setBrightness(75);

        $this->assertSame(
            50.0,
            $color1->getBrightness(),
        );

        $this->assertSame(
            75.0,
            $color2->getBrightness(),
        );
    }

    public function testSetHue(): void
    {
        $color1 = ColorImmutable::fromHSV(120, 50, 50);
        $color2 = $color1->setHue(270);

        $this->assertSame(
            120.0,
            $color1->getHue(),
        );

        $this->assertSame(
            270.0,
            $color2->getHue(),
        );
    }

    public function testSetSaturation(): void
    {
        $color1 = ColorImmutable::fromHSV(120, 50, 50);
        $color2 = $color1->setSaturation(25);

        $this->assertSame(
            50.0,
            $color1->getSaturation(),
        );

        $this->assertSame(
            25.0,
            $color2->getSaturation(),
        );
    }

}
