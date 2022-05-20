<?php
declare(strict_types=1);

namespace Tests\ColorImmutable;

use
    Fyre\Color\ColorImmutable,
    RuntimeException;

trait CreateTest
{

    public function testConstructorRed(): void
    {
        $this->assertSame(
            'red',
            (new ColorImmutable(255, 0, 0))->toString()
        );
    }

    public function testConstructorGreen(): void
    {
        $this->assertSame(
            'lime',
            (new ColorImmutable(0, 255, 0))->toString()
        );
    }

    public function testConstructorBlue(): void
    {
        $this->assertSame(
            'blue',
            (new ColorImmutable(0, 0, 255))->toString()
        );
    }

    public function testConstructorAlpha(): void
    {
        $this->assertSame(
            'rgb(255 255 255 / 50%)',
            (new ColorImmutable(255, 255, 255, .5))->toString()
        );
    }

    public function testConstructorBrightness(): void
    {
        $this->assertSame(
            'white',
            (new ColorImmutable(100))->toString()
        );
    }

    public function testConstructorBrightnessAlpha(): void
    {
        $this->assertSame(
            'rgb(255 255 255 / 50%)',
            (new ColorImmutable(100, .5))->toString()
        );
    }

    public function testFromStringColorName(): void
    {
        $this->assertSame(
            'red',
            ColorImmutable::fromString('red')->toString()
        );
    }

    public function testFromStringHex(): void
    {
        $this->assertSame(
            'red',
            ColorImmutable::fromString('#ff0000')->toString()
        );
    }

    public function testFromStringShortHex(): void
    {
        $this->assertSame(
            'red',
            ColorImmutable::fromString('#f00')->toString()
        );
    }

    public function testFromStringRGB(): void
    {
        $this->assertSame(
            'red',
            ColorImmutable::fromString('rgb(255 0 0)')->toString()
        );
    }

    public function testFromStringRGBAlt(): void
    {
        $this->assertSame(
            'red',
            ColorImmutable::fromString('rgb(255, 0, 0)')->toString()
        );
    }

    public function testFromStringRGBA(): void
    {
        $this->assertSame(
            'red',
            ColorImmutable::fromString('rgb(255 0 0 / 100%)')->toString()
        );
    }

    public function testFromStringRGBAAlt(): void
    {
        $this->assertSame(
            'red',
            ColorImmutable::fromString('rgba(255, 0, 0, 1)')->toString()
        );
    }

    public function testFromStringHSL(): void
    {
        $this->assertSame(
            '#9cc9b6',
            ColorImmutable::fromString('hsl(155deg 30% 70%)')->toString()
        );
    }

    public function testFromStringHSLAlt(): void
    {
        $this->assertSame(
            '#9cc9b6',
            ColorImmutable::fromString('hsl(155, 30%, 70%)')->toString()
        );
    }

    public function testFromStringHSLA(): void
    {
        $this->assertSame(
            'rgb(0 153 153 / 50%)',
            ColorImmutable::fromString('hsl(180deg 100% 30% / 50%)')->toString()
        );
    }

    public function testFromStringHSLAAlt(): void
    {
        $this->assertSame(
            'rgb(0 153 153 / 50%)',
            ColorImmutable::fromString('hsla(180, 100%, 30%, .5)')->toString()
        );
    }

    public function testFromStringInvalidHex(): void
    {
        $this->expectException(RuntimeException::class);

        ColorImmutable::fromString('#INVALID');
    }

    public function testFromStringInvalidRGB(): void
    {
        $this->expectException(RuntimeException::class);

        ColorImmutable::fromString('rgb(INVALID)');
    }

    public function testFromStringInvalidRGBA(): void
    {
        $this->expectException(RuntimeException::class);

        ColorImmutable::fromString('rgba(INVALID)');
    }

    public function testFromStringInvalidHSL(): void
    {
        $this->expectException(RuntimeException::class);

        ColorImmutable::fromString('hsl(INVALID)');
    }

    public function testFromStringInvalidHSLA(): void
    {
        $this->expectException(RuntimeException::class);

        ColorImmutable::fromString('hsl(INVALID)');
    }

    public function testFromStringInvalid(): void
    {
        $this->expectException(RuntimeException::class);

        ColorImmutable::fromString('INVALID');
    }

    public function testFromRGB(): void
    {
        $this->assertSame(
            '#9b1e46',
            ColorImmutable::fromRGB(155, 30, 70)->toString()
        );
    }

    public function testFromRGBWithAlpha(): void
    {
        $this->assertSame(
            'rgb(180 100 30 / 50%)',
            ColorImmutable::fromRGB(180, 100, 30, .5)->toString()
        );
    }

    public function testFromHSL(): void
    {
        $this->assertSame(
            '#9cc9b6',
            ColorImmutable::fromHSL(155, 30, 70)->toString()
        );
    }

    public function testFromHSLWithAlpha(): void
    {
        $this->assertSame(
            'rgb(0 153 153 / 50%)',
            ColorImmutable::fromHSL(180, 100, 30, .5)->toString()
        );
    }

    public function testFromHSV(): void
    {
        $this->assertSame(
            '#7db39c',
            ColorImmutable::fromHSV(155, 30, 70)->toString()
        );
    }

    public function testFromHSVWithAlpha(): void
    {
        $this->assertSame(
            'rgb(0 77 77 / 50%)',
            ColorImmutable::fromHSV(180, 100, 30, .5)->toString()
        );
    }

    public function testFromCMY(): void
    {
        $this->assertSame(
            '#3bd9a6',
            ColorImmutable::fromCMY(77, 15, 35)->toString()
        );
    }

    public function testFromCMYWithAlpha(): void
    {
        $this->assertSame(
            'rgb(26 128 217 / 50%)',
            ColorImmutable::fromCMY(90, 50, 15, .5)->toString()
        );
    }

    public function testFromCMYK(): void
    {
        $this->assertSame(
            '#20775b',
            ColorImmutable::fromCMYK(77, 15, 35, 45)->toString()
        );
    }

    public function testFromCMYKWithAlpha(): void
    {
        $this->assertSame(
            'rgb(11 57 98 / 50%)',
            ColorImmutable::fromCMYK(90, 50, 15, 55, .5)->toString()
        );
    }

}
