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

    protected float $r;
    protected float $g;
    protected float $b;
    protected float $a;

    use AttributesTrait;
    use ConversionTrait;
    use CreateTrait;
    use ManipulateTrait;
    use OutputTrait;
    use PaletteTrait;
    use SchemesTrait;
    use StaticTrait;
    use UtilityTrait;

    /**
     * New Color constructor.
     * @param int|float $r The red value, or the brightness value.
     * @param int|float $g The green value or the alpha value.
     * @param int|float|null $g The blue value.
     * @param int|float $a The alpha value.
     */
    public function __construct(int|float $r = 0, int|float $g = 1, int|float|null $b = null, int|float $a = 1)
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
