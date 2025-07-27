<?php
declare(strict_types=1);

namespace Fyre\Color;

use Fyre\Color\Internal\ColorConverter;
use Fyre\Utility\Traits\MacroTrait;
use RuntimeException;

use function array_fill;
use function array_key_exists;
use function array_keys;
use function array_map;
use function array_reduce;
use function array_search;
use function array_slice;
use function hexdec;
use function hypot;
use function max;
use function min;
use function preg_match;
use function round;
use function sprintf;
use function strlen;
use function strtolower;
use function substr;
use function trim;

use const PHP_INT_MAX;

/**
 * Color
 */
class Color
{
    use MacroTrait;

    protected const COLORS = [
        'aliceblue' => '#f0f8ff',
        'antiquewhite' => '#faebd7',
        'aqua' => '#00ffff',
        'aquamarine' => '#7fffd4',
        'azure' => '#f0ffff',
        'beige' => '#f5f5dc',
        'bisque' => '#ffe4c4',
        'black' => '#000000',
        'blanchedalmond' => '#ffebcd',
        'blue' => '#0000ff',
        'blueviolet' => '#8a2be2',
        'brown' => '#a52a2a',
        'burlywood' => '#deb887',
        'cadetblue' => '#5f9ea0',
        'chartreuse' => '#7fff00',
        'chocolate' => '#d2691e',
        'coral' => '#ff7f50',
        'cornflowerblue' => '#6495ed',
        'cornsilk' => '#fff8dc',
        'crimson' => '#dc143c',
        'cyan' => '#00ffff',
        'darkblue' => '#00008b',
        'darkcyan' => '#008b8b',
        'darkgoldenrod' => '#b8860b',
        'darkgray' => '#a9a9a9',
        'darkgrey' => '#a9a9a9',
        'darkgreen' => '#006400',
        'darkkhaki' => '#bdb76b',
        'darkmagenta' => '#8b008b',
        'darkolivegreen' => '#556b2f',
        'darkorange' => '#ff8c00',
        'darkorchid' => '#9932cc',
        'darkred' => '#8b0000',
        'darksalmon' => '#e9967a',
        'darkseagreen' => '#8fbc8f',
        'darkslateblue' => '#483d8b',
        'darkslategray' => '#2f4f4f',
        'darkslategrey' => '#2f4f4f',
        'darkturquoise' => '#00ced1',
        'darkviolet' => '#9400d3',
        'deeppink' => '#ff1493',
        'deepskyblue' => '#00bfff',
        'dimgray' => '#696969',
        'dimgrey' => '#696969',
        'dodgerblue' => '#1e90ff',
        'firebrick' => '#b22222',
        'floralwhite' => '#fffaf0',
        'forestgreen' => '#228b22',
        'fuchsia' => '#ff00ff',
        'gainsboro' => '#dcdcdc',
        'ghostwhite' => '#f8f8ff',
        'gold' => '#ffd700',
        'goldenrod' => '#daa520',
        'gray' => '#808080',
        'grey' => '#808080',
        'green' => '#008000',
        'greenyellow' => '#adff2f',
        'honeydew' => '#f0fff0',
        'hotpink' => '#ff69b4',
        'indianred' => '#cd5c5c',
        'indigo' => '#4b0082',
        'ivory' => '#fffff0',
        'khaki' => '#f0e68c',
        'lavender' => '#e6e6fa',
        'lavenderblush' => '#fff0f5',
        'lawngreen' => '#7cfc00',
        'lemonchiffon' => '#fffacd',
        'lightblue' => '#add8e6',
        'lightcoral' => '#f08080',
        'lightcyan' => '#e0ffff',
        'lightgoldenrodyellow' => '#fafad2',
        'lightgray' => '#d3d3d3',
        'lightgrey' => '#d3d3d3',
        'lightgreen' => '#90ee90',
        'lightpink' => '#ffb6c1',
        'lightsalmon' => '#ffa07a',
        'lightseagreen' => '#20b2aa',
        'lightskyblue' => '#87cefa',
        'lightslategray' => '#778899',
        'lightslategrey' => '#778899',
        'lightsteelblue' => '#b0c4de',
        'lightyellow' => '#ffffe0',
        'lime' => '#00ff00',
        'limegreen' => '#32cd32',
        'linen' => '#faf0e6',
        'magenta' => '#ff00ff',
        'maroon' => '#800000',
        'mediumaquamarine' => '#66cdaa',
        'mediumblue' => '#0000cd',
        'mediumorchid' => '#ba55d3',
        'mediumpurple' => '#9370db',
        'mediumseagreen' => '#3cb371',
        'mediumslateblue' => '#7b68ee',
        'mediumspringgreen' => '#00fa9a',
        'mediumturquoise' => '#48d1cc',
        'mediumvioletred' => '#c71585',
        'midnightblue' => '#191970',
        'mintcream' => '#f5fffa',
        'mistyrose' => '#ffe4e1',
        'moccasin' => '#ffe4b5',
        'navajowhite' => '#ffdead',
        'navy' => '#000080',
        'oldlace' => '#fdf5e6',
        'olive' => '#808000',
        'olivedrab' => '#6b8e23',
        'orange' => '#ffa500',
        'orangered' => '#ff4500',
        'orchid' => '#da70d6',
        'palegoldenrod' => '#eee8aa',
        'palegreen' => '#98fb98',
        'paleturquoise' => '#afeeee',
        'palevioletred' => '#db7093',
        'papayawhip' => '#ffefd5',
        'peachpuff' => '#ffdab9',
        'peru' => '#cd853f',
        'pink' => '#ffc0cb',
        'plum' => '#dda0dd',
        'powderblue' => '#b0e0e6',
        'purple' => '#800080',
        'rebeccapurple' => '#663399',
        'red' => '#ff0000',
        'rosybrown' => '#bc8f8f',
        'royalblue' => '#4169e1',
        'saddlebrown' => '#8b4513',
        'salmon' => '#fa8072',
        'sandybrown' => '#f4a460',
        'seagreen' => '#2e8b57',
        'seashell' => '#fff5ee',
        'sienna' => '#a0522d',
        'silver' => '#c0c0c0',
        'skyblue' => '#87ceeb',
        'slateblue' => '#6a5acd',
        'slategray' => '#708090',
        'slategrey' => '#708090',
        'snow' => '#fffafa',
        'springgreen' => '#00ff7f',
        'steelblue' => '#4682b4',
        'tan' => '#d2b48c',
        'teal' => '#008080',
        'thistle' => '#d8bfd8',
        'tomato' => '#ff6347',
        'turquoise' => '#40e0d0',
        'violet' => '#ee82ee',
        'wheat' => '#f5deb3',
        'white' => '#ffffff',
        'whitesmoke' => '#f5f5f5',
        'yellow' => '#ffff00',
        'yellowgreen' => '#9acd32',
    ];

    protected float $a;

    protected float $b;

    protected float $g;

    protected float $r;

    /**
     * Get the contrast value between two colors.
     *
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
     *
     * @param Color $color1 The first Color.
     * @param Color $color2 The second Color.
     * @return float The distance between the colors.
     */
    public static function dist(Color $color1, Color $color2): float
    {
        return array_reduce([
            $color1->r - $color2->r,
            $color1->g - $color2->g,
            $color1->b - $color2->b,
        ], fn(float $x, float $y) => hypot($x, $y), 0);
    }

    /**
     * Find an optimally contrasting color for another color.
     *
     * @param Color $color1 The first Color.
     * @param Color|null $color2 The second Color.
     * @param float|int $minContrast The minimum contrast.
     * @param float|int $stepSize The step size.
     * @return Color|null The new Color.
     */
    public static function findContrast(Color $color1, Color|null $color2 = null, float|int $minContrast = 4.5, float|int $stepSize = .01): Color|null
    {
        $color2 ??= $color1;

        if (static::contrast($color1, $color2) >= $minContrast) {
            return $color2;
        }

        $methods = ['tint', 'shade'];
        for ($i = $stepSize; $i <= 1; $i += $stepSize) {
            foreach ($methods as $method) {
                $tempColor = $color2->$method($i);
                if (static::contrast($color1, $tempColor) >= $minContrast) {
                    return $tempColor;
                }
            }
        }

        return null;
    }

    /**
     * Create a new Color from CMY values.
     *
     * @param float|int $c The cyan value. (0, 100)
     * @param float|int $m The magenta value. (0, 100)
     * @param float|int $y The yellow value. (0, 100)
     * @param float|int $a The alpha value. (0, 1)
     * @return Color A new Color.
     */
    public static function fromCMY(float|int $c, float|int $m, float|int $y, float|int $a = 1): static
    {
        [$r, $g, $b] = ColorConverter::CMYToRGB($c, $m, $y);

        return new static($r, $g, $b, $a);
    }

    /**
     * Create a new Color from CMYK values.
     *
     * @param float|int $c The cyan value. (0, 100)
     * @param float|int $m The magenta value. (0, 100)
     * @param float|int $y The yellow value. (0, 100)
     * @param float|int $k The key value. (0, 100)
     * @param float|int $a The alpha value. (0, 1)
     * @return Color A new Color.
     */
    public static function fromCMYK(float|int $c, float|int $m, float|int $y, float|int $k, float|int $a = 1): static
    {
        [$c, $m, $y] = ColorConverter::CMYKToCMY($c, $m, $y, $k);

        return static::fromCMY($c, $m, $y, $a);
    }

    /**
     * Create a new Color from a hex color string.
     *
     * @param string $string The hex color string.
     * @return Color A new Color.
     *
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
     *
     * @param float|int $h The hue value. (0, 360)
     * @param float|int $s The saturation value. (0, 100)
     * @param float|int $l The lightness value. (0, 100)
     * @param float|int $a The alpha value. (0, 1)
     * @return Color A new Color.
     */
    public static function fromHSL(float|int $h, float|int $s, float|int $l, float|int $a = 1): static
    {
        [$r, $g, $b] = ColorConverter::HSLToRGB($h, $s, $l);

        return new static($r, $g, $b, $a);
    }

    /**
     * Create a new Color from a HSL color string.
     *
     * @param string $string The HSL color string.
     * @return Color A new Color.
     *
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
     *
     * @param float|int $h The hue value. (0, 360)
     * @param float|int $s The saturation value. (0, 100)
     * @param float|int $v The brightness value. (0, 100)
     * @param float|int $a The alpha value. (0, 1)
     * @return Color A new Color.
     */
    public static function fromHSV(float|int $h, float|int $s, float|int $v, float|int $a = 1): static
    {
        [$r, $g, $b] = ColorConverter::HSVToRGB($h, $s, $v);

        return new static($r, $g, $b, $a);
    }

    /**
     * Create a new Color from RGB values.
     *
     * @param float|int $r The red value. (0, 255)
     * @param float|int $g The green value. (0, 255)
     * @param float|int $b The blue value. (0, 255)
     * @param float|int $a The alpha value. (0, 1)
     * @return Color A new Color.
     */
    public static function fromRGB(float|int $r, float|int $g, float|int $b, float|int $a = 1): static
    {
        return new static($r, $g, $b, $a);
    }

    /**
     * Create a new Color from a RGB color string.
     *
     * @param string $string The RGB color string.
     * @return Color A new Color.
     *
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
     *
     * @param string $string The HTML color string.
     * @return Color A new Color.
     *
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

    /**
     * Create a new Color by mixing two colors together by a specified amount.
     *
     * @param Color $color1 The first Color.
     * @param Color $color2 The second Color.
     * @param float|int $amount The amount to mix them by. (0, 1)
     * @return Color A new Color.
     */
    public static function mix(Color $color1, Color $color2, float|int $amount): static
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
     *
     * @param Color $color1 The first Color.
     * @param Color $color2 The second Color.
     * @param float|int $amount The amount to multiply them by. (0, 1)
     * @return Color A new Color.
     */
    public static function multiply(Color $color1, Color $color2, float|int $amount): static
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
     * New Color constructor.
     *
     * @param float|int $r The red value, or the brightness value.
     * @param float|int $g The green value or the alpha value.
     * @param float|int $a The alpha value.
     * @param float|int|null $g The blue value.
     */
    public function __construct(float|int $r = 0, float|int $g = 1, float|int|null $b = null, float|int $a = 1)
    {
        if ($b === null) {
            $a = $g;
            $b = $g = $r = round($r * 2.55, 2);
        }

        $this->r = static::clamp($r, 0, 255);
        $this->g = static::clamp($g, 0, 255);
        $this->b = static::clamp($b, 0, 255);
        $this->a = static::clamp($a, 0, 1);
    }

    /**
     * Get a HTML string representation of the color.
     *
     * @return string The HTML color string.
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Create an array with 2 analogous color variations.
     *
     * @return array An array containing 2 analogous color variations.
     */
    public function analogous(): array
    {
        [$h, $s, $v] = ColorConverter::RGBToHSV($this->r, $this->g, $this->b);
        [$r1, $g1, $b1] = ColorConverter::HSVToRGB($h + 30, $s, $v);
        [$r2, $g2, $b2] = ColorConverter::HSVToRGB($h - 30, $s, $v);

        return [
            new static($r1, $g1, $b1, $this->a),
            new static($r2, $g2, $b2, $this->a),
        ];
    }

    /**
     * Create a complementary color variation.
     *
     * @return Color A complementary color variation.
     */
    public function complementary(): static
    {
        [$h, $s, $v] = ColorConverter::RGBToHSV($this->r, $this->g, $this->b);
        [$r, $g, $b] = ColorConverter::HSVToRGB($h + 180, $s, $v);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Darken the color by a specified amount.
     *
     * @param float|int $amount The amount to darken the color by. (0, 1)
     * @return Color A new Color.
     */
    public function darken(float|int $amount): static
    {
        [$h, $s, $l] = $this->getHSL();
        $l -= $l * $amount;
        [$r, $g, $b] = ColorConverter::HSLToRGB($h, $s, $l);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Get the alpha value of the color.
     *
     * @return float|int The alpha value. (0, 1)
     */
    public function getAlpha(): float|int
    {
        return $this->a;
    }

    /**
     * Get the brightness value of the color.
     *
     * @return float|int The brightness value. (0, 100)
     */
    public function getBrightness(): float|int
    {
        return $this->getHSV()[2];
    }

    /**
     * Get the hue value of the color.
     *
     * @return float|int The hue value. (0, 360)
     */
    public function getHue(): float|int
    {
        return $this->getHSV()[0];
    }

    /**
     * Get the saturation value of the color.
     *
     * @return float|int The saturation value. (0, 100)
     */
    public function getSaturation(): float|int
    {
        return $this->getHSV()[1];
    }

    /**
     * Invert the color.
     *
     * @return Color A new Color.
     */
    public function invert(): static
    {
        return new static(
            255 - $this->r,
            255 - $this->g,
            255 - $this->b,
            $this->a
        );
    }

    /**
     * Get the closest color name for the color.
     *
     * @return string The name.
     */
    public function label(): string
    {
        $closestDist = PHP_INT_MAX;

        foreach (static::COLORS as $label => $color) {
            $color = static::fromHexString($color);
            $dist = static::dist($this, $color);

            if ($dist < $closestDist) {
                $closest = $label;
                $closestDist = $dist;
            }
        }

        return $closest;
    }

    /**
     * Lighten the color by a specified amount.
     *
     * @param float|int $amount The amount to lighten the color by. (0, 1)
     * @return Color A new Color.
     */
    public function lighten(float|int $amount): static
    {
        [$h, $s, $l] = $this->getHSL();
        $l += (100 - $l) * $amount;
        [$r, $g, $b] = ColorConverter::HSLToRGB($h, $s, $l);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Get the relative luminance value of the color
     *
     * @return float The relative luminance value. (0, 1)
     */
    public function luma(): float
    {
        return ColorConverter::RGBToLuma($this->r, $this->g, $this->b);
    }

    /**
     * Create a palette object with a specified number of shades, tints and tone variations.
     *
     * @param int $shades The number of shades to generate.
     * @param int $tints The number of tints to generate.
     * @param int $tones The number of tones to generate.
     * @return array A palette object.
     */
    public function palette(int $shades = 10, int $tints = 10, int $tones = 10): array
    {
        return [
            'shades' => $this->shades($shades),
            'tints' => $this->tints($tints),
            'tones' => $this->tones($tones),
        ];
    }

    /**
     * Set the alpha value of the color.
     *
     * @param float|int $a The alpha value. (0, 1)
     * @return Color A new Color.
     */
    public function setAlpha(float|int $a): static
    {
        return new static($this->r, $this->g, $this->b, $a);
    }

    /**
     * Set the brightness value of the color.
     *
     * @param float|int $v The brightness value. (0, 100)
     * @return Color A new Color.
     */
    public function setBrightness(float|int $v): static
    {
        [$h, $s, $_] = $this->getHSV();
        [$r, $g, $b] = ColorConverter::HSVToRGB($h, $s, $v);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Set the hue value of the color.
     *
     * @param float|int $h The hue value. (0, 360)
     * @return Color A new Color.
     */
    public function setHue(float|int $h): static
    {
        [$_, $s, $v] = $this->getHSV();
        [$r, $g, $b] = ColorConverter::HSVToRGB($h, $s, $v);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Set the saturation value of the color.
     *
     * @param float|int $s The saturation value. (0, 100)
     * @return Color A new Color.
     */
    public function setSaturation(float|int $s): static
    {
        [$h, $_, $v] = $this->getHSV();
        [$r, $g, $b] = ColorConverter::HSVToRGB($h, $s, $v);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Shade the color by a specified amount.
     *
     * @param float|int $amount The amount to shade the color by. (0, 1)
     * @return Color A new Color.
     */
    public function shade(float|int $amount): static
    {
        $color = static::mix($this, new static(0), $amount);

        return new static(
            $color->r,
            $color->g,
            $color->b,
            $this->a
        );
    }

    /**
     * Create an array with a specified number of shade variations.
     *
     * @param int $shades The number of shades to generate.
     * @return array An array containing shade variations.
     */
    public function shades(int $shades = 10): array
    {
        return array_map(
            fn(int $value): Color => $this->shade($value / ($shades + 1)),
            array_keys(array_fill(0, $shades, 0))
        );
    }

    /**
     * Create an array with 2 split color variations.
     *
     * @return array An array containing 2 split color variations.
     */
    public function split(): array
    {
        [$h, $s, $v] = ColorConverter::RGBToHSV($this->r, $this->g, $this->b);
        [$r1, $g1, $b1] = ColorConverter::HSVToRGB($h + 150, $s, $v);
        [$r2, $g2, $b2] = ColorConverter::HSVToRGB($h - 150, $s, $v);

        return [
            new static($r1, $g1, $b1, $this->a),
            new static($r2, $g2, $b2, $this->a),
        ];
    }

    /**
     * Create an array with 3 tetradic color variations.
     *
     * @return array An array containing 3 tetradic color variations.
     */
    public function tetradic(): array
    {
        [$h, $s, $v] = ColorConverter::RGBToHSV($this->r, $this->g, $this->b);
        [$r1, $g1, $b1] = ColorConverter::HSVToRGB($h + 60, $s, $v);
        [$r2, $g2, $b2] = ColorConverter::HSVToRGB($h + 180, $s, $v);
        [$r3, $g3, $b3] = ColorConverter::HSVToRGB($h - 120, $s, $v);

        return [
            new static($r1, $g1, $b1, $this->a),
            new static($r2, $g2, $b2, $this->a),
            new static($r3, $g3, $b3, $this->a),
        ];
    }

    /**
     * Tint the color by a specified amount.
     *
     * @param float|int $amount The amount to tint the color by. (0, 1)
     * @return Color A new Color.
     */
    public function tint(float|int $amount): static
    {
        $color = static::mix($this, new static(100), $amount);

        return new static(
            $color->r,
            $color->g,
            $color->b,
            $this->a
        );
    }

    /**
     * Create an array with a specified number of tint variations.
     *
     * @param int $tints The number of tints to generate.
     * @return array An array containing tint variations.
     */
    public function tints(int $tints = 10): array
    {
        return array_map(
            fn(int $value): Color => $this->tint($value / ($tints + 1)),
            array_keys(array_fill(0, $tints, 0))
        );
    }

    /**
     * Get a hexadecimal string representation of the color.
     *
     * @return $string The hexadecimal string.
     */
    public function toHexString(): string
    {
        $hex = $this->getHex();

        return static::toHex($hex);
    }

    /**
     * Get a HSL/HSLA string representation of the color.
     *
     * @return string The HSL/HSLA string.
     */
    public function toHSLString(): string
    {
        [$h, $s, $l] = ColorConverter::RGBToHSL($this->r, $this->g, $this->b);

        $h = round($h);
        $s = round($s);
        $l = round($l);
        $a = round($this->a * 100);

        if ($a < 100) {
            return 'hsl('.$h.'deg '.$s.'% '.$l.'% / '.$a.'%)';
        }

        return 'hsl('.$h.'deg '.$s.'% '.$l.'%)';
    }

    /**
     * Tone the color by a specified amount.
     *
     * @param float|int $amount The amount to tone the color by. (0, 1)
     * @return Color A new Color.
     */
    public function tone(float|int $amount): static
    {
        $color = static::mix($this, new static(50), $amount);

        return new static(
            $color->r,
            $color->g,
            $color->b,
            $this->a
        );
    }

    /**
     * Create an array with a specified number of tone variations.
     *
     * @param int $tones The number of tones to generate.
     * @return array An array containing tone variations.
     */
    public function tones(int $tones = 10): array
    {
        return array_map(
            fn(int $value): Color => $this->tone($value / ($tones + 1)),
            array_keys(array_fill(0, $tones, 0))
        );
    }

    /**
     * Get a RGB/RGBA string representation of the color.
     *
     * @return string The RGB/RGBA string.
     */
    public function toRGBString(): string
    {
        $r = round($this->r);
        $g = round($this->g);
        $b = round($this->b);
        $a = round($this->a * 100);

        if ($a < 100) {
            return 'rgb('.$r.' '.$g.' '.$b.' / '.$a.'%)';
        }

        return 'rgb('.$r.' '.$g.' '.$b.')';
    }

    /**
     * Get a HTML string representation of the color.
     *
     * @return string The HTML color string.
     */
    public function toString(): string
    {
        if (!$this->a) {
            return 'transparent';
        }

        if ($this->a < 1) {
            return $this->toRGBString();
        }

        $hex = $this->getHex();

        $name = array_search($hex, static::COLORS);

        if ($name) {
            return $name;
        }

        return static::toHex($hex);
    }

    /**
     * Create an array with 2 triadic color variations.
     *
     * @return array An array containing 2 triadic color variations.
     */
    public function triadic(): array
    {
        [$h, $s, $v] = ColorConverter::RGBToHSV($this->r, $this->g, $this->b);
        [$r1, $g1, $b1] = ColorConverter::HSVToRGB($h + 120, $s, $v);
        [$r2, $g2, $b2] = ColorConverter::HSVToRGB($h - 120, $s, $v);

        return [
            new static($r1, $g1, $b1, $this->a),
            new static($r2, $g2, $b2, $this->a),
        ];
    }

    /**
     * Get the hex string of the Colour.
     *
     * @return string The hex string.
     */
    protected function getHex(): string
    {
        $r = round($this->r);
        $g = round($this->g);
        $b = round($this->b);

        if ($this->a < 1) {
            return sprintf('#%02x%02x%02x%02x', $r, $g, $b, $this->a * 255);
        }

        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }

    /**
     * Get the HSL values of the Colour.
     *
     * @return array The HSL values.
     */
    protected function getHSL(): array
    {
        return ColorConverter::RGBToHSL($this->r, $this->g, $this->b);
    }

    /**
     * Get the HSV values of the Colour.
     *
     * @return array The HSV values.
     */
    protected function getHSV(): array
    {
        return ColorConverter::RGBToHSV($this->r, $this->g, $this->b);
    }

    /**
     * Clamp a value between a min and max.
     *
     * @param float|int $min The minimum value of the clamped range.
     * @param float|int $max The maximum value of the clamped range.
     * @param float|int $value The value to clamp.
     * @return float The clamped value.
     */
    protected static function clamp(float|int $val, float|int $min = 0, float|int $max = 100): float
    {
        return (float) max($min, min($max, $val));
    }

    /**
     * Linear interpolation from one value to another.
     *
     * @param float|int $amount The amount to interpolate.
     * @param float|int $v1 The starting value.
     * @param float|int $v2 The ending value.
     * @return float The interpolated value.
     */
    protected static function lerp(float|int $a, float|int $b, float|int $amount): float
    {
        return round($a * (1 - $amount) + $b * $amount, 2);
    }

    /**
     * Shorten a hex string (if possible).
     *
     * @param string $hex The hex string.
     * @return string The hex string.
     */
    protected static function toHex(string $hex)
    {
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
