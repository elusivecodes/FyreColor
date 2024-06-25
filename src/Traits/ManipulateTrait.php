<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

/**
 * ManipulateTrait
 */
trait ManipulateTrait
{
    /**
     * Darken the color by a specified amount.
     *
     * @param int|float $amount The amount to darken the color by. (0, 1)
     * @return Color A new Color.
     */
    public function darken(float|int $amount): static
    {
        [$h, $s, $l] = $this->getHSL();
        $l -= $l * $amount;
        [$r, $g, $b] = static::HSL2RGB($h, $s, $l);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Invert the color.
     *
     * @return Color A new Color.
     */
    public function invert(): static
    {
        return new static(
            255 - $this->r,
            255 - $this->g,
            255 - $this->b,
            $this->a
        );
    }

    /**
     * Lighten the color by a specified amount.
     *
     * @param int|float $amount The amount to lighten the color by. (0, 1)
     * @return Color A new Color.
     */
    public function lighten(float|int $amount): static
    {
        [$h, $s, $l] = $this->getHSL();
        $l += (100 - $l) * $amount;
        [$r, $g, $b] = static::HSL2RGB($h, $s, $l);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Shade the color by a specified amount.
     *
     * @param int|float $amount The amount to shade the color by. (0, 1)
     * @return Color A new Color.
     */
    public function shade(float|int $amount): static
    {
        $color = static::mix($this, new static(0), $amount);

        return new static(
            $color->r,
            $color->g,
            $color->b,
            $this->a
        );
    }

    /**
     * Tint the color by a specified amount.
     *
     * @param int|float $amount The amount to tint the color by. (0, 1)
     * @return Color A new Color.
     */
    public function tint(float|int $amount): static
    {
        $color = static::mix($this, new static(100), $amount);

        return new static(
            $color->r,
            $color->g,
            $color->b,
            $this->a
        );
    }

    /**
     * Tone the color by a specified amount.
     *
     * @param int|float $amount The amount to tone the color by. (0, 1)
     * @return Color A new Color.
     */
    public function tone(float|int $amount): static
    {
        $color = static::mix($this, new static(50), $amount);

        return new static(
            $color->r,
            $color->g,
            $color->b,
            $this->a
        );
    }
}
