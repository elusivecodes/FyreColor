<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

/**
 * LchTrait
 */
trait LchTrait
{
    public readonly float $chroma;

    public readonly float $hue;

    public readonly float $lightness;

    /**
     * Get the chroma value.
     *
     * @return float The chroma value.
     */
    public function getChroma(): float
    {
        return $this->chroma;
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
     * Get the color components as an array.
     *
     * @return array The color components.
     */
    public function toArray(): array
    {
        return [
            'lightness' => $this->lightness,
            'chroma' => $this->chroma,
            'hue' => $this->hue,
            'alpha' => $this->alpha,
        ];
    }

    /**
     * Clone the Color with a new chroma value.
     *
     * @param float $chroma The chroma value.
     * @return Color A new Color.
     */
    public function withChroma(float $chroma): static
    {
        return new static($this->lightness, $chroma, $this->hue, $this->alpha);
    }

    /**
     * Clone the Color with a new hue value.
     *
     * @param float $hue The hue value.
     * @return Color A new Color.
     */
    public function withHue(float $hue): static
    {
        return new static($this->lightness, $this->chroma, $hue, $this->alpha);
    }

    /**
     * Clone the Color with a new lightness value.
     *
     * @param float $lightness The lightness value.
     * @return Color A new Color.
     */
    public function withLightness(float $lightness): static
    {
        return new static($lightness, $this->chroma, $this->hue, $this->alpha);
    }
}
