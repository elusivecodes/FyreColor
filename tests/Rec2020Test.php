<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Color\Colors\Rec2020;
use PHPUnit\Framework\TestCase;

final class Rec2020Test extends TestCase
{
    public function testConstructorClamping(): void
    {
        $color = new Rec2020(2, -1, 3, 1.5);

        $this->assertSame(
            'color(rec2020 1 0 1)',
            $color->toString()
        );
    }

    public function testContrast(): void
    {
        $color1 = Rec2020::createFromString('lavender');
        $color2 = Rec2020::createFromString('black');

        $this->assertSame(17.06375148063551, $color1->contrast($color2));
        $this->assertSame(17.06375148063551, $color2->contrast($color1));
    }

    public function testGetBlue(): void
    {
        $color = Rec2020::createFromString('lavender');

        $this->assertEquals(0.9687847030822043, $color->getBlue());
    }

    public function testGetGreen(): void
    {
        $color = Rec2020::createFromString('lavender');

        $this->assertEquals(0.8901273645875314, $color->getGreen());
    }

    public function testGetRed(): void
    {
        $color = Rec2020::createFromString('lavender');

        $this->assertEquals(0.8931460651448258, $color->getRed());
    }

    public function testLabel(): void
    {
        $color = Rec2020::createFromString('lavender')->withGreen(0.5);

        $this->assertSame('violet', $color->label());
    }

    public function testLuma(): void
    {
        $color = Rec2020::createFromString('lavender');

        $this->assertSame(0.8031875740317754, $color->luma());
    }

    public function testSpace(): void
    {
        $color = new Rec2020();

        $this->assertSame('rec2020', $color->space());
    }

    public function testToA98Rgb(): void
    {
        $color1 = Rec2020::createFromString('lavender');
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
        $color = Rec2020::createFromString('lavender');

        $this->assertEquals(
            [
                'red' => 0.8931460651448258,
                'green' => 0.8901273645875314,
                'blue' => 0.9687847030822043,
                'alpha' => 1,
            ],
            $color->toArray()
        );
    }

    public function testToDisplayP3(): void
    {
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
        $color2 = $color1->toRec2020();

        $this->assertSame(
            $color1,
            $color2
        );
    }

    public function testToRgb(): void
    {
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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
        $color = Rec2020::createFromString('lavender');

        $this->assertSame(
            'color(rec2020 0.89 0.89 0.97)',
            $color->toString()
        );

        $this->assertSame(
            'color(rec2020 0.89 0.89 0.97)',
            (string) $color
        );
    }

    public function testToStringWithAlpha(): void
    {
        $color = Rec2020::createFromString('lavender')->withAlpha(0.5);

        $this->assertSame(
            'color(rec2020 0.89 0.89 0.97 / 0.5)',
            $color->toString()
        );
    }

    public function testToXyzD50(): void
    {
        $color1 = Rec2020::createFromString('lavender');
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
        $color1 = Rec2020::createFromString('lavender');
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

    public function testWithBlue(): void
    {
        $color1 = Rec2020::createFromString('lavender');
        $color2 = $color1->withBlue(0.5);

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(rec2020 0.89 0.89 0.5)',
            $color2->toString()
        );
    }

    public function testWithGreen(): void
    {
        $color1 = Rec2020::createFromString('lavender');
        $color2 = $color1->withGreen(0.5);

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(rec2020 0.89 0.5 0.97)',
            $color2->toString()
        );
    }

    public function testWithRed(): void
    {
        $color1 = Rec2020::createFromString('lavender');
        $color2 = $color1->withRed(0.5);

        $this->assertNotSame(
            $color1,
            $color2
        );

        $this->assertSame(
            'color(rec2020 0.5 0.89 0.97)',
            $color2->toString()
        );
    }
}
