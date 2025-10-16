<?php
declare(strict_types=1);

namespace Fyre\Color;

use function abs;
use function atan2;
use function cos;
use function deg2rad;
use function fmod;
use function hypot;
use function max;
use function min;
use function pow;
use function rad2deg;
use function round;
use function sin;

/**
 * ColorConverter
 */
abstract class ColorConverter
{
    /**
     * Convert A98 RGB color values to XYZ D65.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The XYZ D65 values.
     */
    public static function a98RgbToXyzD65(float $r, float $g, float $b): array
    {
        $r = pow($r, 2.19921875);
        $g = pow($g, 2.19921875);
        $b = pow($b, 2.19921875);

        return [
            (0.576669042903413 * $r) + (0.185558237906552 * $g) + (0.188228607860995 * $b),
            (0.297344975250536 * $r) + (0.627363566255474 * $g) + (0.075291458837511 * $b),
            (0.027031361071147 * $r) + (0.070690207263094 * $g) + (0.991337536548046 * $b),
        ];
    }

    /**
     * Convert Display P3 Linear color values to Display P3.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The Display P3 values.
     */
    public static function displayP3LinearToDisplayP3(float $r, float $g, float $b): array
    {
        $gamma = 1 / 2.4;
        $encode = static fn(float $v): float => $v <= 0.0031308 ?
            ($v * 12.92) :
            ((1.055 * pow($v, $gamma)) - 0.055);

        $r = max(0, min(1, $r));
        $g = max(0, min(1, $g));
        $b = max(0, min(1, $b));

        $r = $encode($r);
        $g = $encode($g);
        $b = $encode($b);

        return [$r, $g, $b];
    }

    /**
     * Convert Display P3 Linear color values to XYZ D65.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The XYZ D65 values.
     */
    public static function displayP3LinearToXyzD65(float $r, float $g, float $b): array
    {
        return [
            (0.4865709486482162 * $r) + (0.2656676931690931 * $g) + (0.1982172852343625 * $b),
            (0.2289745640697488 * $r) + (0.6917385218365064 * $g) + (0.0792869140937450 * $b),
            (0.0451133818589026 * $g) + (1.043944368900976 * $b),
        ];
    }

    /**
     * Convert Display P3 color values to Display P3 Linear.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The Display P3 Linear values.
     */
    public static function displayP3ToDisplayP3Linear(float $r, float $g, float $b): array
    {
        $decode = static fn(float $v): float => $v <= 0.04045 ?
            ($v / 12.92) :
            pow(($v + 0.055) / 1.055, 2.4);

        $r = $decode($r);
        $g = $decode($g);
        $b = $decode($b);

        return [$r, $g, $b];
    }

    /**
     * Convert HSL color values to SRGB.
     *
     * @param float $h The hue value. (0, 360)
     * @param float $s The saturation value. (0, 1)
     * @param float $l The lightness value. (0, 1)
     * @return array The SRGB values.
     */
    public static function hslToSrgb(float $h, float $s, float $l): array
    {
        $h = fmod($h, 360) / 360;

        $r = $g = $b = $l;

        if ($s != 0) {
            $q = $l < 0.5 ?
                ($l * (1 + $s)) :
                ($l + $s - ($l * $s));
            $p = (2 * $l) - $q;
            $r = static::rgbHue($p, $q, $h + (1 / 3));
            $g = static::rgbHue($p, $q, $h);
            $b = static::rgbHue($p, $q, $h - (1 / 3));
        }

        return [
            max(0, min(1, $r)),
            max(0, min(1, $g)),
            max(0, min(1, $b)),
        ];
    }

    /**
     * Convert HSV color values to SRGB.
     *
     * @param float $h The hue value. (0, 360)
     * @param float $s The saturation value. (0, 1)
     * @param float $v The brightness value. (0, 1)
     * @return array The SRGB values.
     */
    public static function hsvToSrgb(float $h, float $s, float $v): array
    {
        $h = fmod($h + 360, 360);
        $c = $v * $s;
        $x = $c * (1 - abs(fmod($h / 60, 2) - 1));
        $m = $v - $c;

        if ($h < 60) {
            [$r1, $g1, $b1] = [$c, $x, 0];
        } else if ($h < 120) {
            [$r1, $g1, $b1] = [$x, $c, 0];
        } else if ($h < 180) {
            [$r1, $g1, $b1] = [0, $c, $x];
        } else if ($h < 240) {
            [$r1, $g1, $b1] = [0, $x, $c];
        } else if ($h < 300) {
            [$r1, $g1, $b1] = [$x, 0, $c];
        } else {
            [$r1, $g1, $b1] = [$c, 0, $x];
        }

        return [
            max(0, min(1, $r1 + $m)),
            max(0, min(1, $g1 + $m)),
            max(0, min(1, $b1 + $m)),
        ];
    }

    /**
     * Convert HWB color values to SRGB.
     *
     * @param float $h The hue value. (0, 360)
     * @param float $w The whiteness value. (0, 1)
     * @param float $b The blackness value. (0, 1)
     * @return array The SRGB values.
     */
    public static function hwbToSrgb(float $h, float $w, float $bl): array
    {
        $total = $w + $bl;
        if ($total > 1) {
            $w /= $total;
            $bl /= $total;
        }

        [$r, $g, $b] = static::hsvToSrgb($h, 1, 1);
        $factor = 1 - $w - $bl;

        return [
            max(0, min(1, ($r * $factor) + $w)),
            max(0, min(1, ($g * $factor) + $w)),
            max(0, min(1, ($b * $factor) + $w)),
        ];
    }

    /**
     * Convert LAB color values to LCH.
     *
     * @param float $L The lightness value. (0, 100)
     * @param float $a The a value. (-125, 125)
     * @param float $b The b value. (-125, 125)
     * @return array The LCH values.
     */
    public static function labToLch(float $L, float $a, float $b): array
    {
        $C = hypot($a, $b);
        $H = fmod(rad2deg(atan2($b, $a)), 360);

        if ($H < 0) {
            $H += 360;
        }

        return [$L, $C, $H];
    }

    /**
     * Convert LAB color values to XYZ D50.
     *
     * @param float $L The lightness value. (0, 100)
     * @param float $a The a value. (-125, 125)
     * @param float $b The b value. (-125, 125)
     * @return array The XYZ D50 values.
     */
    public static function labToXyzD50(float $L, float $a, float $b): array
    {
        $fy = ($L + 16) / 116;
        $fx = $fy + ($a / 500);
        $fz = $fy - ($b / 200);

        $fx3 = pow($fx, 3);
        $fz3 = pow($fz, 3);

        $xr = $fx3 > 0.008856 ?
            $fx3 :
            (($fx - 16 / 116) / 7.787);
        $yr = $L > (903.3 * 0.008856) ?
            pow($fy, 3) :
            ($L / 903.3);
        $zr = $fz3 > 0.008856 ?
            $fz3 :
            (($fz - 16 / 116) / 7.787);

        return [
            $xr * 0.96422,
            $yr,
            $zr * 0.82521,
        ];
    }

    /**
     * Convert LCH color values to LAB.
     *
     * @param float $L The lightness value. (0, 100)
     * @param float $C The chroma value. (0, 150)
     * @param float $H The hue value. (0, 360)
     * @return array The LAB values.
     */
    public static function lchToLab(float $L, float $C, float $H): array
    {
        $H = deg2rad($H);

        return [
            $L,
            $C * cos($H),
            $C * sin($H),
        ];
    }

    /**
     * Convert OK LAB color values to OK LCH.
     *
     * @param float $L The lightness value. (0, 1)
     * @param float $a The a value. (-0.4, 0.4)
     * @param float $b The b value. (-0.4, 0.4)
     * @return array The OK LCH values.
     */
    public static function okLabToOkLch(float $L, float $a, float $b): array
    {
        $C = hypot($a, $b);
        $H = fmod(rad2deg(atan2($b, $a)), 360);

        if ($H < 0) {
            $H += 360;
        }

        return [$L, $C, $H];
    }

    /**
     * Convert OK LAB color values to XYZ D65.
     *
     * @param float $L The lightness value. (0, 1)
     * @param float $a The a value. (-0.4, 0.4)
     * @param float $b The b value. (-0.4, 0.4)
     * @return array The XYZ D65 values.
     */
    public static function okLabToXyzD65(float $L, float $a, float $b): array
    {
        $l = pow($L + (0.3963377774 * $a) + (0.2158037573 * $b), 3);
        $m = pow($L - (0.1055613458 * $a) - (0.0638541728 * $b), 3);
        $s = pow($L - (0.0894841775 * $a) - (1.2914855480 * $b), 3);

        return [
            (1.2270138511 * $l) - (0.5577999807 * $m) + (0.2812561490 * $s),
            (-0.0405801784 * $l) + (1.1122568696 * $m) - (0.0716766787 * $s),
            (-0.0763812845 * $l) - (0.4214819784 * $m) + (1.5861632204 * $s),
        ];
    }

    /**
     * Convert OK LCH color values to OK LAB.
     *
     * @param float $L The lightness value. (0, 1)
     * @param float $C The chroma value. (0, 0.4)
     * @param float $H The hue value. (0, 360)
     * @return array The OK LAB values.
     */
    public static function okLchToOkLab(float $L, float $C, float $H): array
    {
        $H = deg2rad($H);

        return [
            $L,
            $C * cos($H),
            $C * sin($H),
        ];
    }

    /**
     * Convert ProPhoto RGB color values to XYZ D50.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The XYZ D50 values.
     */
    public static function prophotoRgbToXyzD50(float $r, float $g, float $b): array
    {
        $decode = static fn(float $v): float => $v <= 0.03125 ?
            ($v / 16) :
            pow($v, 1.8);

        $r = $decode($r);
        $g = $decode($g);
        $b = $decode($b);

        return [
            (0.7976749 * $r) + (0.1351917 * $g) + (0.0313534 * $b),
            (0.2880402 * $r) + (0.7118741 * $g) + (0.0000857 * $b),
            0.8252100 * $b,
        ];
    }

    /**
     * Convert Rec. 2020 color values to XYZ D65.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The XYZ D65 values.
     */
    public static function rec2020ToXyzD65(float $r, float $g, float $b): array
    {
        $decode = static fn(float $v): float => $v <= 0.08145 ?
            ($v / 4.5) :
            pow(($v + 0.099) / 1.099, 2.2);

        $r = $decode($r);
        $g = $decode($g);
        $b = $decode($b);

        return [
            (0.6369580483012914 * $r) + (0.14461690358620832 * $g) + (0.1688809751641721 * $b),
            (0.2627002120112671 * $r) + (0.6779980715188708 * $g) + (0.05930171646986196 * $b),
            (0.028072693049087428 * $g) + (1.060985057710791 * $b),
        ];
    }

    /**
     * Convert RGB color values to SRGB.
     *
     * @param float $r The red value. (0, 255)
     * @param float $g The green value. (0, 255)
     * @param float $b The blue value. (0, 255)
     * @return array The SRGB values.
     */
    public static function rgbToSrgb(float $r, float $g, float $b): array
    {
        return [
            max(0, min(1, $r / 255)),
            max(0, min(1, $g / 255)),
            max(0, min(1, $b / 255)),
        ];
    }

    /**
     * Convert SRGB Linear color values to SRGB.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The SRGB values.
     */
    public static function srgbLineartoSrgb(float $r, float $g, float $b): array
    {
        $gamma = 1 / 2.4;
        $encode = static fn(float $v): float => $v <= 0.0031308 ?
            ($v * 12.92) :
            ((1.055 * pow($v, $gamma)) - 0.055);

        $r = $encode($r);
        $g = $encode($g);
        $b = $encode($b);

        return [$r, $g, $b];
    }

    /**
     * Convert SRGB Linear color values to XYZ D65.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The XYZ D65 values.
     */
    public static function srgbLinearToXyzD65(float $r, float $g, float $b): array
    {
        return [
            (0.4124564 * $r) + (0.3575761 * $g) + (0.1804375 * $b),
            (0.2126729 * $r) + (0.7151522 * $g) + (0.0721750 * $b),
            (0.0193339 * $r) + (0.1191920 * $g) + (0.9503041 * $b),
        ];
    }

    /**
     * Convert SRGB color values to HSL.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The HSL values.
     */
    public static function srgbToHsl(float $r, float $g, float $b): array
    {
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l = ($max + $min) / 2;
        $d = $max - $min;

        if ($d < 1e-12) {
            $h = $s = 0;
        } else {
            $s = $l > 0.5 ?
                ($d / (2 - $max - $min)) :
                ($d / ($max + $min));

            switch ($max) {
                case $r:
                    $h = (($g - $b) / $d) + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = (($b - $r) / $d) + 2;
                    break;
                case $b:
                    $h = (($r - $g) / $d) + 4;
                    break;
            }

            $h = fmod($h * 60, 360);

            if ($h < 0) {
                $h += 360;
            }
        }

        return [$h, $s, $l];
    }

    /**
     * Convert SRGB color values to HSV.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The HSV values.
     */
    public static function srgbToHsv(float $r, float $g, float $b): array
    {
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $v = $max;
        $d = $max - $min;
        $s = $max < 1e-12 ?
            0 :
            ($d / $max);

        if ($d < 1e-12) {
            $h = 0;
        } else if ($max === $r) {
            $h = 60 * fmod((($g - $b) / $d), 6);
        } else if ($max === $g) {
            $h = 60 * ((($b - $r) / $d) + 2);
        } else {
            $h = 60 * ((($r - $g) / $d) + 4);
        }

        $h = fmod($h, 360);

        if ($h < 0) {
            $h += 360;
        }

        return [$h, $s, $v];
    }

    /**
     * Convert SRGB color values to HWB.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The HWB values.
     */
    public static function srgbToHwb(float $r, float $g, float $b): array
    {
        [$h, $_, $_] = static::srgbToHsv($r, $g, $b);

        return [
            $h,
            min($r, $g, $b),
            1 - max($r, $g, $b),
        ];
    }

    /**
     * Convert SRGB color values to Luma.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return float The Luma value.
     */
    public static function srgbToLuma(float $r, float $g, float $b): float
    {
        $decode = static fn(float $v): float => $v <= 0.03928 ?
            ($v / 12.92) :
            pow(($v + 0.055) / 1.055, 2.4);

        $r = $decode($r);
        $g = $decode($g);
        $b = $decode($b);

        return (.2126 * $r) + (.7152 * $g) + (.0722 * $b);
    }

    /**
     * Convert SRGB color values to RGB.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The RGB values.
     */
    public static function srgbToRgb(float $r, float $g, float $b): array
    {
        $r = max(0, min(1, $r));
        $g = max(0, min(1, $g));
        $b = max(0, min(1, $b));

        return [
            round($r * 255, 2),
            round($g * 255, 2),
            round($b * 255, 2),
        ];
    }

    /**
     * Convert SRGB color values to SRGB Linear.
     *
     * @param float $r The red value. (0, 1)
     * @param float $g The green value. (0, 1)
     * @param float $b The blue value. (0, 1)
     * @return array The SRGB Linear values.
     */
    public static function srgbToSrgbLinear(float $r, float $g, float $b): array
    {
        $decode = static fn(float $v): float => $v <= 0.04045 ?
            ($v / 12.92) :
            pow(($v + 0.055) / 1.055, 2.4);

        $r = $decode($r);
        $g = $decode($g);
        $b = $decode($b);

        return [$r, $g, $b];
    }

    /**
     * Convert XYZ D50 color values to LAB.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @return array The LAB values.
     */
    public static function xyzD50ToLab(float $x, float $y, float $z): array
    {
        $encode = static fn(float $v): float => $v > 0.008856 ?
            pow($v, 1 / 3) :
            ((903.3 * $v + 16) / 116);

        $xr = $x / 0.96422;
        $yr = $y;
        $zr = $z / 0.82521;

        $fx = $encode($xr);
        $fy = $encode($yr);
        $fz = $encode($zr);

        return [
            (116 * $fy) - 16,
            500 * ($fx - $fy),
            200 * ($fy - $fz),
        ];
    }

    /**
     * Convert XYZ D50 color values to ProPhoto RGB.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @return array The ProPhoto RGB values.
     */
    public static function xyzD50ToProphotoRgb(float $x, float $y, float $z): array
    {
        $encode = static fn(float $v): float => $v <= 0.001953125 ?
            ($v * 16) :
            pow($v, 1 / 1.8);

        $r = (1.3459433 * $x) - (0.2556075 * $y) - (0.0511118 * $z);
        $g = (-0.5445989 * $x) + (1.5081673 * $y) + (0.0205351 * $z);
        $b = 1.2118128 * $z;

        $r = max(0, min(1, $r));
        $g = max(0, min(1, $g));
        $b = max(0, min(1, $b));

        $r = $encode($r);
        $g = $encode($g);
        $b = $encode($b);

        return [$r, $g, $b];
    }

    /**
     * Convert XYZ D50 color values to XYZ D65.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @return array The XYZ D65 values.
     */
    public static function xyzD50ToXyzD65(float $x, float $y, float $z): array
    {
        return [
            (0.955576618511 * $x) + (-0.023039344223 * $y) + (0.063163638894 * $z),
            (-0.028289504216 * $x) + (1.009941414544 * $y) + (0.021007796040 * $z),
            (0.012298185122 * $x) + (-0.020483208309 * $y) + (1.329909796254 * $z),
        ];
    }

    /**
     * Convert XYZ D65 color values to A98 RGB.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @return array The A98 RGB values.
     */
    public static function xyzD65ToA98Rgb(float $x, float $y, float $z): array
    {
        $r = (2.0413690 * $x) - (0.5649464 * $y) - (0.3446944 * $z);
        $g = (-0.9692660 * $x) + (1.8760108 * $y) + (0.0415560 * $z);
        $b = (0.0134474 * $x) - (0.1183897 * $y) + (1.0154096 * $z);

        $r = max(0, min(1, $r));
        $g = max(0, min(1, $g));
        $b = max(0, min(1, $b));

        $gamma = 1 / 2.19921875;

        return [
            pow($r, $gamma),
            pow($g, $gamma),
            pow($b, $gamma),
        ];
    }

    /**
     * Convert XYZ D65 color values to Display P3 Linear.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @return array The Display P3 Linear values.
     */
    public static function xyzD65ToDisplayP3Linear(float $x, float $y, float $z): array
    {
        return [
            (2.493496911941425 * $x) - (0.9313836179191239 * $y) - (0.40271078445071684 * $z),
            (-0.8294889695615747 * $x) + (1.7626640603183463 * $y) + (0.023624685841943577 * $z),
            (0.03584583024378447 * $x) - (0.07617238926804182 * $y) + (0.9568845240076872 * $z),
        ];
    }

    /**
     * Convert XYZ D65 color values to OK LAB.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @return array The OK LAB values.
     */
    public static function xyzD65ToOkLab(float $x, float $y, float $z): array
    {
        $cbrt = static fn(float $v): float => $v < 0 ?
            -pow(-$v, 1 / 3) :
            pow($v, 1 / 3);

        $l = (0.8189330101 * $x) + (0.3618667424 * $y) - (0.1288597137 * $z);
        $m = (0.0329845436 * $x) + (0.9293118715 * $y) + (0.0361456387 * $z);
        $s = (0.0482003018 * $x) + (0.2643662691 * $y) + (0.6338517070 * $z);

        $l = $cbrt($l);
        $m = $cbrt($m);
        $s = $cbrt($s);

        return [
            (0.2104542553 * $l) + (0.7936177850 * $m) - (0.0040720468 * $s),
            (1.9779984951 * $l) - (2.4285922050 * $m) + (0.4505937099 * $s),
            (0.0259040371 * $l) + (0.7827717662 * $m) - (0.8086757660 * $s),
        ];
    }

    /**
     * Convert XYZ D65 color values to Rec. 2020.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @return array The Rec. 2020 values.
     */
    public static function xyzD65ToRec2020(float $x, float $y, float $z): array
    {
        $encode = static fn(float $v): float => $v <= 0.0181 ?
            ($v * 4.5) :
            ((1.099 * pow($v, 1 / 2.2)) - 0.099);

        $r = (1.716651187971268 * $x) - (0.355670783776392 * $y) - (0.253366281373660 * $z);
        $g = (-0.666684351832489 * $x) + (1.616481236634939 * $y) + (0.015768545813911 * $z);
        $b = (0.017639857445310 * $x) - (0.042770613257808 * $y) + (0.942103121235474 * $z);

        $r = max(0, min(1, $r));
        $g = max(0, min(1, $g));
        $b = max(0, min(1, $b));

        $r = $encode($r);
        $g = $encode($g);
        $b = $encode($b);

        return [$r, $g, $b];
    }

    /**
     * Convert XYZ D65 color values to SRGB Linear.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @return array The SRGB Linear values.
     */
    public static function xyzD65ToSrgbLinear(float $x, float $y, float $z): array
    {
        $r = (3.2404542 * $x) - (1.5371385 * $y) - (0.4985314 * $z);
        $g = (-0.9692660 * $x) + (1.8760108 * $y) + (0.0415560 * $z);
        $b = (0.0556434 * $x) - (0.2040259 * $y) + (1.0572252 * $z);

        return [$r, $g, $b];
    }

    /**
     * Convert XYZ D65 color values to XYZ D50.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @return array The XYZ D50 values.
     */
    public static function xyzD65ToXyzD50(float $x, float $y, float $z): array
    {
        return [
            (1.047811216997 * $x) + (0.022886603691 * $y) + (-0.050127010796 * $z),
            (0.029542454198 * $x) + (0.990484427399 * $y) + (-0.017049093754 * $z),
            (-0.0092344585052 * $x) + (0.015043613370 * $y) + (0.752131651235 * $z),
        ];
    }

    /**
     * Calculate the R, G or B value via hue interpolation.
     *
     * @param float|int $p The first value.
     * @param float|int $q The second value.
     * @param float|int $t The shifted hue value.
     * @return float|int The R, G or B value.
     */
    protected static function rgbHue(float $p, float $q, float $t): float
    {
        $t = fmod($t + 1, 1);

        if ($t < 1 / 6) {
            return $p + ($q - $p) * 6 * $t;
        }

        if ($t < 1 / 2) {
            return $q;
        }

        if ($t < 2 / 3) {
            return $p + (($q - $p) * (2 / 3 - $t) * 6);
        }

        return $p;
    }
}
