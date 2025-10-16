<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

/**
 * LabTrait
 */
trait LabTrait
{
    public readonly float $a;

    public readonly float $b;

    public readonly float $lightness;

    /**
     * Get the a value.
     *
     * @return float The a value.
     */
    public function getA(): float
    {
        return $this->a;
    }

    /**
     * Get the b value.
     *
     * @return float The b value.
     */
    public function getB(): float
    {
        return $this->b;
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
            'a' => $this->a,
            'b' => $this->b,
            'alpha' => $this->alpha,
        ];
    }

    /**
     * Clone the Color with a new a value.
     *
     * @param float $a The a value.
     * @return Color A new Color.
     */
    public function withA(float $a): static
    {
        return new static($this->lightness, $a, $this->b, $this->alpha);
    }

    /**
     * Clone the Color with a new b value.
     *
     * @param float $b The b value.
     * @return Color A new Color.
     */
    public function withB(float $b): static
    {
        return new static($this->lightness, $this->a, $b, $this->alpha);
    }

    /**
     * Clone the Color with a new lightness value.
     *
     * @param float $lightness The lightness value.
     * @return Color A new Color.
     */
    public function withLightness(float $lightness): static
    {
        return new static($lightness, $this->a, $this->b, $this->alpha);
    }
}
