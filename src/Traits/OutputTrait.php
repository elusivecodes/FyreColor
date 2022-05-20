<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

use const
    PHP_INT_MAX;

use function
    array_search,
    round;

/**
 * OutputTrait
 */
trait OutputTrait
{

    /**
     * Return a HTML string representation of the color.
     * @return string The HTML color string.
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Get the closest color name for the color.
     * @return string The name.
     */
    public function label(): string
    {
        $closestDist = PHP_INT_MAX;

        foreach (static::COLORS AS $label => $color) {
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
     * Return a hexadecimal string representation of the color.
     * @return $string The hexadecimal string.
     */
    public function toHexString(): string
    {
        $hex = $this->getHex();

        return static::toHex($hex);
    }

    /**
     * Return a HSL/HSLA string representation of the color.
     * @return string The HSL/HSLA string.
     */
    public function toHSLString(): string
    {
        [$h, $s, $l] = static::RGB2HSL($this->r, $this->g, $this->b);

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
     * Return a RGB/RGBA string representation of the color.
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
     * Return a HTML string representation of the color.
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

}
