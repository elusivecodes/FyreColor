<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

use function floor;
use function fmod;
use function max;
use function min;
use function round;

/**
 * ConversionTrait
 */
trait ConversionTrait
{
    /**
     * Convert CMY color values to CMYK.
     *
     * @param float|int $c The cyan value. (0, 100)
     * @param float|int $m The magenta value. (0, 100)
     * @param float|int $y The yellow value. (0, 100)
     * @return array An array containing the CMYK values.
     */
    protected static function CMY2CMYK(float|int $c, float|int $m, float|int $y): array
    {
        $k = min($c, $m, $y);

        if ($k === 100) {
            return [0, 0, 0, $k];
        }

        $k /= 100;

        return [
            round(($c / 100 - $k) / (1 - $k) * 100, 2),
            round(($m / 100 - $k) / (1 - $k) * 100, 2),
            round(($y / 100 - $k) / (1 - $k) * 100, 2),
            round($k * 100, 2),
        ];
    }

    /**
     * Convert CMY color values to RGB.
     *
     * @param float|int $c The cyan value. (0, 100)
     * @param float|int $m The magenta value. (0, 100)
     * @param float|int $y The yellow value. (0, 100)
     * @return array An array containing the RGB values.
     */
    protected static function CMY2RGB(float|int $c, float|int $m, float|int $y): array
    {
        return [
            round((1 - $c / 100) * 255, 2),
            round((1 - $m / 100) * 255, 2),
            round((1 - $y / 100) * 255, 2),
        ];
    }

    /**
     * Convert CMYK color values to CMY.
     *
     * @param float|int $c The cyan value. (0, 100)
     * @param float|int $m The magenta value. (0, 100)
     * @param float|int $y The yellow value. (0, 100)
     * @param float|int $k The key value. (0, 100)
     * @return array An array containing the CMY values.
     */
    protected static function CMYK2CMY(float|int $c, float|int $m, float|int $y, float|int $k): array
    {
        $k /= 100;

        return [
            round(($c / 100 * (1 - $k) + $k) * 100, 2),
            round(($m / 100 * (1 - $k) + $k) * 100, 2),
            round(($y / 100 * (1 - $k) + $k) * 100, 2),
        ];
    }

    /**
     * Convert HSL color values to RGB.
     *
     * @param float|int $h The hue value. (0, 360)
     * @param float|int $s The saturation value. (0, 100)
     * @param float|int $l The lightness value. (0, 100)
     * @return array An array containing the RGB values.
     */
    protected static function HSL2RGB(float|int $h, float|int $s, float|int $l): array
    {
        if (!$l) {
            return [0, 0, 0];
        }

        $h /= 360;
        $s /= 100;
        $l /= 100;

        if ($l < .5) {
            $v2 = $l * (1 + $s);
        } else {
            $v2 = ($l + $s) - ($s * $l);
        }

        $v1 = 2 * $l - $v2;

        $r = static::RGBHue($v1, $v2, $h + (1 / 3));
        $g = static::RGBHue($v1, $v2, $h);
        $b = static::RGBHue($v1, $v2, $h - (1 / 3));

        return [
            round($r * 255, 2),
            round($g * 255, 2),
            round($b * 255, 2),
        ];
    }

    /**
     * Convert HSV color values to RGB.
     *
     * @param float|int $h The hue value. (0, 360)
     * @param float|int $s The saturation value. (0, 100)
     * @param float|int $v The brightness value (0, 100)
     * @return array An array containing the RGB values.
     */
    protected static function HSV2RGB(float|int $h, float|int $s, float|int $v): array
    {
        $v /= 100;

        if (!$s) {
            return [
                round($v * 255, 2),
                round($v * 255, 2),
                round($v * 255, 2),
            ];
        }

        $h = fmod($h / 60, 6);
        $s /= 100;

        $vi = floor($h);
        $v1 = $v * (1 - $s);
        $v2 = $v * (1 - $s * ($h - $vi));
        $v3 = $v * (1 - $s * (1 - ($h - $vi)));

        switch ($vi) {
            case 0:
                $r = $v;
                $g = $v3;
                $b = $v1;
                break;
            case 1:
                $r = $v2;
                $g = $v;
                $b = $v1;
                break;
            case 2:
                $r = $v1;
                $g = $v;
                $b = $v3;
                break;
            case 3:
                $r = $v1;
                $g = $v2;
                $b = $v;
                break;
            case 4:
                $r = $v3;
                $g = $v1;
                $b = $v;
                break;
            default:
                $r = $v;
                $g = $v1;
                $b = $v2;
                break;
        }

        return [
            round($r * 255, 2),
            round($g * 255, 2),
            round($b * 255, 2),
        ];
    }

    /**
     * Convert RGB color values to CMY.
     *
     * @param float|int $r The red value. (0, 255)
     * @param float|int $g The green value. (0, 255)
     * @param float|int $b The blue value. (0, 255)
     * @return array An array containing the CMY values.
     */
    protected static function RGB2CMY(float|int $r, float|int $g, float|int $b): array
    {
        return [
            round((1 - ($r / 255)) * 100, 2),
            round((1 - ($g / 255)) * 100, 2),
            round((1 - ($b / 255)) * 100, 2),
        ];
    }

    /**
     * Convert RGB color values to HSL.
     *
     * @param float|int $r The red value. (0, 255)
     * @param float|int $g The green value. (0, 255)
     * @param float|int $b The blue value. (0, 255)
     * @return array An array containing the HSL values.
     */
    protected static function RGB2HSL(float|int $r, float|int $g, float|int $b): array
    {
        $r /= 255;
        $g /= 255;
        $b /= 255;

        $min = min($r, $g, $b);
        $max = max($r, $g, $b);
        $diff = $max - $min;
        $l = ($max + $min) / 2;

        if (!$diff) {
            return [
                0,
                0,
                round($l * 100, 2),
            ];
        }

        if ($l < .5) {
            $s = $diff / ($max + $min);
        } else {
            $s = $diff / (2 - $max - $min);
        }

        $deltaR = ((($max - $r) / 6) + ($diff / 2)) / $diff;
        $deltaG = ((($max - $g) / 6) + ($diff / 2)) / $diff;
        $deltaB = ((($max - $b) / 6) + ($diff / 2)) / $diff;

        $h = 0;

        $h = match ($max) {
            $r => $deltaB - $deltaG,
            $g => 1 / 3 + $deltaR - $deltaB,
            $b => 2 / 3 + $deltaG - $deltaR
        };

        $h = fmod($h + 1, 1);

        return [
            round($h * 360, 2),
            round($s * 100, 2),
            round($l * 100, 2),
        ];
    }

    /**
     * Convert RGB color values to HSV.
     *
     * @param float|int $r The red value. (0, 255)
     * @param float|int $g The green value. (0, 255)
     * @param float|int $b The blue value. (0, 255)
     * @return array An array containing the HSV values.
     */
    protected static function RGB2HSV(float|int $r, float|int $g, float|int $b): array
    {
        $r /= 255;
        $g /= 255;
        $b /= 255;

        $min = min($r, $g, $b);
        $max = max($r, $g, $b);
        $diff = $max - $min;
        $v = $max;

        if (!$diff) {
            return [
                0,
                0,
                round($v * 100, 2),
            ];
        }

        $s = $diff / $max;
        $deltaR = ((($max - $r) / 6) + ($diff / 2)) / $diff;
        $deltaG = ((($max - $g) / 6) + ($diff / 2)) / $diff;
        $deltaB = ((($max - $b) / 6) + ($diff / 2)) / $diff;

        $h = 0;

        $h = match ($max) {
            $r => $deltaB - $deltaG,
            $g => 1 / 3 + $deltaR - $deltaB,
            $b => 2 / 3 + $deltaG - $deltaR
        };

        $h = fmod($h + 1, 1);

        return [
            round($h * 360, 2),
            round($s * 100, 2),
            round($v * 100, 2),
        ];
    }

    /**
     * Calculate the relative luminance of an RGB color.
     *
     * @param float|int $r The red value. (0, 255)
     * @param float|int $g The green value. (0, 255)
     * @param float|int $b The blue value. (0, 255)
     * @return float The relative luminance value.
     */
    protected static function RGB2Luma(float|int $r, float|int $g, float|int $b): float
    {
        $r = static::RGBLumaValue($r);
        $g = static::RGBLumaValue($g);
        $b = static::RGBLumaValue($b);

        return (.2126 * $r) + (.7152 * $g) + (.0722 * $b);
    }

    /**
     * Calculate the R, G or B value of a hue.
     *
     * @param float|int $v1 The first value.
     * @param float|int $v2 The second value.
     * @param float|int $vH The hue value.
     * @return float|int The R, G or B value.
     */
    protected static function RGBHue(float|int $v1, float|int $v2, float|int $vH): float|int
    {
        $vH = fmod($vH + 1, 1);

        if (6 * $vH < 1) {
            return $v1 + ($v2 - $v1) * 6 * $vH;
        }

        if (2 * $vH < 1) {
            return $v2;
        }

        if (3 * $vH < 2) {
            return $v1 + ($v2 - $v1) * ((2 / 3) - $vH) * 6;
        }

        return $v1;
    }

    /**
     * Calculate the relative R, G or B value for luma calculation.
     *
     * @param float|int $v The value.
     * @return float|int The R, G or B value.
     */
    protected static function RGBLumaValue(float|int $v): float|int
    {
        $v /= 255;

        if ($v <= .03928) {
            return $v / 12.92;
        }

        return pow((($v + .055) / 1.055), 2.4);
    }
}
