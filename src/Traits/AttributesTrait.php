<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

/**
 * AttributesTrait
 */
trait AttributesTrait
{
    /**
     * Get the alpha value of the color.
     *
     * @return float|int The alpha value. (0, 1)
     */
    public function getAlpha(): float|int
    {
        return $this->a;
    }

    /**
     * Get the brightness value of the color.
     *
     * @return float|int The brightness value. (0, 100)
     */
    public function getBrightness(): float|int
    {
        return $this->getHSV()[2];
    }

    /**
     * Get the hue value of the color.
     *
     * @return float|int The hue value. (0, 360)
     */
    public function getHue(): float|int
    {
        return $this->getHSV()[0];
    }

    /**
     * Get the saturation value of the color.
     *
     * @return float|int The saturation value. (0, 100)
     */
    public function getSaturation(): float|int
    {
        return $this->getHSV()[1];
    }

    /**
     * Get the relative luminance value of the color
     *
     * @return float The relative luminance value. (0, 1)
     */
    public function luma(): float
    {
        return static::RGB2Luma($this->r, $this->g, $this->b);
    }

    /**
     * Set the alpha value of the color.
     *
     * @param float|int $a The alpha value. (0, 1)
     * @return Color A new Color.
     */
    public function setAlpha(float|int $a): static
    {
        return new static($this->r, $this->g, $this->b, $a);
    }

    /**
     * Set the brightness value of the color.
     *
     * @param float|int $v The brightness value. (0, 100)
     * @return Color A new Color.
     */
    public function setBrightness(float|int $v): static
    {
        [$h, $s, $_] = $this->getHSV();
        [$r, $g, $b] = static::HSV2RGB($h, $s, $v);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Set the hue value of the color.
     *
     * @param float|int $h The hue value. (0, 360)
     * @return Color A new Color.
     */
    public function setHue(float|int $h): static
    {
        [$_, $s, $v] = $this->getHSV();
        [$r, $g, $b] = static::HSV2RGB($h, $s, $v);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Set the saturation value of the color.
     *
     * @param float|int $s The saturation value. (0, 100)
     * @return Color A new Color.
     */
    public function setSaturation(float|int $s): static
    {
        [$h, $_, $v] = $this->getHSV();
        [$r, $g, $b] = static::HSV2RGB($h, $s, $v);

        return new static($r, $g, $b, $this->a);
    }
}
