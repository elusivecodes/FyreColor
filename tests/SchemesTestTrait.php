<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Color\Color;

use function array_map;

trait SchemesTestTrait
{
    public function testAnalogous(): void
    {
        $this->assertSame(
            [
                '#408060',
                '#608040',
            ],
            array_map(
                fn(Color $color): string => (string) $color,
                Color::fromHSV(120, 50, 50)->analogous()
            )
        );
    }

    public function testComplementary(): void
    {
        $this->assertSame(
            '#804080',
            (string) Color::fromHSV(120, 50, 50)->complementary()
        );
    }

    public function testSplit(): void
    {
        $this->assertSame(
            [
                '#604080',
                '#804060',
            ],
            array_map(
                fn(Color $color): string => (string) $color,
                Color::fromHSV(120, 50, 50)->split()
            )
        );
    }

    public function testTetradic(): void
    {
        $this->assertSame(
            [
                '#408080',
                '#804080',
                '#804040',
            ],
            array_map(
                fn(Color $color): string => (string) $color,
                Color::fromHSV(120, 50, 50)->tetradic()
            )
        );
    }

    public function testTriadic(): void
    {
        $this->assertSame(
            [
                '#404080',
                '#804040',
            ],
            array_map(
                fn(Color $color): string => (string) $color,
                Color::fromHSV(120, 50, 50)->triadic()
            )
        );
    }
}
