<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;

use function max;
use function round;

/**
 * Hsl
 */
class Hsl extends Color
{
    protected const COLOR_SPACE = 'hsl';

    public readonly float $hue;

    public readonly float $lightness;

    public readonly float $saturation;

    /**
     * New Hsl constructor.
     *
     * @param float $hue The hue value. (0, 360)
     * @param float $saturation The saturation value. (0, 100)
     * @param float $lightness The lightness value. (0, 100)
     * @param float $alpha The alpha value. (0, 1)
     */
    public function __construct(
        float $hue = 0,
        float $saturation = 0,
        float $lightness = 0,
        float $alpha = 1,
    ) {
        $this->hue = static::clampHue($hue);
        $this->saturation = static::clamp($saturation, max: 100);
        $this->lightness = static::clamp($lightness, max: 100);
        $this->alpha = static::clamp($alpha);
    }

    /**
     * Get the hue value.
     *
     * @return float The hue value.
     */
    public function getHue(): float
    {
        return $this->hue;
    }

    /**
     * Get the lightness value.
     *
     * @return float The lightness value.
     */
    public function getLightness(): float
    {
        return $this->lightness;
    }

    /**
     * Get the saturation value.
     *
     * @return float The saturation value.
     */
    public function getSaturation(): float
    {
        return $this->saturation;
    }

    /**
     * Get the color components as an array.
     *
     * @return array The color components.
     */
    public function toArray(): array
    {
        return [
            'hue' => $this->hue,
            'saturation' => $this->saturation,
            'lightness' => $this->lightness,
            'alpha' => $this->alpha,
        ];
    }

    /**
     * Convert the Color to Hsl.
     *
     * @return Hsl The Hsl Color.
     */
    public function toHsl(): Hsl
    {
        return $this;
    }

    /**
     * Convert the Color to Srgb.
     *
     * @return Srgb The Srgb Color.
     */
    public function toSrgb(): Srgb
    {
        [$r, $g, $b] = ColorConverter::hslToSrgb($this->hue, $this->saturation / 100, $this->lightness / 100);

        return new Srgb($r, $g, $b, $this->alpha);
    }

    /**
     * Convert the Color to SrgbLinear.
     *
     * @return SrgbLinear The SrgbLinear Color.
     */
    public function toSrgbLinear(): SrgbLinear
    {
        return $this->toSrgb()->toSrgbLinear();
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

        $result = 'hsl('.
            round($this->hue, $precision).'deg '.
            round($this->saturation, $precision).'% '.
            round($this->lightness, $precision).'%';

        if ($alpha) {
            $result .= ' / '.round($this->alpha * 100, max(0, $precision - 2)).'%';
        }

        $result .= ')';

        return $result;
    }

    /**
     * Clone the Color with a new hue value.
     *
     * @param float $hue The hue value.
     * @return Color A new Color.
     */
    public function withHue(float $hue): static
    {
        return new static($hue, $this->saturation, $this->lightness, $this->alpha);
    }

    /**
     * Clone the Color with a new lightness value.
     *
     * @param float $lightness The lightness value.
     * @return Color A new Color.
     */
    public function withLightness(float $lightness): static
    {
        return new static($this->hue, $this->saturation, $lightness, $this->alpha);
    }

    /**
     * Clone the Color with a new saturation value.
     *
     * @param float $saturation The saturation value.
     * @return Color A new Color.
     */
    public function withSaturation(float $saturation): static
    {
        return new static($this->hue, $saturation, $this->lightness, $this->alpha);
    }
}
