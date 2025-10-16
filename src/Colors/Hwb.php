<?php
declare(strict_types=1);

namespace Fyre\Color\Colors;

use Fyre\Color\Color;
use Fyre\Color\ColorConverter;

use function max;
use function round;

/**
 * Hwb
 */
class Hwb extends Color
{
    protected const COLOR_SPACE = 'hwb';

    public readonly float $blackness;

    public readonly float $hue;

    public readonly float $whiteness;

    /**
     * New Hwb constructor.
     *
     * @param float $hue The hue value. (0, 360)
     * @param float $whiteness The whiteness value. (0, 100)
     * @param float $blackness The blackness value. (0, 100)
     * @param float $alpha The alpha value. (0, 1)
     */
    public function __construct(
        float $hue = 0,
        float $whiteness = 0,
        float $blackness = 0,
        float $alpha = 1,
    ) {
        $this->hue = static::clampHue($hue);
        $this->whiteness = static::clamp($whiteness, max: 100);
        $this->blackness = static::clamp($blackness, max: 100);
        $this->alpha = static::clamp($alpha);
    }

    /**
     * Get the blackness value.
     *
     * @return float The blackness value.
     */
    public function getBlackness(): float
    {
        return $this->blackness;
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
     * Get the whiteness value.
     *
     * @return float The whiteness value.
     */
    public function getWhiteness(): float
    {
        return $this->whiteness;
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
            'whiteness' => $this->whiteness,
            'blackness' => $this->blackness,
            'alpha' => $this->alpha,
        ];
    }

    public function toHwb(): Hwb
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
        [$r, $g, $b] = ColorConverter::hwbToSrgb($this->hue, $this->whiteness / 100, $this->blackness / 100);

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

        $result = 'hwb('.
            round($this->hue, $precision).'deg '.
            round($this->whiteness, $precision).'% '.
            round($this->blackness, $precision).'%';

        if ($alpha) {
            $result .= ' / '.round($this->alpha * 100, max(0, $precision - 2)).'%';
        }

        $result .= ')';

        return $result;
    }

    /**
     * Clone the Color with a new blackness value.
     *
     * @param float $blackness The blackness value.
     * @return Color A new Color.
     */
    public function withBlackness(float $blackness): static
    {
        return new static($this->hue, $this->whiteness, $blackness, $this->alpha);
    }

    /**
     * Clone the Color with a new hue value.
     *
     * @param float $hue The hue value.
     * @return Color A new Color.
     */
    public function withHue(float $hue): static
    {
        return new static($hue, $this->whiteness, $this->blackness, $this->alpha);
    }

    /**
     * Clone the Color with a new whiteness value.
     *
     * @param float $whiteness The whiteness value.
     * @return Color A new Color.
     */
    public function withWhiteness(float $whiteness): static
    {
        return new static($this->hue, $whiteness, $this->blackness, $this->alpha);
    }
}
