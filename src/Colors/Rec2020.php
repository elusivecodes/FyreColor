<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\RgbTrait;

/**
 * Rec2020
 */
class Rec2020 extends Color
{
    use RgbTrait;

    protected const COLOR_SPACE = 'rec2020';

    /**
     * Convert the Color to Rec2020.
     *
     * @return Rec2020 The Rec2020 Color.
     */
    public function toRec2020(): Rec2020
    {
        return $this;
    }

    /**
     * Convert the Color to XyzD65.
     *
     * @return XyzD65 The XyzD65 Color.
     */
    public function toXyzD65(): XyzD65
    {
        [$x, $y, $z] = ColorConverter::rec2020ToXyzD65($this->red, $this->green, $this->blue);

        return new XyzD65($x, $y, $z, $this->alpha);
    }
}
