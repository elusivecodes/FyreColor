<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Color\Colors\Lch;
use PHPUnit\Framework\TestCase;

final class LchTest extends TestCase
{
    public function testConstructorClamping(): void
    {
        $color = new Lch(150, -150, -30, 1.5);

        $this->assertSame(
            'lch(100 0 330)',
            $color->toString()
        );
    }

    public function testContrast(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = Lch::createFromString('black');

        $this->assertSame(17.06375239037742, $color1->contrast($color2));
        $this->assertSame(17.06375239037742, $color2->contrast($color1));
    }

    public function testGetChroma(): void
    {
        $color = Lch::createFromString('lavender');

        $this->assertEquals(10.112485226318423, $color->getChroma());
    }

    public function testGetHue(): void
    {
        $color = Lch::createFromString('lavender');

        $this->assertEquals(285.9315434239657, $color->getHue());
    }

    public function testGetLightness(): void
    {
        $color = Lch::createFromString('lavender');

        $this->assertEquals(91.74227138900844, $color->getLightness());
    }

    public function testLabel(): void
    {
        $color = Lch::createFromString('lavender')->withLightness(50);

        $this->assertSame('slategray', $color->label());
    }

    public function testLuma(): void
    {
        $color = Lch::createFromString('lavender');

        $this->assertSame(0.8031876195188711, $color->luma());
    }

    public function testSpace(): void
    {
        $color = new Lch();

        $this->assertSame('lch', $color->space());
    }

    public function testToA98Rgb(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toA98Rgb();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(a98-rgb 0.9 0.9 0.98)',
            $color2->toString()
        );
    }

    public function testToArray(): void
    {
        $color = Lch::createFromString('lavender');

        $this->assertEquals(
            [
                'lightness' => 91.74227138900844,
                'chroma' => 10.112485226318423,
                'hue' => 285.9315434239657,
                'alpha' => 1,
            ],
            $color->toArray()
        );
    }

    public function testToDisplayP3(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toDisplayP3();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(display-p3 0.9 0.9 0.97)',
            $color2->toString()
        );
    }

    public function testToDisplayP3Linear(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toDisplayP3Linear();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(display-p3-linear 0.79 0.79 0.94)',
            $color2->toString()
        );
    }

    public function testToHex(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toHex();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            '#e6e6fa',
            $color2->toString()
        );
    }

    public function testToHsl(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toHsl();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'hsl(240deg 66.67% 94.12%)',
            $color2->toString()
        );
    }

    public function testToHwb(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toHwb();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'hwb(240deg 90.2% 1.96%)',
            $color2->toString()
        );
    }

    public function testToLab(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toLab();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'lab(91.74 2.78 -9.72)',
            $color2->toString()
        );
    }

    public function testToLch(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toLch();

        $this->assertSame(
            $color1,
            $color2
        );
    }

    public function testToOkLab(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toOkLab();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'oklab(0.93 0.01 -0.03)',
            $color2->toString()
        );
    }

    public function testToOkLch(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toOkLch();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'oklch(0.93 0.03 285.8)',
            $color2->toString()
        );
    }

    public function testToProPhotoRgb(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toProPhotoRgb();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(prophoto-rgb 0.89 0.88 0.96)',
            $color2->toString()
        );
    }

    public function testToRec2020(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toRec2020();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(rec2020 0.89 0.89 0.97)',
            $color2->toString()
        );
    }

    public function testToRgb(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toRgb();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'rgb(230 230 250)',
            $color2->toString()
        );
    }

    public function testToSrgb(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toSrgb();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(srgb 0.9 0.9 0.98)',
            $color2->toString()
        );
    }

    public function testToSrgbLinear(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toSrgbLinear();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(srgb-linear 0.79 0.79 0.96)',
            $color2->toString()
        );
    }

    public function testToString(): void
    {
        $color = Lch::createFromString('lavender');

        $this->assertSame(
            'lch(91.74 10.11 285.93)',
            $color->toString()
        );

        $this->assertSame(
            'lch(91.74 10.11 285.93)',
            (string) $color
        );
    }

    public function testToStringWithAlpha(): void
    {
        $color = Lch::createFromString('lavender')->withAlpha(0.5);

        $this->assertSame(
            'lch(91.74 10.11 285.93 / 0.5)',
            $color->toString()
        );
    }

    public function testToXyzD50(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toXyzD50();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(xyz-d50 0.79 0.8 0.77)',
            $color2->toString()
        );
    }

    public function testToXyzD65(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->toXyzD65();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(xyz-d65 0.78 0.8 1.02)',
            $color2->toString()
        );
    }

    public function testWithChroma(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->withChroma(50);

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'lch(91.74 50 285.93)',
            $color2->toString()
        );
    }

    public function testWithHue(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->withHue(100);

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'lch(91.74 10.11 100)',
            $color2->toString()
        );
    }

    public function testWithLightness(): void
    {
        $color1 = Lch::createFromString('lavender');
        $color2 = $color1->withLightness(50);

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'lch(50 10.11 285.93)',
            $color2->toString()
        );
    }
}
