<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

use function round;
use function sprintf;

/**
 * UtilityTrait
 */
trait UtilityTrait
{
    /**
     * Get the hex string of the Colour.
     *
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
     *
     * @return array The HSL values.
     */
    protected function getHSL(): array
    {
        return static::RGB2HSL($this->r, $this->g, $this->b);
    }

    /**
     * Get the HSV values of the Colour.
     *
     * @return array The HSV values.
     */
    protected function getHSV(): array
    {
        return static::RGB2HSV($this->r, $this->g, $this->b);
    }
}
