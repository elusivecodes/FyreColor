<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;
use Fyre\Color\Traits\RgbTrait;

use function array_search;
use function max;
use function preg_match;
use function round;
use function sprintf;

/**
 * Rgb
 */
class Rgb extends Color
{
    use RgbTrait;

    protected const COLOR_SPACE = 'rgb';

    /**
     * New Rgb constructor.
     *
     * @param float $red The red value. (0, 255)
     * @param float $green The green value. (0, 255)
     * @param float $blue The blue value. (0, 255)
     */
    public function __construct(
        float $red = 0,
        float $green = 0,
        float $blue = 0,
        float $alpha = 1,
    ) {
        $this->red = static::clamp($red, max: 255);
        $this->green = static::clamp($green, max: 255);
        $this->blue = static::clamp($blue, max: 255);
        $this->alpha = static::clamp($alpha);
    }

    /**
     * Convert the Color to Hex.
     *
     * @return Hex The Hex Color.
     */
    public function toHex(): Hex
    {
        return new Hex($this->red, $this->green, $this->blue, $this->alpha);
    }

    /**
     * Convert the Color to Rgb.
     *
     * @return Rgb The Rgb Color.
     */
    public function toRgb(): Rgb
    {
        return $this;
    }

    /**
     * Convert the Color to Srgb.
     *
     * @return Srgb The Srgb Color.
     */
    public function toSrgb(): Srgb
    {
        [$r, $g, $b] = ColorConverter::rgbToSrgb($this->red, $this->green, $this->blue);

        return new Srgb($r, $g, $b, $this->alpha);
    }

    /**
     * Convert the Color to SrgbLinear.
     *
     * @return SrgbLinear The SrgbLinear Color.
     */
    public function toSrgbLinear(): SrgbLinear
    {
        return $this->toSrgb()->toSrgbLinear();
    }

    /**
     * Get the CSS color string.
     *
     * @param bool|null $alpha Whether to include the alpha value.
     * @param int $precision The decimal precision.
     * @param bool $name Whether to use CSS color names.
     * @return string The CSS color string.
     */
    public function toString(bool|null $alpha = null, int $precision = 2, bool $name = false): string
    {
        $alpha ??= $this->alpha < 1;

        if ($name && $this->alpha <= 0) {
            return 'transparent';
        }

        if ($name && $this->alpha >= 1) {
            $colorName = array_search('#'.$this->getHex(false, false), static::CSS_COLORS);

            if ($colorName !== false) {
                return $colorName;
            }
        }

        $result = 'rgb('.
            round($this->red, $precision).' '.
            round($this->green, $precision).' '.
            round($this->blue, $precision).'';

        if ($alpha) {
            $result .= ' / '.round($this->alpha * 100, max(0, $precision - 2)).'%';
        }

        $result .= ')';

        return $result;
    }

    /**
     * Get the hexadecimal representation of the Color.
     *
     * @param bool $alpha Whether to include the alpha component.
     * @param bool $shortenHex Whether to shorten hexadecimal output.
     * @return string The hexadecimal Color string without prefix.
     */
    protected function getHex(bool $alpha = false, bool $shortenHex = true): string
    {
        $result = $alpha ?
            sprintf(
                '%02x%02x%02x%02x',
                round($this->red),
                round($this->green),
                round($this->blue),
                round($this->alpha * 255)
            ) :
            sprintf(
                '%02x%02x%02x',
                round($this->red),
                round($this->green),
                round($this->blue)
            );

        if ($shortenHex && preg_match('/^([0-9a-f])\1([0-9a-f])\2([0-9a-f])\3([0-9a-f])?\4?$/i', $result, $match)) {
            $result = $match[1].$match[2].$match[3].($match[4] ?? '');
        }

        return $result;
    }
}
