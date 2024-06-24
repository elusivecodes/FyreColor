<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Color\Color;
use RuntimeException;

trait CreateTestTrait
{
    public function testConstructorAlpha(): void
    {
        $this->assertSame(
            'rgb(255 255 255 / 50%)',
            (new Color(255, 255, 255, .5))->toString()
        );
    }

    public function testConstructorBlue(): void
    {
        $this->assertSame(
            'blue',
            (new Color(0, 0, 255))->toString()
        );
    }

    public function testConstructorBrightness(): void
    {
        $this->assertSame(
            'white',
            (new Color(100))->toString()
        );
    }

    public function testConstructorBrightnessAlpha(): void
    {
        $this->assertSame(
            'rgb(255 255 255 / 50%)',
            (new Color(100, .5))->toString()
        );
    }

    public function testConstructorGreen(): void
    {
        $this->assertSame(
            'lime',
            (new Color(0, 255, 0))->toString()
        );
    }

    public function testConstructorRed(): void
    {
        $this->assertSame(
            'red',
            (new Color(255, 0, 0))->toString()
        );
    }

    public function testFromCMY(): void
    {
        $this->assertSame(
            '#3bd9a6',
            Color::fromCMY(77, 15, 35)->toString()
        );
    }

    public function testFromCMYK(): void
    {
        $this->assertSame(
            '#20775b',
            Color::fromCMYK(77, 15, 35, 45)->toString()
        );
    }

    public function testFromCMYKWithAlpha(): void
    {
        $this->assertSame(
            'rgb(11 57 98 / 50%)',
            Color::fromCMYK(90, 50, 15, 55, .5)->toString()
        );
    }

    public function testFromCMYWithAlpha(): void
    {
        $this->assertSame(
            'rgb(26 128 217 / 50%)',
            Color::fromCMY(90, 50, 15, .5)->toString()
        );
    }

    public function testFromHSL(): void
    {
        $this->assertSame(
            '#9cc9b6',
            Color::fromHSL(155, 30, 70)->toString()
        );
    }

    public function testFromHSLWithAlpha(): void
    {
        $this->assertSame(
            'rgb(0 153 153 / 50%)',
            Color::fromHSL(180, 100, 30, .5)->toString()
        );
    }

    public function testFromHSV(): void
    {
        $this->assertSame(
            '#7db39c',
            Color::fromHSV(155, 30, 70)->toString()
        );
    }

    public function testFromHSVWithAlpha(): void
    {
        $this->assertSame(
            'rgb(0 77 77 / 50%)',
            Color::fromHSV(180, 100, 30, .5)->toString()
        );
    }

    public function testFromRGB(): void
    {
        $this->assertSame(
            '#9b1e46',
            Color::fromRGB(155, 30, 70)->toString()
        );
    }

    public function testFromRGBWithAlpha(): void
    {
        $this->assertSame(
            'rgb(180 100 30 / 50%)',
            Color::fromRGB(180, 100, 30, .5)->toString()
        );
    }

    public function testFromStringColorName(): void
    {
        $this->assertSame(
            'red',
            Color::fromString('red')->toString()
        );
    }

    public function testFromStringHex(): void
    {
        $this->assertSame(
            'red',
            Color::fromString('#ff0000')->toString()
        );
    }

    public function testFromStringHSL(): void
    {
        $this->assertSame(
            '#9cc9b6',
            Color::fromString('hsl(155deg 30% 70%)')->toString()
        );
    }

    public function testFromStringHSLA(): void
    {
        $this->assertSame(
            'rgb(0 153 153 / 50%)',
            Color::fromString('hsl(180deg 100% 30% / 50%)')->toString()
        );
    }

    public function testFromStringHSLAAlt(): void
    {
        $this->assertSame(
            'rgb(0 153 153 / 50%)',
            Color::fromString('hsla(180, 100%, 30%, .5)')->toString()
        );
    }

    public function testFromStringHSLAlt(): void
    {
        $this->assertSame(
            '#9cc9b6',
            Color::fromString('hsl(155, 30%, 70%)')->toString()
        );
    }

    public function testFromStringInvalid(): void
    {
        $this->expectException(RuntimeException::class);

        Color::fromString('INVALID');
    }

    public function testFromStringInvalidHex(): void
    {
        $this->expectException(RuntimeException::class);

        Color::fromString('#INVALID');
    }

    public function testFromStringInvalidHSL(): void
    {
        $this->expectException(RuntimeException::class);

        Color::fromString('hsl(INVALID)');
    }

    public function testFromStringInvalidHSLA(): void
    {
        $this->expectException(RuntimeException::class);

        Color::fromString('hsl(INVALID)');
    }

    public function testFromStringInvalidRGB(): void
    {
        $this->expectException(RuntimeException::class);

        Color::fromString('rgb(INVALID)');
    }

    public function testFromStringInvalidRGBA(): void
    {
        $this->expectException(RuntimeException::class);

        Color::fromString('rgba(INVALID)');
    }

    public function testFromStringRGB(): void
    {
        $this->assertSame(
            'red',
            Color::fromString('rgb(255 0 0)')->toString()
        );
    }

    public function testFromStringRGBA(): void
    {
        $this->assertSame(
            'red',
            Color::fromString('rgb(255 0 0 / 100%)')->toString()
        );
    }

    public function testFromStringRGBAAlt(): void
    {
        $this->assertSame(
            'red',
            Color::fromString('rgba(255, 0, 0, 1)')->toString()
        );
    }

    public function testFromStringRGBAlt(): void
    {
        $this->assertSame(
            'red',
            Color::fromString('rgb(255, 0, 0)')->toString()
        );
    }

    public function testFromStringShortHex(): void
    {
        $this->assertSame(
            'red',
            Color::fromString('#f00')->toString()
        );
    }
}
