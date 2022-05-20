<?php
declare(strict_types=1);

namespace Fyre\Color;

/**
 * ColorImmutable
 */
class ColorImmutable extends Color implements ColorInterface
{

    /**
     * Set the RGBA values of the Color.
     * @param int|float $r The red value.
     * @param int|float $g The green value.
     * @param int|float $b The blue value.
     * @param int|float $a The alpha value.
     * @return Color The Color object.
     */
    public function setColor(int|float $r, int|float $g, int|float $b, int|float $a): static
    {
        return new static($r, $g, $b, $a);
    }

}
