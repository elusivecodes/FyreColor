<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\RgbTrait;

/**
 * ProPhotoRgb
 */
class ProPhotoRgb extends Color
{
    use RgbTrait;

    protected const COLOR_SPACE = 'prophoto-rgb';

    /**
     * Convert the Color to ProPhotoRgb.
     *
     * @return ProPhotoRgb The ProPhotoRgb Color.
     */
    public function toProPhotoRgb(): ProPhotoRgb
    {
        return $this;
    }

    /**
     * Convert the Color to XyzD50.
     *
     * @return XyzD50 The XyzD50 Color.
     */
    public function toXyzD50(): XyzD50
    {
        [$x, $y, $z] = ColorConverter::prophotoRgbToXyzD50($this->red, $this->green, $this->blue);

        return new XyzD50($x, $y, $z, $this->alpha);
    }

    /**
     * Convert the Color to XyzD65.
     *
     * @return XyzD65 The XyzD65 Color.
     */
    public function toXyzD65(): XyzD65
    {
        return $this->toXyzD50()->toXyzD65();
    }
}
