<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\RgbTrait;

/**
 * SrgbLinear
 */
class SrgbLinear extends Color
{
    use RgbTrait;

    protected const COLOR_SPACE = 'srgb-linear';

    /**
     * Convert the Color to Srgb.
     *
     * @return Srgb The Srgb Color.
     */
    public function toSrgb(): Srgb
    {
        [$r, $g, $b] = ColorConverter::srgbLinearToSrgb($this->red, $this->green, $this->blue);

        return new Srgb($r, $g, $b, $this->alpha);
    }

    /**
     * Convert the Color to SrgbLinear.
     *
     * @return SrgbLinear The SrgbLinear Color.
     */
    public function toSrgbLinear(): SrgbLinear
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
        [$x, $y, $z] = ColorConverter::srgbLinearToXyzD65($this->red, $this->green, $this->blue);

        return new XyzD65($x, $y, $z, $this->alpha);
    }
}
