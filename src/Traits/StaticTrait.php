<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

use Fyre\Color\Color;

use function array_reduce;
use function hypot;
use function max;
use function min;
use function round;
use function strlen;

/**
 * StaticTrait
 */
trait StaticTrait
{

    /**
     * Get the contrast value between two colors.
     * @param Color $color1 The first Color.
     * @param Color $color2 The second Color.
     * @return float The contrast value. (1, 21)
     */
    public static function contrast(Color $color1, Color $color2): float
    {
        $luma1 = $color1->luma();
        $luma2 = $color2->luma();

        return (max($luma1, $luma2) + .05) / (min($luma1, $luma2) + .05);
    }

    /**
     * Calculate the distance between two colors.
     * @param Color $color1 The first Color.
     * @param Color $color2 The second Color.
     * @return float The distance between the colors.
     */
    public static function dist(Color $color1, Color $color2): float
    {
        return array_reduce([
            $color1->r - $color2->r,
            $color1->g - $color2->g,
            $color1->b - $color2->b
        ], fn(float $x, float $y) => hypot($x, $y), 0);
    }

    /**
     * Find an optimally contrasting color for another color.
     * @param Color $color1 The first Color.
     * @param Color|null $color2 The second Color.
     * @param int|float $minContrast The minimum contrast.
     * @param int|float $stepSize The step size.
     * @return Color|null The new Color.
     */
    public static function findContrast(Color $color1, Color|null $color2 = null, int|float $minContrast = 4.5, int|float $stepSize = .01): Color|null
    {
        $color2 ??= $color1;

        if (static::contrast($color1, $color2) >= $minContrast) {
            return $color2;
        }

        $methods = ['tint', 'shade'];
        for ($i = $stepSize; $i <= 1; $i += $stepSize) {
            foreach ($methods AS $method) {
                $tempColor = $color2->$method($i);
                if (static::contrast($color1, $tempColor) >= $minContrast) {
                    return $tempColor;
                }
            }
        }

        return null;
    }

    /**
     * Create a new Color by mixing two colors together by a specified amount.
     * @param Color $color1 The first Color.
     * @param Color $color2 The second Color.
     * @param int|float $amount The amount to mix them by. (0, 1)
     * @return Color A new Color object.
     */
    public static function mix(Color $color1, Color $color2, int|float $amount): static
    {
        return new static(
            static::lerp($color1->r, $color2->r, $amount),
            static::lerp($color1->g, $color2->g, $amount),
            static::lerp($color1->b, $color2->b, $amount),
            static::lerp($color1->a, $color2->a, $amount)
        );
    }

    /**
     * Create a new Color by multiplying two colors together by a specified amount.
     * @param Color $color1 The first Color.
     * @param Color $color2 The second Color.
     * @param int|float $amount The amount to multiply them by. (0, 1)
     * @return Color A new Color object.
     */
    public static function multiply(Color $color1, Color $color2, int|float $amount): static
    {
        return new static(
            static::lerp(
                $color1->r,
                $color1->r * $color2->r / 255,
                $amount
            ),
            static::lerp(
                $color1->g,
                $color1->g * $color2->g / 255,
                $amount
            ),
            static::lerp(
                $color1->b,
                $color1->b * $color2->b / 255,
                $amount
            ),
            static::lerp(
                $color1->a,
                $color1->a * $color2->a,
                $amount
            )
        );
    }

    /**
     * Clamp a value between a min and max.
     * @param int|float $value The value to clamp.
     * @param int|float $min The minimum value of the clamped range.
     * @param int|float $max The maximum value of the clamped range.
     * @return float The clamped value.
     */
    protected static function clamp(int|float $val, int|float $min = 0, int|float $max = 100): float
    {
        return (float) max($min, min($max, $val));
    }

    /**
     * Linear interpolation from one value to another.
     * @param int|float $v1 The starting value.
     * @param int|float $v2 The ending value.
     * @param int|float $amount The amount to interpolate.
     * @return float The interpolated value.
     */
    protected static function lerp(int|float $a, int|float $b, int|float $amount): float
    {
        return round($a * (1 - $amount) + $b * $amount, 2);
    }

    /**
     * Shorten a hex string (if possible).
     * @param string $hex The hex string.
     * @return string The hex string.
     */
    protected static function toHex(string $hex) {
        $length = strlen($hex);

        if (
            $length === 9 &&
            $hex[1] === $hex[2] &&
            $hex[3] === $hex[4] &&
            $hex[5] === $hex[6] &&
            $hex[7] === $hex[8]
        ) {
            return '#'.$hex[1].$hex[3].$hex[5].$hex[7];
        }

        if (
            $length === 7 &&
            $hex[1] === $hex[2] &&
            $hex[3] === $hex[4] &&
            $hex[5] === $hex[6]
        ) {
            return '#'.$hex[1].$hex[3].$hex[5];
        }

        return $hex;
    }

}
