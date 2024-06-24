<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

use Fyre\Color\Color;

use function array_fill;
use function array_keys;
use function array_map;

/**
 * PaletteTrait
 */
trait PaletteTrait
{
    /**
     * Create a palette object with a specified number of shades, tints and tone variations.
     * @param int $shades The number of shades to generate.
     * @param int $tints The number of tints to generate.
     * @param int $tones The number of tones to generate.
     * @return array A palette object.
     */
    public function palette(int $shades = 10, int $tints = 10, int $tones = 10): array
    {
        return [
            'shades' => $this->shades($shades),
            'tints' => $this->tints($tints),
            'tones' => $this->tones($tones)
        ];
    }

    /**
     * Create an array with a specified number of shade variations.
     * @param int $shades The number of shades to generate.
     * @return array An array containing shade variations.
     */
    public function shades(int $shades = 10): array
    {
        return array_map(
            fn(int $value): Color => $this->shade($value / ($shades + 1)),
            array_keys(array_fill(0, $shades, 0))
        );
    }

    /**
     * Create an array with a specified number of tint variations.
     * @param int $tints The number of tints to generate.
     * @return array An array containing tint variations.
     */
    public function tints(int $tints = 10): array
    {
        return array_map(
            fn(int $value): Color => $this->tint($value / ($tints + 1)),
            array_keys(array_fill(0, $tints, 0))
        );
    }

    /**
     * Create an array with a specified number of tone variations.
     * @param int $tones The number of tones to generate.
     * @return array An array containing tone variations.
     */
    public function tones(int $tones = 10): array
    {
        return array_map(
            fn(int $value): Color => $this->tone($value / ($tones + 1)),
            array_keys(array_fill(0, $tones, 0))
        );
    }
}
