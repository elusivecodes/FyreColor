<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Color\Color;

trait StaticTestTrait
{
    public function testContrast(): void
    {
        $this->assertSame(
            1.3022288504206543,
            Color::contrast(
                new Color(100, 0, 0),
                new Color(0, 0, 100)
            )
        );
    }

    public function testDist(): void
    {
        $this->assertSame(
            141.4213562373095,
            Color::dist(
                new Color(100, 0, 0),
                new Color(0, 0, 100)
            )
        );
    }

    public function testFindContrast(): void
    {
        $color = Color::findContrast(
            new Color(203, 213, 255)
        );

        $this->assertInstanceOf(
            Color::class,
            $color
        );

        $this->assertSame(
            '#575c6e',
            (string) $color
        );
    }

    public function testFindContrastMinContrast(): void
    {
        $color = Color::findContrast(
            new Color(203, 213, 255),
            new Color(122, 143, 255),
            3
        );

        $this->assertInstanceOf(
            Color::class,
            $color
        );

        $this->assertSame(
            '#6272cc',
            (string) $color
        );
    }

    public function testFindContrastStepSize(): void
    {
        $color = Color::findContrast(
            new Color(203, 213, 255),
            new Color(122, 143, 255),
            stepSize: .1
        );

        $this->assertInstanceOf(
            Color::class,
            $color
        );

        $this->assertSame(
            '#495699',
            (string) $color
        );
    }

    public function testFindContrastTwoColors(): void
    {
        $color = Color::findContrast(
            new Color(203, 213, 255),
            new Color(122, 143, 255)
        );

        $this->assertInstanceOf(
            Color::class,
            $color
        );

        $this->assertSame(
            '#4c599e',
            (string) $color
        );
    }

    public function testMix(): void
    {
        $color1 = new Color(255, 0, 0);
        $color2 = new Color(0, 0, 255);
        $color3 = Color::mix($color1, $color2, .5);

        $this->assertSame(
            'red',
            (string) $color1
        );

        $this->assertSame(
            'blue',
            (string) $color2
        );

        $this->assertInstanceOf(
            Color::class,
            $color3
        );

        $this->assertSame(
            'purple',
            (string) $color3
        );
    }

    public function testMultiply(): void
    {
        $color1 = new Color(255, 0, 0);
        $color2 = new Color(0, 0, 255);
        $color3 = Color::multiply($color1, $color2, .5);

        $this->assertSame(
            'red',
            (string) $color1
        );

        $this->assertSame(
            'blue',
            (string) $color2
        );

        $this->assertInstanceOf(
            Color::class,
            $color3
        );

        $this->assertSame(
            'maroon',
            (string) $color3
        );
    }
}
