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
     * @param int|float $amount The amount to darken the color by. (0, 1)
     * @return Color The darkened Color object.
     */
    public function darken(int|float $amount): static
    {
        [$h, $s, $l] = $this->getHSL();
        $l -= $l * $amount;
        [$r, $g, $b] = static::HSL2RGB($h, $s, $l);

        return $this->setColor($r, $g, $b, $this->a);
    }

    /**
     * Invert the color.
     * @return Color The inverted Color object.
     */
    public function invert(): static
    {
        return $this->setColor(
            255 - $this->r,
            255 - $this->g,
            255 - $this->b,
            $this->a
        );
    }

    /**
     * Lighten the color by a specified amount.
     * @param int|float $amount The amount to lighten the color by. (0, 1)
     * @return Color The lightened Color object.
     */
    public function lighten(int|float $amount): static
    {
        [$h, $s, $l] = $this->getHSL();
        $l += (100 - $l) * $amount;
        [$r, $g, $b] = static::HSL2RGB($h, $s, $l);

        return $this->setColor($r, $g, $b, $this->a);
    }

    /**
     * Shade the color by a specified amount.
     * @param int|float $amount The amount to shade the color by. (0, 1)
     * @return Color The shaded Color object.
     */
    public function shade(int|float $amount): static
    {
        $color = static::mix($this, new static(0), $amount);

        return $this->setColor(
            $color->r,
            $color->g,
            $color->b,
            $this->a
        );
    }

    /**
     * Tint the color by a specified amount.
     * @param int|float $amount The amount to tint the color by. (0, 1)
     * @return Color The tinted Color object.
     */
    public function tint(int|float $amount): static
    {
        $color = static::mix($this, new static(100), $amount);

        return $this->setColor(
            $color->r,
            $color->g,
            $color->b,
            $this->a
        );
    }

    /**
     * Tone the color by a specified amount.
     * @param int|float $amount The amount to tone the color by. (0, 1)
     * @return Color The toned Color object.
     */
    public function tone(int|float $amount): static
    {
        $color = static::mix($this, new static(50), $amount);

        return $this->setColor(
            $color->r,
            $color->g,
            $color->b,
            $this->a
        );
    }

}
