<?php
declare(strict_types=1);

namespace Fyre\Color\Traits;

/**
 * SchemesTrait
 */
trait SchemesTrait
{
    /**
     * Create an array with 2 analogous color variations.
     *
     * @return array An array containing 2 analogous color variations.
     */
    public function analogous(): array
    {
        [$h, $s, $v] = static::RGB2HSV($this->r, $this->g, $this->b);
        [$r1, $g1, $b1] = static::HSV2RGB($h + 30, $s, $v);
        [$r2, $g2, $b2] = static::HSV2RGB($h - 30, $s, $v);

        return [
            new static($r1, $g1, $b1, $this->a),
            new static($r2, $g2, $b2, $this->a),
        ];
    }

    /**
     * Create a complementary color variation.
     *
     * @return Color A complementary color variation.
     */
    public function complementary(): static
    {
        [$h, $s, $v] = static::RGB2HSV($this->r, $this->g, $this->b);
        [$r, $g, $b] = static::HSV2RGB($h + 180, $s, $v);

        return new static($r, $g, $b, $this->a);
    }

    /**
     * Create an array with 2 split color variations.
     *
     * @return array An array containing 2 split color variations.
     */
    public function split(): array
    {
        [$h, $s, $v] = static::RGB2HSV($this->r, $this->g, $this->b);
        [$r1, $g1, $b1] = static::HSV2RGB($h + 150, $s, $v);
        [$r2, $g2, $b2] = static::HSV2RGB($h - 150, $s, $v);

        return [
            new static($r1, $g1, $b1, $this->a),
            new static($r2, $g2, $b2, $this->a),
        ];
    }

    /**
     * Create an array with 3 tetradic color variations.
     *
     * @return array An array containing 3 tetradic color variations.
     */
    public function tetradic(): array
    {
        [$h, $s, $v] = static::RGB2HSV($this->r, $this->g, $this->b);
        [$r1, $g1, $b1] = static::HSV2RGB($h + 60, $s, $v);
        [$r2, $g2, $b2] = static::HSV2RGB($h + 180, $s, $v);
        [$r3, $g3, $b3] = static::HSV2RGB($h - 120, $s, $v);

        return [
            new static($r1, $g1, $b1, $this->a),
            new static($r2, $g2, $b2, $this->a),
            new static($r3, $g3, $b3, $this->a),
        ];
    }

    /**
     * Create an array with 2 triadic color variations.
     *
     * @return array An array containing 2 triadic color variations.
     */
    public function triadic(): array
    {
        [$h, $s, $v] = static::RGB2HSV($this->r, $this->g, $this->b);
        [$r1, $g1, $b1] = static::HSV2RGB($h + 120, $s, $v);
        [$r2, $g2, $b2] = static::HSV2RGB($h - 120, $s, $v);

        return [
            new static($r1, $g1, $b1, $this->a),
            new static($r2, $g2, $b2, $this->a),
        ];
    }
}
