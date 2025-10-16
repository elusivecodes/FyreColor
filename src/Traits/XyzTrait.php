<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

/**
 * XyzTrait
 */
trait XyzTrait
{
    public readonly float $x;

    public readonly float $y;

    public readonly float $z;

    /**
     * New Xyz color constructor.
     *
     * @param float $x The x value. (0, 1)
     * @param float $y The y value. (0, 1)
     * @param float $z The z value. (0, 1)
     * @param float $alpha The alpha value. (0, 1)
     */
    public function __construct(
        float $x = 0,
        float $y = 0,
        float $z = 0,
        float $alpha = 1,
    ) {
        $this->x = static::clamp($x);
        $this->y = static::clamp($y);
        $this->z = static::clamp($z, max: 1.1);
        $this->alpha = static::clamp($alpha);
    }

    /**
     * Get the x value.
     *
     * @return float The x value.
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * Get the y value.
     *
     * @return float The y value.
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * Get the z value.
     *
     * @return float The z value.
     */
    public function getZ(): float
    {
        return $this->z;
    }

    /**
     * Get the color components as an array.
     *
     * @return array The color components.
     */
    public function toArray(): array
    {
        return [
            'x' => $this->x,
            'y' => $this->y,
            'z' => $this->z,
            'alpha' => $this->alpha,
        ];
    }

    /**
     * Clone the Color with a new x value.
     *
     * @param float $x The x value.
     * @return Color A new Color.
     */
    public function withX(float $x): static
    {
        return new static($x, $this->y, $this->z, $this->alpha);
    }

    /**
     * Clone the Color with a new y value.
     *
     * @param float $y The y value.
     * @return Color A new Color.
     */
    public function withY(float $y): static
    {
        return new static($this->x, $y, $this->z, $this->alpha);
    }

    /**
     * Clone the Color with a new z value.
     *
     * @param float $z The z value.
     * @return Color A new Color.
     */
    public function withZ(float $z): static
    {
        return new static($this->x, $this->y, $z, $this->alpha);
    }
}
