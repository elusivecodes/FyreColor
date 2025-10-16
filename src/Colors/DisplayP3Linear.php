<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\RgbTrait;

/**
 * DisplayP3Linear
 */
class DisplayP3Linear extends Color
{
    use RgbTrait;

    protected const COLOR_SPACE = 'display-p3-linear';

    /**
     * Convert the Color to DisplayP3.
     *
     * @return DisplayP3 The DisplayP3 Color.
     */
    public function toDisplayP3(): DisplayP3
    {
        [$r, $g, $b] = ColorConverter::displayP3LinearToDisplayP3($this->red, $this->green, $this->blue);

        return new DisplayP3($r, $g, $b, $this->alpha);
    }

    /**
     * Convert the Color to DisplayP3Linear.
     *
     * @return DisplayP3Linear The DisplayP3Linear Color.
     */
    public function toDisplayP3Linear(): DisplayP3Linear
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
        [$x, $y, $z] = ColorConverter::displayP3LinearToXyzD65($this->red, $this->green, $this->blue);

        return new XyzD65($x, $y, $z, $this->alpha);
    }
}
