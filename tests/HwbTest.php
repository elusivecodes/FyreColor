<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Color\Colors\Hwb;
use PHPUnit\Framework\TestCase;

final class HwbTest extends TestCase
{
    public function testConstructorClamping(): void
    {
        $color = new Hwb(390, -100, 300, 1.5);

        $this->assertSame(
            'hwb(30deg 0% 100%)',
            $color->toString()
        );
    }

    public function testContrast(): void
    {
        $color1 = Hwb::createFromString('lavender');
        $color2 = Hwb::createFromString('black');

        $this->assertSame(17.063750102904258, $color1->contrast($color2));
        $this->assertSame(17.063750102904258, $color2->contrast($color1));
    }

    public function testGetBlackness(): void
    {
        $color = Hwb::createFromString('lavender');

        $this->assertEquals(1.9607843137254943, $color->getBlackness());
    }

    public function testGetHue(): void
    {
        $color = Hwb::createFromString('lavender');

        $this->assertEquals(240, $color->getHue());
    }

    public function testGetWhiteness(): void
    {
        $color = Hwb::createFromString('lavender');

        $this->assertEquals(90.19607843137256, $color->getWhiteness());
    }

    public function testLabel(): void
    {
        $color = Hwb::createFromString('lavender')->withWhiteness(50);

        $this->assertSame('mediumslateblue', $color->label());
    }

    public function testLuma(): void
    {
        $color = Hwb::createFromString('lavender');

        $this->assertSame(0.8031875051452129, $color->luma());
    }

    public function testSpace(): void
    {
        $color = new Hwb();

        $this->assertSame('hwb', $color->space());
    }

    public function testToA98Rgb(): void
    {
        $color1 = Hwb::createFromString('lavender');
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
        $color = Hwb::createFromString('lavender');

        $this->assertEquals(
            [
                'hue' => 240,
                'whiteness' => 90.19607843137256,
                'blackness' => 1.9607843137254943,
                'alpha' => 1,
            ],
            $color->toArray()
        );
    }

    public function testToDisplayP3(): void
    {
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
        $color2 = $color1->toHwb();

        $this->assertSame(
            $color1,
            $color2
        );
    }

    public function testToLab(): void
    {
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
        $color2 = $color1->toLch();

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'lch(91.74 10.11 285.93)',
            $color2->toString()
        );
    }

    public function testToOkLab(): void
    {
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
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
        $color = Hwb::createFromString('lavender');

        $this->assertSame(
            'hwb(240deg 90.2% 1.96%)',
            $color->toString()
        );

        $this->assertSame(
            'hwb(240deg 90.2% 1.96%)',
            (string) $color
        );
    }

    public function testToStringWithAlpha(): void
    {
        $color = Hwb::createFromString('lavender')->withAlpha(0.5);

        $this->assertSame(
            'hwb(240deg 90.2% 1.96% / 50%)',
            $color->toString()
        );
    }

    public function testToXyzD50(): void
    {
        $color1 = Hwb::createFromString('lavender');
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
        $color1 = Hwb::createFromString('lavender');
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

    public function testWithBlackness(): void
    {
        $color1 = Hwb::createFromString('lavender');
        $color2 = $color1->withBlackness(50);

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'hwb(240deg 90.2% 50%)',
            $color2->toString()
        );
    }

    public function testWithHue(): void
    {
        $color1 = Hwb::createFromString('lavender');
        $color2 = $color1->withHue(100);

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'hwb(100deg 90.2% 1.96%)',
            $color2->toString()
        );
    }

    public function testWithWhiteness(): void
    {
        $color1 = Hwb::createFromString('lavender');
        $color2 = $color1->withWhiteness(50);

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'hwb(240deg 50% 1.96%)',
            $color2->toString()
        );
    }
}
