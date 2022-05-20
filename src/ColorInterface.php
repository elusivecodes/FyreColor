<?php
declare(strict_types=1);

namespace Fyre\Color;

/**
 * ColorInterface
 */
interface ColorInterface
{

    /**
     * Create an array with 2 analogous color variations.
     * @return array An array containing 2 analogous color variations.
     */
    public function analogous(): array;

    /**
     * Clone the Color.
     * @return Color A new Color object.
     */
    public function clone(): static;

    /**
     * Create a complementary color variation.
     * @return Color A complementary color variation.
     */
    public function complementary(): static;

    /**
     * Darken the color by a specified amount.
     * @param int|float $amount The amount to darken the color by. (0, 1)
     * @return Color The darkened Color object.
     */
    public function darken(int|float $amount): static;

    /**
     * Get the alpha value of the color.
     * @return int|float The alpha value. (0, 1)
     */
    public function getAlpha(): int|float;

    /**
     * Get the brightness value of the color.
     * @return int|float The brightness value. (0, 100)
     */
    public function getBrightness(): int|float;

    /**
     * Get the hue value of the color.
     * @return int|float The hue value. (0, 360)
     */
    public function getHue(): int|float;

    /**
     * Get the saturation value of the color.
     * @return int|float The saturation value. (0, 100)
     */
    public function getSaturation(): int|float;

    /**
     * Invert the color.
     * @return Color The inverted Color object.
     */
    public function invert(): static;

    /**
     * Get the closest color name for the color.
     * @return string The name.
     */
    public function label(): string;

    /**
     * Lighten the color by a specified amount.
     * @param int|float $amount The amount to lighten the color by. (0, 1)
     * @return Color The lightened Color object.
     */
    public function lighten(int|float $amount): static;

    /**
     * Get the relative luminance value of the color 
     * @return float The relative luminance value. (0, 1)
     */
    public function luma(): float;

    /**
     * Create a palette object with a specified number of shades, tints and tone variations.
     * @param int $shades The number of shades to generate.
     * @param int $tints The number of tints to generate.
     * @param int $tones The number of tones to generate.
     * @return array A palette object.
     */
    public function palette(int $shades = 10, int $tints = 10, int $tones = 10): array;

    /**
     * Set the alpha value of the color.
     * @param int|float $a The alpha value. (0, 1)
     * @return Color The modified Color object.
     */
    public function setAlpha(int|float $a): static;

    /**
     * Set the brightness value of the color.
     * @param int|float $v The brightness value. (0, 100)
     * @return Color The modified Color object.
     */
    public function setBrightness(int|float $v): static;

    /**
     * Set the hue value of the color.
     * @param int|float $h The hue value. (0, 360)
     * @return Color The modified Color object.
     */
    public function setHue(int|float $h): static;

    /**
     * Set the saturation value of the color.
     * @param int|float $s The saturation value. (0, 100)
     * @return Color The modified Color object.
     */
    public function setSaturation(int|float $s): static;

    /**
     * Shade the color by a specified amount.
     * @param int|float $amount The amount to shade the color by. (0, 1)
     * @return Color The shaded Color object.
     */
    public function shade(int|float $amount): static;

    /**
     * Create an array with a specified number of shade variations.
     * @param int $shades The number of shades to generate.
     * @return array An array containing shade variations.
     */
    public function shades(int $shades = 10): array;

    /**
     * Create an array with 2 split color variations.
     * @return array An array containing 2 split color variations.
     */
    public function split(): array;

    /**
     * Create an array with 3 tetradic color variations.
     * @return array An array containing 3 tetradic color variations.
     */
    public function tetradic(): array;

    /**
     * Tint the color by a specified amount.
     * @param int|float $amount The amount to tint the color by. (0, 1)
     * @return Color The tinted Color object.
     */
    public function tint(int|float $amount): static;

    /**
     * Create an array with a specified number of tint variations.
     * @param int $tints The number of tints to generate.
     * @return array An array containing tint variations.
     */
    public function tints(int $tints = 10): array;

    /**
     * Create an array with a specified number of tone variations.
     * @param int $tones The number of tones to generate.
     * @return array An array containing tone variations.
     */
    public function tones(int $tones = 10): array;

    /**
     * Return a hexadecimal string representation of the color.
     * @return $string The hexadecimal string.
     */
    public function toHexString(): string;

    /**
     * Return a HSL/HSLA string representation of the color.
     * @return string The HSL/HSLA string.
     */
    public function toHSLString(): string;

    /**
     * Tone the color by a specified amount.
     * @param int|float $amount The amount to tone the color by. (0, 1)
     * @return Color The toned Color object.
     */
    public function tone(int|float $amount): static;

    /**
     * Return a RGB/RGBA string representation of the color.
     * @return string The RGB/RGBA string.
     */
    public function toRGBString(): string;

    /**
     * Return a HTML string representation of the color.
     * @return string The HTML color string.
     */
    public function toString(): string;

    /**
     * Create an array with 2 triadic color variations.
     * @return array An array containing 2 triadic color variations.
     */
    public function triadic(): array;

    /**
     * Get the contrast value between two colors.
     * @param ColorInterface $color1 The first Color.
     * @param ColorInterface $color2 The second Color.
     * @return float The contrast value. (1, 21)
     */
    public static function contrast(ColorInterface $color1, ColorInterface $color2): float;

    /**
     * Calculate the distance between two colors.
     * @param ColorInterface $color1 The first Color.
     * @param ColorInterface $color2 The second Color.
     * @return float The distance between the colors.
     */
    public static function dist(ColorInterface $color1, ColorInterface $color2): float;

    /**
     * Find an optimally contrasting color for another color.
     * @param ColorInterface $color1 The first Color.
     * @param ColorInterface|null $color2 The second Color.
     * @param int|float $minContrast The minimum contrast.
     * @param int|float $stepSize The step size.
     * @return ColorInterface|null The new Color.
     */
    public static function findContrast(ColorInterface $color1, ColorInterface|null $color2 = null, int|float $minContrast = 4.5, int|float $stepSize = .01): ColorInterface|null;

    /**
     * Create a new Color from CMY values.
     * @param int|float $c The cyan value. (0, 100)
     * @param int|float $m The magenta value. (0, 100)
     * @param int|float $y The yellow value. (0, 100)
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color object.
     */
    public static function fromCMY(int|float $c, int|float $m, int|float $y, int|float $a = 1): static;

    /**
     * Create a new Color from CMYK values.
     * @param int|float $c The cyan value. (0, 100)
     * @param int|float $m The magenta value. (0, 100)
     * @param int|float $y The yellow value. (0, 100)
     * @param int|float $k The key value. (0, 100)
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color object.
     */
    public static function fromCMYK(int|float $c, int|float $m, int|float $y, int|float $k, int|float $a = 1): static;

    /**
     * Create a new Color from a hex color string.
     * @param string $string The hex color string.
     * @return Color A new Color object.
     * @throws RuntimeException if the hex string is not valid.
     */
    public static function fromHexString(string $string): static;

    /**
     * Create a new Color from HSL values.
     * @param int|float $h The hue value. (0, 360)
     * @param int|float $s The saturation value. (0, 100)
     * @param int|float $l The lightness value. (0, 100)
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color object.
     */
    public static function fromHSL(int|float $h, int|float $s, int|float $l, int|float $a = 1): static;

    /**
     * Create a new Color from a HSL color string.
     * @param string $string The HSL color string.
     * @return Color A new Color object.
     * @throws RuntimeException if the HSL string is not valid.
     */
    public static function fromHSLString(string $string): static;

    /**
     * Create a new Color from HSV values.
     * @param int|float $h The hue value. (0, 360)
     * @param int|float $s The saturation value. (0, 100)
     * @param int|float $v The brightness value. (0, 100)
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color object.
     */
    public static function fromHSV(int|float $h, int|float $s, int|float $v, int|float $a = 1): static;

    /**
     * Create a new Color from RGB values.
     * @param int|float $r The red value. (0, 255)
     * @param int|float $g The green value. (0, 255)
     * @param int|float $b The blue value. (0, 255)
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color object.
     */
    public static function fromRGB(int|float $r, int|float $g, int|float $b, int|float $a = 1): static;

    /**
     * Create a new Color from a RGB color string.
     * @param string $string The RGB color string.
     * @return Color A new Color object.
     * @throws RuntimeException if the RGB string is not valid.
     */
    public static function fromRGBString(string $string): static;

    /**
     * Create a new Color from a HTML color string.
     * @param string $string The HTML color string.
     * @return Color A new Color object.
     * @throws RuntimeException if the color string is not valid.
     */
    public static function fromString(string $string): static;

    /**
     * Create a new Color by mixing two colors together by a specified amount.
     * @param ColorInterface $color1 The first Color.
     * @param ColorInterface $color2 The second Color.
     * @param int|float $amount The amount to mix them by. (0, 1)
     * @return Color A new Color object.
     */
    public static function mix(ColorInterface $color1, ColorInterface $color2, int|float $amount): static;

    /**
     * Create a new Color by multiplying two colors together by a specified amount.
     * @param ColorInterface $color1 The first Color.
     * @param ColorInterface $color2 The second Color.
     * @param int|float $amount The amount to multiply them by. (0, 1)
     * @return Color A new Color object.
     */
    public static function multiply(ColorInterface $color1, ColorInterface $color2, int|float $amount): static;

}
