<?php
declare(strict_types=1);

namespace Fyre\Color;

use Fyre\Color\Traits\AttributesTrait;
use Fyre\Color\Traits\ConversionTrait;
use Fyre\Color\Traits\CreateTrait;
use Fyre\Color\Traits\ManipulateTrait;
use Fyre\Color\Traits\OutputTrait;
use Fyre\Color\Traits\PaletteTrait;
use Fyre\Color\Traits\SchemesTrait;
use Fyre\Color\Traits\StaticTrait;
use Fyre\Color\Traits\UtilityTrait;

use function round;

/**
 * Color
 */
class Color
{
    use AttributesTrait;
    use ConversionTrait;
    use CreateTrait;
    use ManipulateTrait;
    use OutputTrait;
    use PaletteTrait;
    use SchemesTrait;
    use StaticTrait;
    use UtilityTrait;

    protected float $a;

    protected float $b;

    protected float $g;

    protected float $r;

    /**
     * New Color constructor.
     *
     * @param float|int $r The red value, or the brightness value.
     * @param float|int $g The green value or the alpha value.
     * @param float|int $a The alpha value.
     * @param float|int|null $g The blue value.
     */
    public function __construct(float|int $r = 0, float|int $g = 1, float|int|null $b = null, float|int $a = 1)
    {
        if ($b === null) {
            $a = $g;
            $b = $g = $r = round($r * 2.55, 2);
        }

        $this->r = static::clamp($r, 0, 255);
        $this->g = static::clamp($g, 0, 255);
        $this->b = static::clamp($b, 0, 255);
        $this->a = static::clamp($a, 0, 1);
    }
}
