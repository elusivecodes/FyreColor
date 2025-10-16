<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\XyzTrait;

/**
 * XyzD65
 */
class XyzD65 extends Color
{
    use XyzTrait;

    protected const COLOR_SPACE = 'xyz-d65';

    /**
     * Convert the Color to A98Rgb.
     *
     * @return A98Rgb The A98Rgb Color.
     */
    public function toA98Rgb(): A98Rgb
    {
        [$r, $g, $b] = ColorConverter::xyzD65ToA98Rgb($this->x, $this->y, $this->z);

        return new A98Rgb($r, $g, $b, $this->alpha);
    }

    /**
     * Convert the Color to DisplayP3Linear.
     *
     * @return DisplayP3Linear The DisplayP3Linear Color.
     */
    public function toDisplayP3Linear(): DisplayP3Linear
    {
        [$r, $g, $b] = ColorConverter::xyzD65ToDisplayP3Linear($this->x, $this->y, $this->z);

        return new DisplayP3Linear($r, $g, $b, $this->alpha);
    }

    /**
     * Convert the Color to OkLab.
     *
     * @return OkLab The OkLab Color.
     */
    public function toOkLab(): OkLab
    {
        [$L, $a, $b] = ColorConverter::xyzD65ToOkLab($this->x, $this->y, $this->z);

        return new OkLab($L, $a, $b, $this->alpha);
    }

    /**
     * Convert the Color to Rec2020.
     *
     * @return Rec2020 The Rec2020 Color.
     */
    public function toRec2020(): Rec2020
    {
        [$r, $g, $b] = ColorConverter::xyzD65ToRec2020($this->x, $this->y, $this->z);

        return new Rec2020($r, $g, $b, $this->alpha);
    }

    /**
     * Convert the Color to SrgbLinear.
     *
     * @return SrgbLinear The SrgbLinear Color.
     */
    public function toSrgbLinear(): SrgbLinear
    {
        [$r, $g, $b] = ColorConverter::xyzD65ToSrgbLinear($this->x, $this->y, $this->z);

        return new SrgbLinear($r, $g, $b, $this->alpha);
    }

    /**
     * Convert the Color to XyzD50.
     *
     * @return XyzD50 The XyzD50 Color.
     */
    public function toXyzD50(): XyzD50
    {
        [$x, $y, $z] = ColorConverter::xyzD65ToXyzD50($this->x, $this->y, $this->z);

        return new XyzD50($x, $y, $z, $this->alpha);
    }

    /**
     * Convert the Color to XyzD65.
     *
     * @return XyzD65 The XyzD65 Color.
     */
    public function toXyzD65(): XyzD65
    {
        return $this;
    }
}
