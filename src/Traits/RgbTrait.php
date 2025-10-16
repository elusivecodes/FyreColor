<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

/**
 * RgbTrait
 */
trait RgbTrait
{
    public readonly float $blue;

    public readonly float $green;

    public readonly float $red;

    /**
     * New Rgb color constructor.
     *
     * @param float $red The red value. (0, 1)
     * @param float $green The green value. (0, 1)
     * @param float $blue The blue value. (0, 1)
     * @param float $alpha The alpha value. (0, 1)
     */
    public function __construct(
        float $red = 0,
        float $green = 0,
        float $blue = 0,
        float $alpha = 1,
    ) {
        $this->red = static::clamp($red);
        $this->green = static::clamp($green);
        $this->blue = static::clamp($blue);
        $this->alpha = static::clamp($alpha);
    }

    /**
     * Get the blue value.
     *
     * @return float The blue value.
     */
    public function getBlue(): float
    {
        return $this->blue;
    }

    /**
     * Get the green value.
     *
     * @return float The green value.
     */
    public function getGreen(): float
    {
        return $this->green;
    }

    /**
     * Get the red value.
     *
     * @return float The red value.
     */
    public function getRed(): float
    {
        return $this->red;
    }

    /**
     * Get the color components as an array.
     *
     * @return array The color components.
     */
    public function toArray(): array
    {
        return [
            'red' => $this->red,
            'green' => $this->green,
            'blue' => $this->blue,
            'alpha' => $this->alpha,
        ];
    }

    /**
     * Clone the Color with a new blue value.
     *
     * @param float $blue The blue value.
     * @return Color A new Color.
     */
    public function withBlue(float $blue): static
    {
        return new static($this->red, $this->green, $blue, $this->alpha);
    }

    /**
     * Clone the Color with a new green value.
     *
     * @param float $green The green value.
     * @return Color A new Color.
     */
    public function withGreen(float $green): static
    {
        return new static($this->red, $green, $this->blue, $this->alpha);
    }

    /**
     * Clone the Color with a new red value.
     *
     * @param float $red The red value.
     * @return Color A new Color.
     */
    public function withRed(float $red): static
    {
        return new static($red, $this->green, $this->blue, $this->alpha);
    }
}
