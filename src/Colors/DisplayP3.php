<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\RgbTrait;

/**
 * DisplayP3
 */
class DisplayP3 extends Color
{
    use RgbTrait;

    protected const COLOR_SPACE = 'display-p3';

    /**
     * Convert the Color to DisplayP3.
     *
     * @return DisplayP3 The DisplayP3 Color.
     */
    public function toDisplayP3(): DisplayP3
    {
        return $this;
    }

    /**
     * Convert the Color to DisplayP3Linear.
     *
     * @return DisplayP3Linear The DisplayP3Linear Color.
     */
    public function toDisplayP3Linear(): DisplayP3Linear
    {
        [$r, $g, $b] = ColorConverter::displayP3ToDisplayP3Linear($this->red, $this->green, $this->blue);

        return new DisplayP3Linear($r, $g, $b, $this->alpha);
    }

    /**
     * Convert the Color to XyzD65.
     *
     * @return XyzD65 The XyzD65 Color.
     */
    public function toXyzD65(): XyzD65
    {
        return $this->toDisplayP3Linear()->toXyzD65();
    }
}
