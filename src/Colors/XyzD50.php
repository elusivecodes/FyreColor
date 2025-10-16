<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\XyzTrait;

/**
 * XyzD50
 */
class XyzD50 extends Color
{
    use XyzTrait;

    protected const COLOR_SPACE = 'xyz-d50';

    /**
     * Convert the Color to Lab.
     *
     * @return Lab The Lab Color.
     */
    public function toLab(): Lab
    {
        [$L, $a, $b] = ColorConverter::xyzD50ToLab($this->x, $this->y, $this->z);

        return new Lab($L, $a, $b, $this->alpha);
    }

    /**
     * Convert the Color to ProPhotoRgb.
     *
     * @return ProPhotoRgb The ProPhotoRgb Color.
     */
    public function toProPhotoRgb(): ProPhotoRgb
    {
        [$r, $g, $b] = ColorConverter::xyzD50ToProphotoRgb($this->x, $this->y, $this->z);

        return new ProPhotoRgb($r, $g, $b, $this->alpha);
    }

    /**
     * Convert the Color to XyzD50.
     *
     * @return XyzD50 The XyzD50 Color.
     */
    public function toXyzD50(): XyzD50
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
        [$x, $y, $z] = ColorConverter::xyzD50ToXyzD65($this->x, $this->y, $this->z);

        return new XyzD65($x, $y, $z, $this->alpha);
    }
}
