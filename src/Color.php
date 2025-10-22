<?php
declare(strict_types=1);

namespace Fyre\Color;

use Fyre\Color\Colors\A98Rgb;
use Fyre\Color\Colors\DisplayP3;
use Fyre\Color\Colors\DisplayP3Linear;
use Fyre\Color\Colors\Hex;
use Fyre\Color\Colors\Hsl;
use Fyre\Color\Colors\Hwb;
use Fyre\Color\Colors\Lab;
use Fyre\Color\Colors\Lch;
use Fyre\Color\Colors\OkLab;
use Fyre\Color\Colors\OkLch;
use Fyre\Color\Colors\ProPhotoRgb;
use Fyre\Color\Colors\Rec2020;
use Fyre\Color\Colors\Rgb;
use Fyre\Color\Colors\Srgb;
use Fyre\Color\Colors\SrgbLinear;
use Fyre\Color\Colors\XyzD50;
use Fyre\Color\Colors\XyzD65;
use Fyre\Utility\Traits\MacroTrait;
use Fyre\Utility\Traits\StaticMacroTrait;
use InvalidArgumentException;
use Stringable;

use function array_key_exists;
use function array_map;
use function array_reduce;
use function array_values;
use function count;
use function fmod;
use function hexdec;
use function hypot;
use function implode;
use function max;
use function min;
use function preg_match;
use function preg_replace;
use function preg_split;
use function rad2deg;
use function round;
use function str_ends_with;
use function str_split;
use function strlen;
use function strtolower;
use function substr;
use function trim;

use const PHP_INT_MAX;

/**
 * Color
 */
abstract class Color implements Stringable
{
    use MacroTrait;
    use StaticMacroTrait;

    public const CSS_COLORS = [
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

    protected const COLOR_SPACE = '';

    protected const CONVERSION_MAP = [
        'a98-rgb' => 'toA98Rgb',
        'display-p3' => 'toDisplayP3',
        'display-p3-linear' => 'toDisplayP3Linear',
        'hsl' => 'toHsl',
        'hwb' => 'toHwb',
        'lab' => 'toLab',
        'lch' => 'toLch',
        'oklab' => 'toOkLab',
        'oklch' => 'toOkLch',
        'prophoto-rgb' => 'toProPhotoRgb',
        'rec2020' => 'toRec2020',
        'hex' => 'toHex',
        'rgb' => 'toRgb',
        'srgb' => 'toSrgb',
        'srgb-linear' => 'toSrgbLinear',
        'xyz-d50' => 'toXyzD50',
        'xyz-d65' => 'toXyzD65',
    ];

    public readonly float $alpha;

    /**
     * Create a Color from A98 RGB color values.
     *
     * @param float $red The red value. (0, 1)
     * @param float $green The green value. (0, 1)
     * @param float $blue The blue value. (0, 1)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromA98Rgb(float $red = 0, float $green = 0, float $blue = 0, float $alpha = 1): static
    {
        return new A98Rgb($red, $green, $blue, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from Display P3 color values.
     *
     * @param float $red The red value. (0, 1)
     * @param float $green The green value. (0, 1)
     * @param float $blue The blue value. (0, 1)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromDisplayP3(float $red = 0, float $green = 0, float $blue = 0, float $alpha = 1): static
    {
        return new DisplayP3($red, $green, $blue, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from Display P3 Linear color values.
     *
     * @param float $red The red value. (0, 1)
     * @param float $green The green value. (0, 1)
     * @param float $blue The blue value. (0, 1)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromDisplayP3Linear(float $red = 0, float $green = 0, float $blue = 0, float $alpha = 1): static
    {
        return new DisplayP3Linear($red, $green, $blue, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from HSL color values.
     *
     * @param float $hue The hue value. (0, 360)
     * @param float $saturation The saturation value. (0, 100)
     * @param float $lightness The lightness value. (0, 100)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromHsl(float $hue = 0, float $saturation = 0, float $lightness = 0, float $alpha = 1): static
    {
        return new Hsl($hue, $saturation, $lightness, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from HWB color values.
     *
     * @param float $hue The hue value. (0, 360)
     * @param float $whiteness The whiteness value. (0, 100)
     * @param float $blackness The blackness value. (0, 100)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromHwb(float $hue = 0, float $whiteness = 0, float $blackness = 0, float $alpha = 1): static
    {
        return new Hwb($hue, $whiteness, $blackness, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from LAB color values.
     *
     * @param float $lightness The lightness value. (0, 100)
     * @param float $a The a value. (-125, 125)
     * @param float $b The b value. (-125, 125)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromLab(float $lightness = 0, float $a = 0, float $b = 0, float $alpha = 1): static
    {
        return new Lab($lightness, $a, $b, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from LCH color values.
     *
     * @param float $lightness The lightness value. (0, 100)
     * @param float $chroma The chroma value. (0, 150)
     * @param float $hue The hue value. (0, 360)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromLch(float $lightness = 0, float $chroma = 0, float $hue = 0, float $alpha = 1): static
    {
        return new Lch($lightness, $chroma, $hue, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from OK LAB color values.
     *
     * @param float $lightness The lightness value. (0, 1)
     * @param float $a The a value. (-0.4, 0.4)
     * @param float $b The b value. (-0.4, 0.4)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromOkLab(float $lightness = 0, float $a = 0, float $b = 0, float $alpha = 1): static
    {
        return new OkLab($lightness, $a, $b, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from OK LCH color values.
     *
     * @param float $lightness The lightness value. (0, 1)
     * @param float $chroma The chroma value. (0, 0.4)
     * @param float $hue The hue value. (0, 360)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromOkLch(float $lightness = 0, float $chroma = 0, float $hue = 0, float $alpha = 1): static
    {
        return new OkLch($lightness, $chroma, $hue, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from ProPhoto RGB color values.
     *
     * @param float $red The red value. (0, 1)
     * @param float $green The green value. (0, 1)
     * @param float $blue The blue value. (0, 1)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromProPhotoRgb(float $red = 0, float $green = 0, float $blue = 0, float $alpha = 1): static
    {
        return new ProPhotoRgb($red, $green, $blue, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from Rec. 2020 color values.
     *
     * @param float $red The red value. (0, 1)
     * @param float $green The green value. (0, 1)
     * @param float $blue The blue value. (0, 1)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromRec2020(float $red = 0, float $green = 0, float $blue = 0, float $alpha = 1): static
    {
        return new Rec2020($red, $green, $blue, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from RGB color values.
     *
     * @param float $red The red value. (0, 255)
     * @param float $green The green value. (0, 255)
     * @param float $blue The blue value. (0, 255)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromRgb(float $red = 0, float $green = 0, float $blue = 0, float $alpha = 1): static
    {
        return new Rgb($red, $green, $blue, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from SRGB color values.
     *
     * @param float $red The red value. (0, 1)
     * @param float $green The green value. (0, 1)
     * @param float $blue The blue value. (0, 1)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromSrgb(float $red = 0, float $green = 0, float $blue = 0, float $alpha = 1): static
    {
        return new Srgb($red, $green, $blue, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from SRGB Linear color values.
     *
     * @param float $red The red value. (0, 1)
     * @param float $green The green value. (0, 1)
     * @param float $blue The blue value. (0, 1)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromSrgbLinear(float $red = 0, float $green = 0, float $blue = 0, float $alpha = 1): static
    {
        return new SrgbLinear($red, $green, $blue, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from a CSS color string.
     *
     * @param string $string The CSS color string.
     * @return Color The Color.
     *
     * @throws InvalidArgumentException if the CSS color string is not valid.
     */
    public static function createFromString(string $string): static
    {
        $string = strtolower(trim(preg_replace('/\s+/', ' ', $string)));

        if ($string === 'transparent') {
            return static::createFromRgb(alpha: 0);
        }

        if (array_key_exists($string, static::CSS_COLORS)) {
            $string = static::CSS_COLORS[$string];
        }

        if (preg_match('/^#([0-9a-f]{3,8})$/i', $string, $match)) {
            $hex = $match[1];

            if (strlen($hex) <= 4) {
                $hex = implode('', array_map(fn(string $c): string => $c.$c, str_split($hex)));
            }

            return new Hex(
                hexdec(substr($hex, 0, 2)),
                hexdec(substr($hex, 2, 2)),
                hexdec(substr($hex, 4, 2)),
                strlen($hex) > 6 ?
                    hexdec(substr($hex, 6, 2)) / 255 :
                    1,
            )->to(static::COLOR_SPACE);
        }
        if (preg_match('/^(rgb|rgba|hsl|hsla|hwb|lab|lch|oklab|oklch)\((.+)\)$/', $string, $match)) {
            $space = $match[1];
            $parts = preg_split('/\s*[,\/]\s*|\s+/', trim($match[2]), 4);

            if (count($parts) < 4) {
                $parts[] = '1';
            }

            switch ($space) {
                case 'hsl':
                case 'hsla':
                    return static::createFromHsl(
                        static::parseCssAngle($parts[0]),
                        static::parseCssNumber($parts[1], 100),
                        static::parseCssNumber($parts[2], 100),
                        static::parseCssNumber($parts[3]),
                    );
                case 'hwb':
                    return static::createFromHwb(
                        static::parseCssAngle($parts[0]),
                        static::parseCssNumber($parts[1], 100),
                        static::parseCssNumber($parts[2], 100),
                        static::parseCssNumber($parts[3]),
                    );
                case 'lab':
                    return static::createFromLab(
                        static::parseCssNumber($parts[0], 100),
                        static::parseCssNumber($parts[1], 125),
                        static::parseCssNumber($parts[2], 125),
                        static::parseCssNumber($parts[3]),
                    );
                case 'lch':
                    return static::createFromLch(
                        static::parseCssNumber($parts[0], 100),
                        static::parseCssNumber($parts[1], 150),
                        static::parseCssAngle($parts[2]),
                        static::parseCssNumber($parts[3]),
                    );
                case 'oklab':
                    return static::createFromOkLab(
                        static::parseCssNumber($parts[0]),
                        static::parseCssNumber($parts[1], 0.04),
                        static::parseCssNumber($parts[2], 0.04),
                        static::parseCssNumber($parts[3]),
                    );
                case 'oklch':
                    return static::createFromOkLch(
                        static::parseCssNumber($parts[0]),
                        static::parseCssNumber($parts[1], 0.04),
                        static::parseCssAngle($parts[2]),
                        static::parseCssNumber($parts[3]),
                    );
                case 'rgb':
                case 'rgba':
                    return static::createFromRgb(
                        static::parseCssNumber($parts[0], 255),
                        static::parseCssNumber($parts[1], 255),
                        static::parseCssNumber($parts[2], 255),
                        static::parseCssNumber($parts[3]),
                    );
            }
        } else if (preg_match('/^color\((a98-rgb|display-p3(?:-linear)?|prophoto-rgb|rec2020|srgb(?:-linear)?|xyz(?:-d50|-d65)?)\s+(.+)\)$/', $string, $match)) {
            $space = $match[1];
            $parts = preg_split('/\s*\/\s*|\s+/', trim($match[2]), 4);
            $values = array_map(static::parseCssNumber(...), $parts);

            switch ($space) {
                case 'a98-rgb':
                    return static::createFromA98Rgb(...$values);
                case 'display-p3':
                    return static::createFromDisplayP3(...$values);
                case 'display-p3-linear':
                    return static::createFromDisplayP3Linear(...$values);
                case 'prophoto-rgb':
                    return static::createFromProPhotoRgb(...$values);
                case 'rec2020':
                    return static::createFromRec2020(...$values);
                case 'srgb':
                    return static::createFromSrgb(...$values);
                case 'srgb-linear':
                    return static::createFromSrgbLinear(...$values);
                case 'xyz-d50':
                    return static::createFromXyzD50(...$values);
                case 'xyz':
                case 'xyz-d65':
                    return static::createFromXyzD65(...$values);
            }
        }

        throw new InvalidArgumentException('Invalid color string: '.$string);
    }

    /**
     * Create a Color from XYZ D50 color values.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromXyzD50(float $x = 0, float $y = 0, float $z = 0, float $alpha = 1): static
    {
        return new XyzD50($x, $y, $z, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Create a Color from XYZ D65 color values.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @param float $alpha The alpha value. (0, 1)
     * @return Color The Color.
     */
    public static function createFromXyzD65(float $x = 0, float $y = 0, float $z = 0, float $alpha = 1): static
    {
        return new XyzD65($x, $y, $z, $alpha)->to(static::COLOR_SPACE);
    }

    /**
     * Get the CSS color string.
     *
     * @return string The CSS color string.
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Calculate the contrast between this and another Color.
     *
     * @param Color $other The other Color.
     * @return float The contrast.
     */
    public function contrast(Color $other): float
    {
        $l1 = $this->luma();
        $l2 = $other->luma();

        if ($l1 < $l2) {
            return ($l2 + .05) / ($l1 + .05);
        }

        return ($l1 + .05) / ($l2 + .05);
    }

    /**
     * Get the alpha value.
     *
     * @return float The alpha value.
     */
    public function getAlpha(): float
    {
        return $this->alpha;
    }

    /**
     * Find the closest HTML color name for this color (in current color space).
     *
     * @return string The closest HTML color name.
     */
    public function label(): string
    {
        $a = array_values($this->toArray());

        $closestDist = PHP_INT_MAX;
        foreach (static::CSS_COLORS as $label => $hex) {
            $b = array_values(static::createFromString($hex)->toArray());

            $dist = array_reduce([
                $a[0] - $b[0],
                $a[1] - $b[1],
                $a[2] - $b[2],
            ], fn(float $x, float $y) => hypot($x, $y), 0);

            if ($dist < $closestDist) {
                $closest = $label;
                $closestDist = $dist;
            }
        }

        return $closest;
    }

    /**
     * Calculate the relative luminance value.
     *
     * @return float The relative luminance value.
     */
    public function luma(): float
    {
        return $this->toSrgb()->luma();
    }

    /**
     * Get the current color space.
     *
     * @return string The current color space.
     */
    public function space(): string
    {
        return static::COLOR_SPACE;
    }

    /**
     * Convert the Color to a named color space.
     *
     * @param string $space The color space.
     * @return Color The converted Color.
     *
     * @throws InvalidArgumentException if the Color class name is not valid.
     */
    public function to(string $space): Color
    {
        if (!$space || static::COLOR_SPACE === $space) {
            return $this;
        }

        if (!array_key_exists($space, static::CONVERSION_MAP)) {
            throw new InvalidArgumentException('Invalid Color space: '.$space);
        }

        return $this->{static::CONVERSION_MAP[$space]}();
    }

    /**
     * Convert the Color to A98Rgb.
     *
     * @return A98Rgb The A98Rgb Color.
     */
    public function toA98Rgb(): A98Rgb
    {
        return $this->toXyzD65()->toA98Rgb();
    }

    /**
     * Get the color components as an array.
     *
     * @return array The color components.
     */
    abstract public function toArray(): array;

    /**
     * Convert the Color to DisplayP3.
     *
     * @return DisplayP3 The DisplayP3 Color.
     */
    public function toDisplayP3(): DisplayP3
    {
        return $this->toDisplayP3Linear()->toDisplayP3();
    }

    /**
     * Convert the Color to DisplayP3Linear.
     *
     * @return DisplayP3Linear The DisplayP3Linear Color.
     */
    public function toDisplayP3Linear(): DisplayP3Linear
    {
        return $this->toXyzD65()->toDisplayP3Linear();
    }

    /**
     * Convert the Color to Hex.
     *
     * @return Hex The Hex Color.
     */
    public function toHex(): Hex
    {
        return $this->toRgb()->toHex();
    }

    /**
     * Convert the Color to Hsl.
     *
     * @return Hsl The Hsl Color.
     */
    public function toHsl(): Hsl
    {
        return $this->toSrgb()->toHsl();
    }

    /**
     * Convert the Color to Hwb.
     *
     * @return Hwb The Hwb Color.
     */
    public function toHwb(): Hwb
    {
        return $this->toSrgb()->toHwb();
    }

    /**
     * Convert the Color to Lab.
     *
     * @return Lab The Lab Color.
     */
    public function toLab(): Lab
    {
        return $this->toXyzD50()->toLab();
    }

    /**
     * Convert the Color to Lch.
     *
     * @return Lch The Lch Color.
     */
    public function toLch(): Lch
    {
        return $this->toLab()->toLch();
    }

    /**
     * Convert the Color to OkLab.
     *
     * @return OkLab The OkLab Color.
     */
    public function toOkLab(): OkLab
    {
        return $this->toXyzD65()->toOkLab();
    }

    /**
     * Convert the Color to OkLch.
     *
     * @return OkLch The OkLch Color.
     */
    public function toOkLch(): OkLch
    {
        return $this->toOkLab()->toOkLch();
    }

    /**
     * Convert the Color to ProPhotoRgb.
     *
     * @return ProPhotoRgb The ProPhotoRgb Color.
     */
    public function toProPhotoRgb(): ProPhotoRgb
    {
        return $this->toXyzD50()->toProPhotoRgb();
    }

    /**
     * Convert the Color to Rec2020.
     *
     * @return Rec2020 The Rec2020 Color.
     */
    public function toRec2020(): Rec2020
    {
        return $this->toXyzD65()->toRec2020();
    }

    /**
     * Convert the Color to Rgb.
     *
     * @return Rgb The Rgb Color.
     */
    public function toRgb(): Rgb
    {
        return $this->toSrgb()->toRgb();
    }

    /**
     * Convert the Color to Srgb.
     *
     * @return Srgb The Srgb Color.
     */
    public function toSrgb(): Srgb
    {
        return $this->toSrgbLinear()->toSrgb();
    }

    /**
     * Convert the Color to SrgbLinear.
     *
     * @return SrgbLinear The SrgbLinear Color.
     */
    public function toSrgbLinear(): SrgbLinear
    {
        return $this->toXyzD65()->toSrgbLinear();
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

        $values = array_values($this->toArray());

        $result = 'color('.
            static::COLOR_SPACE.
            ' '.
            round($values[0], $precision).' '.
            round($values[1], $precision).' '.
            round($values[2], $precision);

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
        return $this->toXyzD65()->toXyzD50();
    }

    /**
     * Convert the Color to XyzD65.
     *
     * @return XyzD65 The XyzD65 Color.
     */
    public function toXyzD65(): XyzD65
    {
        return $this->toSrgbLinear()->toXyzD65();
    }

    /**
     * Clone the Color with a new alpha value.
     *
     * @param float $alpha The alpha value.
     * @return Color A new Color.
     */
    public function withAlpha(float $alpha): static
    {
        $data = $this->toArray();
        $data['alpha'] = $alpha;

        return new static(...array_values($data));
    }

    /**
     * Clamp a value between a min and max.
     *
     * @param float|int $value The value to clamp.
     * @param float|int $min The minimum value.
     * @param float|int $max The maximum value.
     * @return float The clamped value.
     */
    protected static function clamp(float $value, float $min = 0, float $max = 1): float
    {
        return max($min, min($max, $value));
    }

    /**
     * Clamp a hue value.
     *
     * @param float|int $value The value to clamp.
     * @return float The clamped value.
     */
    protected static function clampHue(float $value): float
    {
        $value = fmod($value, 360);

        if ($value < 0) {
            $value += 360;
        }

        return $value;
    }

    /**
     * Parse an angle from a CSS value.
     *
     * @param string $value The CSS value.
     * @return float The parsed angle.
     */
    protected static function parseCssAngle(string $value): float
    {
        if (str_ends_with($value, '%')) {
            return (float) (substr($value, 0, -1) / 100 * 360);
        }

        if (str_ends_with($value, 'rad')) {
            return rad2deg((float) substr($value, 0, -3));
        }

        if (str_ends_with($value, 'turn')) {
            return (float) (substr($value, 0, -4) * 360);
        }

        return (float) $value;
    }

    /**
     * Parse a number from a CSS value.
     *
     * @param string $value The CSS value.
     * @param float $percentMultiplier The percent multiplier.
     * @return float The parsed number.
     */
    protected static function parseCssNumber(string $value, float $percentMultiplier = 1): float
    {
        if (str_ends_with($value, '%')) {
            return (float) (substr($value, 0, -1) / 100 * $percentMultiplier);
        }

        return (float) $value;
    }
}
