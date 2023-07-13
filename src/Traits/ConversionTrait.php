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
     * @param int|float $c The cyan value. (0, 100)
     * @param int|float $m The magenta value. (0, 100)
     * @param int|float $y The yellow value. (0, 100)
     * @return array An array containing the CMYK values.
     */
    protected static function CMY2CMYK(int|float $c, int|float $m, int|float $y): array
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
            round($k * 100, 2)
        ];
    }

    /**
     * Convert CMY color values to RGB.
     * @param int|float $c The cyan value. (0, 100)
     * @param int|float $m The magenta value. (0, 100)
     * @param int|float $y The yellow value. (0, 100)
     * @return array An array containing the RGB values.
     */
    protected static function CMY2RGB(int|float $c, int|float $m, int|float $y): array
    {
        return [
            round((1 - $c / 100) * 255, 2),
            round((1 - $m / 100) * 255, 2),
            round((1 - $y / 100) * 255, 2)
        ];
    }

    /**
     * Convert CMYK color values to CMY.
     * @param int|float $c The cyan value. (0, 100)
     * @param int|float $m The magenta value. (0, 100)
     * @param int|float $y The yellow value. (0, 100)
     * @param int|float $k The key value. (0, 100)
     * @return array An array containing the CMY values.
     */
    protected static function CMYK2CMY(int|float $c, int|float $m, int|float $y, int|float $k): array
    {
        $k /= 100;

        return [
            round(($c / 100 * (1 - $k) + $k) * 100, 2),
            round(($m / 100 * (1 - $k) + $k) * 100, 2),
            round(($y / 100 * (1 - $k) + $k) * 100, 2)
        ];
    }

    /**
     * Convert HSL color values to RGB.
     * @param int|float $h The hue value. (0, 360)
     * @param int|float $s The saturation value. (0, 100)
     * @param int|float $l The lightness value. (0, 100)
     * @return array An array containing the RGB values.
     */
    protected static function HSL2RGB(int|float $h, int|float $s, int|float $l): array
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
            round($b * 255, 2)
        ];
    }

    /**
     * Convert HSV color values to RGB.
     * @param int|float $h The hue value. (0, 360)
     * @param int|float $s The saturation value. (0, 100)
     * @param int|float $v The brightness value (0, 100)
     * @return array An array containing the RGB values.
     */
    protected static function HSV2RGB(int|float $h, int|float $s, int|float $v): array
    {
        $v /= 100;

        if (!$s) {
            return [
                round($v * 255, 2),
                round($v * 255, 2),
                round($v * 255, 2)
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
            round($b * 255, 2)
        ];
    }

    /**
     * Convert RGB color values to CMY.
     * @param int|float $r The red value. (0, 255)
     * @param int|float $g The green value. (0, 255)
     * @param int|float $b The blue value. (0, 255)
     * @return array An array containing the CMY values.
     */
    protected static function RGB2CMY(int|float $r, int|float $g, int|float $b): array
    {
        return [
            round((1 - ($r / 255)) * 100, 2),
            round((1 - ($g / 255)) * 100, 2),
            round((1 - ($b / 255)) * 100, 2)
        ];
    }

    /**
     * Calculate the relative luminance of an RGB color.
     * @param int|float $r The red value. (0, 255)
     * @param int|float $g The green value. (0, 255)
     * @param int|float $b The blue value. (0, 255)
     * @return float The relative luminance value.
     */
    protected static function RGB2Luma(int|float $r, int|float $g, int|float $b): float
    {
        $r = static::RGBLumaValue($r);
        $g = static::RGBLumaValue($g);
        $b = static::RGBLumaValue($b);

        return (.2126 * $r) + (.7152 * $g) + (.0722 * $b);
    }

    /**
     * Convert RGB color values to HSL.
     * @param int|float $r The red value. (0, 255)
     * @param int|float $g The green value. (0, 255)
     * @param int|float $b The blue value. (0, 255)
     * @return array An array containing the HSL values.
     */
    protected static function RGB2HSL(int|float $r, int|float $g, int|float $b): array
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
                round($l * 100, 2)
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

        switch ($max) {
            case $r:
                $h = $deltaB - $deltaG;
                break;
            case $g:
                $h = 1 / 3 + $deltaR - $deltaB;
                break;
            case $b:
                $h = 2 / 3 + $deltaG - $deltaR;
                break;
        }

        $h = fmod($h + 1, 1);

        return [
            round($h * 360, 2),
            round($s * 100, 2),
            round($l * 100, 2)
        ];
    }

    /**
     * Convert RGB color values to HSV.
     * @param int|float $r The red value. (0, 255)
     * @param int|float $g The green value. (0, 255)
     * @param int|float $b The blue value. (0, 255)
     * @return array An array containing the HSV values.
     */
    protected static function RGB2HSV(int|float $r, int|float $g, int|float $b): array
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
                round($v * 100, 2)
            ];
        }

        $s = $diff / $max;
        $deltaR = ((($max - $r) / 6) + ($diff / 2)) / $diff;
        $deltaG = ((($max - $g) / 6) + ($diff / 2)) / $diff;
        $deltaB = ((($max - $b) / 6) + ($diff / 2)) / $diff;

        $h = 0;

        switch ($max) {
            case $r:
                $h = $deltaB - $deltaG;
                break;
            case $g:
                $h = 1 / 3 + $deltaR - $deltaB;
                break;
            case $b:
                $h = 2 / 3 + $deltaG - $deltaR;
                break;
        }

        $h = fmod($h + 1, 1);

        return [
            round($h * 360, 2),
            round($s * 100, 2),
            round($v * 100, 2)
        ];
    }

    /**
     * Calculate the R, G or B value of a hue.
     * @param int|float $v1 The first value.
     * @param int|float $v2 The second value.
     * @param int|float $vH The hue value.
     * @return int|float The R, G or B value.
     */
    protected static function RGBHue(int|float $v1, int|float $v2, int|float $vH): int|float
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
     * @param int|float $v The value.
     * @return int|float The R, G or B value.
     */
    protected static function RGBLumaValue(int|float $v): int|float
    {
        $v /= 255;

        if ($v <= .03928) {
            return $v / 12.92;
        }

        return pow((($v + .055) / 1.055), 2.4);
    }

}
