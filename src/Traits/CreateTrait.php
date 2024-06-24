<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

use Fyre\Color\Color;
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
        'yellowgreen' => '#9acd32'
    ];

    /**
     * Create a new Color from CMY values.
     * @param int|float $c The cyan value. (0, 100)
     * @param int|float $m The magenta value. (0, 100)
     * @param int|float $y The yellow value. (0, 100)
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color.
     */
    public static function fromCMY(float|int $c, float|int $m, float|int $y, float|int $a = 1): static
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
     * @return Color A new Color.
     */
    public static function fromCMYK(float|int $c, float|int $m, float|int $y, float|int $k, float|int $a = 1): static
    {
        [$c, $m, $y] = static::CMYK2CMY($c, $m, $y, $k);

        return static::fromCMY($c, $m, $y, $a);
    }

    /**
     * Create a new Color from a hex color string.
     * @param string $string The hex color string.
     * @return Color A new Color.
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
     * @return Color A new Color.
     */
    public static function fromHSL(float|int $h, float|int $s, float|int $l, float|int $a = 1): static
    {
        [$r, $g, $b] = static::HSL2RGB($h, $s, $l);

        return new static($r, $g, $b, $a);
    }

    /**
     * Create a new Color from a HSL color string.
     * @param string $string The HSL color string.
     * @return Color A new Color.
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
     * @return Color A new Color.
     */
    public static function fromHSV(float|int $h, float|int $s, float|int $v, float|int $a = 1): static
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
     * @return Color A new Color.
     */
    public static function fromRGB(float|int $r, float|int $g, float|int $b, float|int $a = 1): static
    {
        return new static($r, $g, $b, $a);
    }

    /**
     * Create a new Color from a RGB color string.
     * @param string $string The RGB color string.
     * @return Color A new Color.
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
     * @return Color A new Color.
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
