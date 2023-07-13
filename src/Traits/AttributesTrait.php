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
     * @return int|float The alpha value. (0, 1)
     */
    public function getAlpha(): int|float
    {
        return $this->a;
    }

    /**
     * Get the brightness value of the color.
     * @return int|float The brightness value. (0, 100)
     */
    public function getBrightness(): int|float
    {
        return $this->getHSV()[2];
    }

    /**
     * Get the hue value of the color.
     * @return int|float The hue value. (0, 360)
     */
    public function getHue(): int|float
    {
        return $this->getHSV()[0];
    }

    /**
     * Get the saturation value of the color.
     * @return int|float The saturation value. (0, 100)
     */
    public function getSaturation(): int|float
    {
        return $this->getHSV()[1];
    }

    /**
     * Get the relative luminance value of the color 
     * @return float The relative luminance value. (0, 1)
     */
    public function luma(): float
    {
        return static::RGB2Luma($this->r, $this->g, $this->b);
    }

    /**
     * Set the alpha value of the color.
     * @param int|float $a The alpha value. (0, 1)
     * @return Color A new Color object.
     */
    public function setAlpha(int|float $a): static
    {
        return new static($this->r, $this->g, $this->b, $a);
    }

    /**
     * Set the brightness value of the color.
     * @param int|float $v The brightness value. (0, 100)
     * @return Color A new Color object.
     */
    public function setBrightness(int|float $v): static
    {
        [$h, $s, $_] = $this->getHSV();
        [$r, $g, $b] = static::HSV2RGB($h, $s, $v);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Set the hue value of the color.
     * @param int|float $h The hue value. (0, 360)
     * @return Color A new Color object.
     */
    public function setHue(int|float $h): static
    {
        [$_, $s, $v] = $this->getHSV();
        [$r, $g, $b] = static::HSV2RGB($h, $s, $v);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Set the saturation value of the color.
     * @param int|float $s The saturation value. (0, 100)
     * @return Color A new Color object.
     */
    public function setSaturation(int|float $s): static
    {
        [$h, $_, $v] = $this->getHSV();
        [$r, $g, $b] = static::HSV2RGB($h, $s, $v);

        return new static($r, $g, $b, $this->a);
    }

}
