<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

use RuntimeException;

use function array_key_exists;
use function array_map;
use function array_slice;
use function hexdec;
use function preg_match;
use function strlen;
use function strtolower;
use function substr;
use function trim;

/**
 * CreateTrait
 */
trait CreateTrait
{

    /**
     * Create a new Color from CMY values.
     * @param int|float $c The cyan value. (0, 100)
     * @param int|float $m The magenta value. (0, 100)
     * @param int|float $y The yellow value. (0, 100)
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color object.
     */
    public static function fromCMY(int|float $c, int|float $m, int|float $y, int|float $a = 1): static
    {
        [$r, $g, $b] = static::CMY2RGB($c, $m, $y);

        return new static($r, $g, $b, $a);
    }

    /**
     * Create a new Color from CMYK values.
     * @param int|float $c The cyan value. (0, 100)
     * @param int|float $m The magenta value. (0, 100)
     * @param int|float $y The yellow value. (0, 100)
     * @param int|float $k The key value. (0, 100)
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color object.
     */
    public static function fromCMYK(int|float $c, int|float $m, int|float $y, int|float $k, int|float $a = 1): static
    {
        [$c, $m, $y] = static::CMYK2CMY($c, $m, $y, $k);

        return static::fromCMY($c, $m, $y, $a);
    }

    /**
     * Create a new Color from a hex color string.
     * @param string $string The hex color string.
     * @return Color A new Color object.
     * @throws RuntimeException if the hex string is not valid.
     */
    public static function fromHexString(string $string): static
    {
        $string = trim($string);

        if (strlen($string) > 6) {
            $pattern = '/^#([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})?$/i';
        } else {
            $pattern = '/^#([0-9a-f])([0-9a-f])([0-9a-f])([0-9a-f]?)$/i';
        }

        if (!preg_match($pattern, $string, $match)) {
            throw new RuntimeException('Invalid hex string: '.$string);
        }

        $rgb = array_map(
            function(string $value): int {
                if (strlen($value) < 2) {
                    $value = $value.$value;
                }

                return (int) hexdec($value);
            },
            array_slice($match, 1, 5)
        );

        $rgb[3] ??= 255;

        return new static($rgb[0], $rgb[1], $rgb[2], ($rgb[3] ?: 255) / 255);
    }

    /**
     * Create a new Color from HSL values.
     * @param int|float $h The hue value. (0, 360)
     * @param int|float $s The saturation value. (0, 100)
     * @param int|float $l The lightness value. (0, 100)
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color object.
     */
    public static function fromHSL(int|float $h, int|float $s, int|float $l, int|float $a = 1): static
    {
        [$r, $g, $b] = static::HSL2RGB($h, $s, $l);

        return new static($r, $g, $b, $a);
    }

    /**
     * Create a new Color from a HSL color string.
     * @param string $string The HSL color string.
     * @return Color A new Color object.
     * @throws RuntimeException if the HSL string is not valid.
     */
    public static function fromHSLString(string $string): static
    {
        $string = trim($string);

        if (preg_match('/^hsl\(((?:\d*\.)?\d+)deg\s+((?:\d*\.)?\d+)\%\s+((?:\d*\.)?\d+)\%\)$/i', $string, $match)) {
            return static::fromHSL((float) $match[1], (float) $match[2], (float) $match[3]);
        }

        if (preg_match('/^hsl\(((?:\d*\.)?\d+)deg\s+((?:\d*\.)?\d+)\%\s+((?:\d*\.)?\d+)\%\s*\/\s*((?:\d*\.)?\d+)(\%?)\)$/i', $string, $match)) {
            return static::fromHSL((float) $match[1], (float) $match[2], (float) $match[3], (float) $match[4] / 100);
        }

        if (preg_match('/^hsl\(((?:\d*\.)?\d+),\s*((?:\d*\.)?\d+)\%,\s*((?:\d*\.)?\d+)\%\)$/i', $string, $match)) {
            return static::fromHSL((float) $match[1], (float) $match[2], (float) $match[3]);
        }

        if (preg_match('/^hsla\(((?:\d*\.)?\d+),\s*((?:\d*\.)?\d+)\%,\s*((?:\d*\.)?\d+)\%,\s*((?:\d*\.)?\d+)(\%?)\)$/i', $string, $match)) {
            return static::fromHSL((float) $match[1], (float) $match[2], (float) $match[3], (float) $match[4]);
        }

        throw new RuntimeException('Invalid HSL string: '.$string);
    }

    /**
     * Create a new Color from HSV values.
     * @param int|float $h The hue value. (0, 360)
     * @param int|float $s The saturation value. (0, 100)
     * @param int|float $v The brightness value. (0, 100)
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color object.
     */
    public static function fromHSV(int|float $h, int|float $s, int|float $v, int|float $a = 1): static
    {
        [$r, $g, $b] = static::HSV2RGB($h, $s, $v);

        return new static($r, $g, $b, $a);
    }

    /**
     * Create a new Color from RGB values.
     * @param int|float $r The red value. (0, 255)
     * @param int|float $g The green value. (0, 255)
     * @param int|float $b The blue value. (0, 255)
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color object.
     */
    public static function fromRGB(int|float $r, int|float $g, int|float $b, int|float $a = 1): static
    {
        return new static($r, $g, $b, $a);
    }

    /**
     * Create a new Color from a RGB color string.
     * @param string $string The RGB color string.
     * @return Color A new Color object.
     * @throws RuntimeException if the RGB string is not valid.
     */
    public static function fromRGBString(string $string): static
    {
        $string = trim($string);

        if (preg_match('/^rgb\(((?:\d*\.)?\d+)\s+((?:\d*\.)?\d+)\s+((?:\d*\.)?\d+)\)$/i', $string, $match)) {
            return static::fromRGB((float) $match[1], (float) $match[2], (float) $match[3]);
        }

        if (preg_match('/^rgb\(((?:\d*\.)?\d+)\s+((?:\d*\.)?\d+)\s+((?:\d*\.)?\d+)\s*\/\s*((?:\d*\.)?\d+)(\%?)\)$/i', $string, $match)) {
            return static::fromRGB((float) $match[1], (float) $match[2], (float) $match[3], (float) $match[4] / 100);
        }

        if (preg_match('/^rgb\(((?:\d*\.)?\d+),\s*((?:\d*\.)?\d+),\s*((?:\d*\.)?\d+)\)$/i', $string, $match)) {
            return static::fromRGB((float) $match[1], (float) $match[2], (float) $match[3]);
        }

        if (preg_match('/^rgba\(((?:\d*\.)?\d+),\s*((?:\d*\.)?\d+),\s*((?:\d*\.)?\d+),\s*((?:\d*\.)?\d+)(\%?)\)$/i', $string, $match)) {
            return static::fromRGB((float) $match[1], (float) $match[2], (float) $match[3], (float) $match[4]);
        }

        throw new RuntimeException('Invalid RGB string: '.$string);
    }

    /**
     * Create a new Color from a HTML color string.
     * @param string $string The HTML color string.
     * @return Color A new Color object.
     * @throws RuntimeException if the color string is not valid.
     */
    public static function fromString(string $string): static
    {
        $string = strtolower($string);
        $string = trim($string);

        if ($string === 'transparent') {
            return new static(0, 0, 0, 0);
        }

        if (array_key_exists($string, static::COLORS)) {
            $string = static::COLORS[$string];
        }

        if (substr($string, 0, 1) === '#') {
            return static::fromHexString($string);
        }

        if (preg_match('/^rgb/i', $string)) {
            return static::fromRGBString($string);
        }

        if (preg_match('/^hsl/i', $string)) {
            return static::fromHSLString($string);
        }

        throw new RuntimeException('Invalid color string: '.$string);
    }

}
