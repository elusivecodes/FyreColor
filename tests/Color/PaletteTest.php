<?php
declare(strict_types=1);

namespace Tests\Color;

use
    Fyre\Color\Color;

use function
    array_map;

trait PaletteTest
{

    public function testShades(): void
    {
        $this->assertSame(
            [
                '#408040',
                '#3a743a',
                '#346834',
                '#2e5d2e',
                '#295129',
                '#234623',
                '#1d3a1d',
                '#172e17',
                '#112311',
                '#0c170c'
            ],
            array_map(
                fn(Color $color): string => (string) $color,
                Color::fromHSV(120, 50, 50)->shades()
            )
        );
    }

    public function testShadesArg(): void
    {
        $this->assertSame(
            [
                '#408040',
                '#356a35',
                '#2b552b',
                '#204020',
                '#152b15'
            ],
            array_map(
                fn(Color $color): string => (string) $color,
                Color::fromHSV(120, 50, 50)->shades(5)
            )
        );
    }

    public function testTints(): void
    {
        $this->assertSame(
            [
                '#408040',
                '#518b51',
                '#639763',
                '#74a274',
                '#85ae85',
                '#97b997',
                '#a8c5a8',
                '#b9d1b9',
                '#cbdccb',
                '#dce8dc'
            ],
            array_map(
                fn(Color $color): string => (string) $color,
                Color::fromHSV(120, 50, 50)->tints()
            )
        );
    }

    public function testTintsArg(): void
    {
        $this->assertSame(
            [
                '#408040',
                '#609560',
                '#80aa80',
                '#9fbf9f',
                '#bfd5bf'
            ],
            array_map(
                fn(Color $color): string => (string) $color,
                Color::fromHSV(120, 50, 50)->tints(5)
            )
        );
    }

    public function testTones(): void
    {
        $this->assertSame(
            [
                '#408040',
                '#468046',
                '#4b804b',
                '#518051',
                '#578057',
                '#5d805d',
                '#638063',
                '#688068',
                '#6e806e',
                '#748074'
            ],
            array_map(
                fn(Color $color): string => (string) $color,
                Color::fromHSV(120, 50, 50)->tones()
            )
        );
    }

    public function testTonesArg(): void
    {
        $this->assertSame(
            [
                '#408040',
                '#4a804a',
                '#558055',
                '#608060',
                '#6a806a'
            ],
            array_map(
                fn(Color $color): string => (string) $color,
                Color::fromHSV(120, 50, 50)->tones(5)
            )
        );
    }

    public function testPalette(): void
    {
        $this->assertSame(
            [
                'shades' => [
                    '#408040',
                    '#3a743a',
                    '#346834',
                    '#2e5d2e',
                    '#295129',
                    '#234623',
                    '#1d3a1d',
                    '#172e17',
                    '#112311',
                    '#0c170c'
                ],
                'tints' => [
                    '#408040',
                    '#518b51',
                    '#639763',
                    '#74a274',
                    '#85ae85',
                    '#97b997',
                    '#a8c5a8',
                    '#b9d1b9',
                    '#cbdccb',
                    '#dce8dc'
                ],
                'tones' => [
                    '#408040',
                    '#468046',
                    '#4b804b',
                    '#518051',
                    '#578057',
                    '#5d805d',
                    '#638063',
                    '#688068',
                    '#6e806e',
                    '#748074'
                ]
            ],
            array_map(
                fn(array $palette): array => array_map(
                    fn(Color $color): string => (string) $color,
                    $palette
                ),
                Color::fromHSV(120, 50, 50)->palette()
            )
        );
    }

    public function testPaletteShades(): void
    {
        $this->assertSame(
            [
                'shades' => [
                    '#408040',
                    '#356a35',
                    '#2b552b',
                    '#204020',
                    '#152b15'
                ],
                'tints' => [],
                'tones' => []
            ],
            array_map(
                fn(array $palette): array => array_map(
                    fn(Color $color): string => (string) $color,
                    $palette
                ),
                Color::fromHSV(120, 50, 50)->palette(5, 0, 0)
            )
        );
    }

    public function testPaletteTints(): void
    {
        $this->assertSame(
            [
                'shades' => [],
                'tints' => [
                    '#408040',
                    '#609560',
                    '#80aa80',
                    '#9fbf9f',
                    '#bfd5bf'
                ],
                'tones' => []
            ],
            array_map(
                fn(array $palette): array => array_map(
                    fn(Color $color): string => (string) $color,
                    $palette
                ),
                Color::fromHSV(120, 50, 50)->palette(0, 5, 0)
            )
        );
    }

    public function testPaletteTones(): void
    {
        $this->assertSame(
            [
                'shades' => [],
                'tints' => [],
                'tones' => [
                    '#408040',
                    '#4a804a',
                    '#558055',
                    '#608060',
                    '#6a806a'
                ]
            ],
            array_map(
                fn(array $palette): array => array_map(
                    fn(Color $color): string => (string) $color,
                    $palette
                ),
                Color::fromHSV(120, 50, 50)->palette(0, 0, 5)
            )
        );
    }

}
