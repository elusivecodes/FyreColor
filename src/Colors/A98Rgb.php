<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\RgbTrait;

/**
 * A98Rgb
 */
class A98Rgb extends Color
{
    use RgbTrait;

    protected const COLOR_SPACE = 'a98-rgb';

    /**
     * Convert the Color to A98Rgb.
     *
     * @return A98Rgb The A98Rgb Color.
     */
    public function toA98Rgb(): A98Rgb
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
        [$x, $y, $z] = ColorConverter::a98RgbToXyzD65($this->red, $this->green, $this->blue);

        return new XyzD65($x, $y, $z, $this->alpha);
    }
}
