<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

/**
 * Hex
 */
class Hex extends Rgb
{
    protected const COLOR_SPACE = 'hex';

    /**
     * Convert the Color to Hex.
     *
     * @return Hex The Hex Color.
     */
    public function toHex(): Hex
    {
        return $this;
    }

    /**
     * Convert the Color to Rgb.
     *
     * @return Rgb The Rgb Color.
     */
    public function toRgb(): Rgb
    {
        return new Rgb($this->red, $this->green, $this->blue, $this->alpha);
    }

    /**
     * Get the CSS color string.
     *
     * @param bool|null $alpha Whether to include the alpha value.
     * @param int $precision Unused precision parameter for compatibility.
     * @param bool $shortenHex Whether to shorten hexadecimal output.
     * @param bool $name Whether to use CSS color names.
     * @return string The CSS color string.
     */
    public function toString(bool|null $alpha = null, int $precision = 2, bool $shortenHex = true, bool $name = false): string
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

        return '#'.$this->getHex($alpha, $shortenHex);
    }
}
