<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\LchTrait;

use function round;

/**
 * Lch
 */
class Lch extends Color
{
    use LchTrait;

    protected const COLOR_SPACE = 'lch';

    /**
     * New Lch constructor.
     *
     * @param float $lightness The lightness value. (0, 100)
     * @param float $chroma The chroma value. (0, 230)
     * @param float $hue The hue value. (0, 360)
     * @param float $alpha The alpha value. (0, 1)
     */
    public function __construct(
        float $lightness = 0,
        float $chroma = 0,
        float $hue = 0,
        float $alpha = 1,
    ) {
        $this->lightness = static::clamp($lightness, max: 100);
        $this->chroma = static::clamp($chroma, max: 230);
        $this->hue = static::clampHue($hue);
        $this->alpha = static::clamp($alpha);
    }

    /**
     * Convert the Color to Lab.
     *
     * @return Lab The Lab Color.
     */
    public function toLab(): Lab
    {
        [$L, $a, $b] = ColorConverter::lchToLab($this->lightness, $this->chroma, $this->hue);

        return new Lab($L, $a, $b, $this->alpha);
    }

    /**
     * Convert the Color to Lch.
     *
     * @return Lch The Lch Color.
     */
    public function toLch(): Lch
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

        $result = 'lch('.
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
        return $this->toLab()->toXyzD65();
    }
}
