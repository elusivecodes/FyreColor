<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

use function
    round,
    sprintf;

/**
 * UtilityTrait
 */
trait UtilityTrait
{

    /**
     * Clone the Color.
     * @return Color A new Color object.
     */
    public function clone(): static
    {
        return new static($this->r, $this->g, $this->b, $this->a);
    }

    /**
     * Get the hex string of the Colour.
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
     * @return array The HSL values.
     */
    protected function getHSL(): array
    {
        return static::RGB2HSL($this->r, $this->g, $this->b);
    }

    /**
     * Get the HSV values of the Colour.
     * @return array The HSV values.
     */
    protected function getHSV(): array
    {
        return static::RGB2HSV($this->r, $this->g, $this->b);
    }

    /**
     * Set the RGBA values of the Color.
     * @param int|float $r The red value.
     * @param int|float $g The green value.
     * @param int|float $b The blue value.
     * @param int|float $a The alpha value.
     * @return Color The Color object.
     */
    protected function setColor(int|float $r, int|float $g, int|float $b, int|float $a): static
    {
        $this->r = static::clamp($r, 0, 255);
        $this->g = static::clamp($g, 0, 255);
        $this->b = static::clamp($b, 0, 255);
        $this->a = static::clamp($a, 0, 1);

        return $this;
    }

}
