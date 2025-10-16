<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\LchTrait;

use function round;

/**
 * OkLch
 */
class OkLch extends Color
{
    use LchTrait;

    protected const COLOR_SPACE = 'oklch';

    /**
     * New OkLch constructor.
     *
     * @param float $lightness The lightness value. (0, 1)
     * @param float $chroma The chroma value. (0, 0.4)
     * @param float $hue The hue value. (0, 360)
     * @param float $alpha The alpha value. (0, 1)
     */
    public function __construct(
        float $lightness = 0,
        float $chroma = 0,
        float $hue = 0,
        float $alpha = 1,
    ) {
        $this->lightness = static::clamp($lightness);
        $this->chroma = static::clamp($chroma, max: 0.4);
        $this->hue = static::clampHue($hue);
        $this->alpha = static::clamp($alpha);
    }

    /**
     * Convert the Color to OkLab.
     *
     * @return OkLab The OkLab Color.
     */
    public function toOkLab(): OkLab
    {
        [$L, $a, $b] = ColorConverter::okLchToOkLab($this->lightness, $this->chroma, $this->hue);

        return new OkLab($L, $a, $b, $this->alpha);
    }

    /**
     * Convert the Color to OkLch.
     *
     * @return OkLch The OkLch Color.
     */
    public function toOkLch(): OkLch
    {
        return $this;
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

        $result = 'oklch('.
            round($this->lightness, $precision).' '.
            round($this->chroma, $precision).' '.
            round($this->hue, $precision).'';

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
        return $this->toOkLab()->toXyzD65();
    }
}
