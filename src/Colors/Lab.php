<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\LabTrait;

use function round;

/**
 * Lab
 */
class Lab extends Color
{
    use LabTrait;

    protected const COLOR_SPACE = 'lab';

    /**
     * New Lab color constructor.
     *
     * @param float $lightness The lightness value. (0, 100)
     * @param float $a The a value. (-128, 127)
     * @param float $b The b value. (-128, 127)
     * @param float $alpha The alpha value. (0, 1)
     */
    public function __construct(
        float $lightness = 0,
        float $a = 0,
        float $b = 0,
        float $alpha = 1,
    ) {
        $this->lightness = static::clamp($lightness, max: 100);
        $this->a = static::clamp($a, -128, 127);
        $this->b = static::clamp($b, -128, 127);
        $this->alpha = static::clamp($alpha);
    }

    /**
     * Convert the Color to Lab.
     *
     * @return Lab The Lab Color.
     */
    public function toLab(): Lab
    {
        return $this;
    }

    /**
     * Convert the Color to Lch.
     *
     * @return Lch The Lch Color.
     */
    public function toLch(): Lch
    {
        [$L, $C, $H] = ColorConverter::labToLch($this->lightness, $this->a, $this->b);

        return new Lch($L, $C, $H, $this->alpha);
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

        $result = 'lab('.
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
     * Convert the Color to XyzD50.
     *
     * @return XyzD50 The XyzD50 Color.
     */
    public function toXyzD50(): XyzD50
    {
        [$x, $y, $z] = ColorConverter::labToXyzD50($this->lightness, $this->a, $this->b);

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
