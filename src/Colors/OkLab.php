<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\LabTrait;

use function round;

/**
 * OkLab
 */
class OkLab extends Color
{
    use LabTrait;

    protected const COLOR_SPACE = 'oklab';

    /**
     * New OkLab constructor.
     *
     * @param float $lightness The lightness value. (0, 1)
     * @param float $a The a value. (-0.4, 0.4)
     * @param float $b The b value. (-0.4, 0.4)
     * @param float $alpha The alpha value. (0, 1)
     */
    public function __construct(
        float $lightness = 0,
        float $a = 0,
        float $b = 0,
        float $alpha = 1,
    ) {
        $this->lightness = static::clamp($lightness);
        $this->a = static::clamp($a, -0.4, 0.4);
        $this->b = static::clamp($b, -0.4, 0.4);
        $this->alpha = static::clamp($alpha);
    }

    /**
     * Convert the Color to OkLab.
     *
     * @return OkLab The OkLab Color.
     */
    public function toOkLab(): OkLab
    {
        return $this;
    }

    /**
     * Convert the Color to OkLch.
     *
     * @return OkLch The OkLch Color.
     */
    public function toOkLch(): OkLch
    {
        [$L, $C, $H] = ColorConverter::okLabToOkLch($this->lightness, $this->a, $this->b);

        return new OkLch($L, $C, $H, $this->alpha);
    }

    /**
     * Get the CSS color string.
     *
     * @param bool|null $alpha Whether to include the alpha value.
     * @param int $precision The decimal precision.
     * @return string The CSS color string.
     */
    public function toString(bool|null $alpha = null, int $precision = 2): string
    {
        $alpha ??= $this->alpha < 1;

        $result = 'oklab('.
            round($this->lightness, $precision).' '.
            round($this->a, $precision).' '.
            round($this->b, $precision).'';

        if ($alpha) {
            $result .= ' / '.round($this->alpha, $precision);
        }

        $result .= ')';

        return $result;
    }

    /**
     * Convert the Color to XyzD65.
     *
     * @return XyzD65 The XyzD65 Color.
     */
    public function toXyzD65(): XyzD65
    {
        [$x, $y, $z] = ColorConverter::okLabToXyzD65($this->lightness, $this->a, $this->b);

        return new XyzD65($x, $y, $z, $this->alpha);
    }
}
