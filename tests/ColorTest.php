<?php
declare(strict_types=1);

namespace Tests;

use Fyre\Color\Color;
use Fyre\Color\Colors\A98Rgb;
use Fyre\Color\Colors\DisplayP3;
use Fyre\Color\Colors\DisplayP3Linear;
use Fyre\Color\Colors\Hsl;
use Fyre\Color\Colors\Hwb;
use Fyre\Color\Colors\Lab;
use Fyre\Color\Colors\Lch;
use Fyre\Color\Colors\OkLab;
use Fyre\Color\Colors\OkLch;
use Fyre\Color\Colors\ProPhotoRgb;
use Fyre\Color\Colors\Rec2020;
use Fyre\Color\Colors\Rgb;
use Fyre\Color\Colors\Srgb;
use Fyre\Color\Colors\SrgbLinear;
use Fyre\Color\Colors\XyzD50;
use Fyre\Color\Colors\XyzD65;
use Fyre\Utility\Traits\MacroTrait;
use Fyre\Utility\Traits\StaticMacroTrait;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

use function array_diff;
use function class_uses;

final class ColorTest extends TestCase
{
    public function testCreateFromA98Rgb(): void
    {
        $color = Color::createFromA98Rgb(0.9, 0.9, 0.98);

        $this->assertInstanceOf(A98Rgb::class, $color);
        $this->assertSame('color(a98-rgb 0.9 0.9 0.98)', $color->toString());
    }

    public function testCreateFromDisplayP3(): void
    {
        $color = Color::createFromDisplayP3(0.9, 0.9, 0.97);

        $this->assertInstanceOf(DisplayP3::class, $color);
        $this->assertSame('color(display-p3 0.9 0.9 0.97)', $color->toString());
    }

    public function testCreateFromDisplayP3Linear(): void
    {
        $color = Color::createFromDisplayP3Linear(0.79, 0.79, 0.94);

        $this->assertInstanceOf(DisplayP3Linear::class, $color);
        $this->assertSame('color(display-p3-linear 0.79 0.79 0.94)', $color->toString());
    }

    public function testCreateFromHsl(): void
    {
        $color = Color::createFromHsl(240, 66.67, 94.12);

        $this->assertInstanceOf(Hsl::class, $color);
        $this->assertSame('hsl(240deg 66.67% 94.12%)', $color->toString());
    }

    public function testCreateFromHwb(): void
    {
        $color = Color::createFromHwb(120, 90.2, 1.96);

        $this->assertInstanceOf(Hwb::class, $color);
        $this->assertSame('hwb(120deg 90.2% 1.96%)', $color->toString());
    }

    public function testCreateFromLab(): void
    {
        $color = Color::createFromLab(91.74, 2.78, -9.72);

        $this->assertInstanceOf(Lab::class, $color);
        $this->assertSame('lab(91.74 2.78 -9.72)', $color->toString());
    }

    public function testCreateFromLch(): void
    {
        $color = Color::createFromLch(91.74, 10.11, 285.93);

        $this->assertInstanceOf(Lch::class, $color);
        $this->assertSame('lch(91.74 10.11 285.93)', $color->toString());
    }

    public function testCreateFromOkLab(): void
    {
        $color = Color::createFromOkLab(0.93, 0.01, -0.03);

        $this->assertInstanceOf(OkLab::class, $color);
        $this->assertSame('oklab(0.93 0.01 -0.03)', $color->toString());
    }

    public function testCreateFromOkLch(): void
    {
        $color = Color::createFromOkLch(0.93, 0.03, 285.8);

        $this->assertInstanceOf(OkLch::class, $color);
        $this->assertSame('oklch(0.93 0.03 285.8)', $color->toString());
    }

    public function testCreateFromProPhotoRgb(): void
    {
        $color = Color::createFromProPhotoRgb(0.89, 0.88, 0.96);

        $this->assertInstanceOf(ProPhotoRgb::class, $color);
        $this->assertSame('color(prophoto-rgb 0.89 0.88 0.96)', $color->toString());
    }

    public function testCreateFromRec2020(): void
    {
        $color = Color::createFromRec2020(0.89, 0.89, 0.97);

        $this->assertInstanceOf(Rec2020::class, $color);
        $this->assertSame('color(rec2020 0.89 0.89 0.97)', $color->toString());
    }

    public function testCreateFromRgb(): void
    {
        $color = Color::createFromRgb(230, 230, 250);

        $this->assertInstanceOf(Rgb::class, $color);
        $this->assertSame('rgb(230 230 250)', $color->toString());
    }

    public function testCreateFromSrgb(): void
    {
        $color = Color::createFromSrgb(0.9, 0.9, 0.98);

        $this->assertInstanceOf(Srgb::class, $color);
        $this->assertSame('color(srgb 0.9 0.9 0.98)', $color->toString());
    }

    public function testCreateFromSrgbLinear(): void
    {
        $color = Color::createFromSrgbLinear(0.79, 0.79, 0.96);

        $this->assertInstanceOf(SrgbLinear::class, $color);
        $this->assertSame('color(srgb-linear 0.79 0.79 0.96)', $color->toString());
    }

    public function testCreateFromStringA98Rgb(): void
    {
        $color = Color::createFromString('color(a98-rgb 0.9 0.9 0.98)');

        $this->assertInstanceOf(A98Rgb::class, $color);
        $this->assertSame('color(a98-rgb 0.9 0.9 0.98)', $color->toString());
    }

    public function testCreateFromStringA98RgbPercent(): void
    {
        $color = Color::createFromString('color(a98-rgb 90% 90% 98%)');

        $this->assertInstanceOf(A98Rgb::class, $color);
        $this->assertSame('color(a98-rgb 0.9 0.9 0.98)', $color->toString());
    }

    public function testCreateFromStringDisplayP3(): void
    {
        $color = Color::createFromString('color(display-p3 0.9 0.9 0.97)');

        $this->assertInstanceOf(DisplayP3::class, $color);
        $this->assertSame('color(display-p3 0.9 0.9 0.97)', $color->toString());
    }

    public function testCreateFromStringDisplayP3Linear(): void
    {
        $color = Color::createFromString('color(display-p3-linear 0.79 0.79 0.94)');

        $this->assertInstanceOf(DisplayP3Linear::class, $color);
        $this->assertSame('color(display-p3-linear 0.79 0.79 0.94)', $color->toString());
    }

    public function testCreateFromStringDisplayP3LinearPercent(): void
    {
        $color = Color::createFromString('color(display-p3-linear 79% 79% 94%)');

        $this->assertInstanceOf(DisplayP3Linear::class, $color);
        $this->assertSame('color(display-p3-linear 0.79 0.79 0.94)', $color->toString());
    }

    public function testCreateFromStringDisplayP3Percent(): void
    {
        $color = Color::createFromString('color(display-p3 90% 90% 97%)');

        $this->assertInstanceOf(DisplayP3::class, $color);
        $this->assertSame('color(display-p3 0.9 0.9 0.97)', $color->toString());
    }

    public function testCreateFromStringHex(): void
    {
        $color = Color::createFromString('#e6e6fa');

        $this->assertInstanceOf(Rgb::class, $color);
        $this->assertSame('#e6e6fa', $color->toString());
    }

    public function testCreateFromStringHexShort(): void
    {
        $color = Color::createFromString('#f00');

        $this->assertInstanceOf(Rgb::class, $color);
        $this->assertSame('#f00', $color->toString());
    }

    public function testCreateFromStringHexShortWithAlpha(): void
    {
        $color = Color::createFromString('#f008');

        $this->assertInstanceOf(Rgb::class, $color);
        $this->assertSame('#f008', $color->toString());
    }

    public function testCreateFromStringHexWithAlpha(): void
    {
        $color = Color::createFromString('#e6e6fa80');

        $this->assertInstanceOf(Rgb::class, $color);
        $this->assertSame('#e6e6fa80', $color->toString());
    }

    public function testCreateFromStringHsl(): void
    {
        $color = Color::createFromString('hsl(240deg 66.67% 94.12%)');

        $this->assertInstanceOf(Hsl::class, $color);
        $this->assertSame('hsl(240deg 66.67% 94.12%)', $color->toString());
    }

    public function testCreateFromStringHslLegacy(): void
    {
        $color = Color::createFromString('hsl(240, 66.67%, 94.12%)');

        $this->assertInstanceOf(Hsl::class, $color);
        $this->assertSame('hsl(240deg 66.67% 94.12%)', $color->toString());
    }

    public function testCreateFromStringHslLegacyWithAlpha(): void
    {
        $color = Color::createFromString('hsla(240, 66.67%, 94.12%, 0.5)');

        $this->assertInstanceOf(Hsl::class, $color);
        $this->assertSame('hsl(240deg 66.67% 94.12% / 50%)', $color->toString());
    }

    public function testCreateFromStringHslPercent(): void
    {
        $color = Color::createFromString('hsl(66.667% 66.67% 94.12%)');

        $this->assertInstanceOf(Hsl::class, $color);
        $this->assertSame('hsl(240deg 66.67% 94.12%)', $color->toString());
    }

    public function testCreateFromStringHslPercentAlpha(): void
    {
        $color = Color::createFromString('hsl(240deg 66.67% 94.12% / 50%)');

        $this->assertInstanceOf(Hsl::class, $color);
        $this->assertSame('hsl(240deg 66.67% 94.12% / 50%)', $color->toString());
    }

    public function testCreateFromStringHslRad(): void
    {
        $color = Color::createFromString('hsl(4.18879rad 66.67% 94.12%)');

        $this->assertInstanceOf(Hsl::class, $color);
        $this->assertSame('hsl(240deg 66.67% 94.12%)', $color->toString());
    }

    public function testCreateFromStringHslTurn(): void
    {
        $color = Color::createFromString('hsl(0.66667turn 66.67% 94.12%)');

        $this->assertInstanceOf(Hsl::class, $color);
        $this->assertSame('hsl(240deg 66.67% 94.12%)', $color->toString());
    }

    public function testCreateFromStringHslWithAlpha(): void
    {
        $color = Color::createFromString('hsl(240deg 66.67% 94.12% / 50%)');

        $this->assertInstanceOf(Hsl::class, $color);
        $this->assertSame('hsl(240deg 66.67% 94.12% / 50%)', $color->toString());
    }

    public function testCreateFromStringHwb(): void
    {
        $color = Color::createFromString('hwb(240deg 90.2% 1.96%)');

        $this->assertInstanceOf(Hwb::class, $color);
        $this->assertSame('hwb(240deg 90.2% 1.96%)', $color->toString());
    }

    public function testCreateFromStringHwbLegacy(): void
    {
        $color = Color::createFromString('hwb(240, 90.2%, 1.96%)');

        $this->assertInstanceOf(Hwb::class, $color);
        $this->assertSame('hwb(240deg 90.2% 1.96%)', $color->toString());
    }

    public function testCreateFromStringHwbWithAlpha(): void
    {
        $color = Color::createFromString('hwb(240deg 90.2% 1.96% / 0.5)');

        $this->assertInstanceOf(Hwb::class, $color);
        $this->assertSame('hwb(240deg 90.2% 1.96% / 50%)', $color->toString());
    }

    public function testCreateFromStringInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Color::createFromString('invalid');
    }

    public function testCreateFromStringLab(): void
    {
        $color = Color::createFromString('lab(91.74 2.78 -9.72)');

        $this->assertInstanceOf(Lab::class, $color);
        $this->assertSame('lab(91.74 2.78 -9.72)', $color->toString());
    }

    public function testCreateFromStringLabPercent(): void
    {
        $color = Color::createFromString('lab(91.74% 2.224% -7.776%)');

        $this->assertInstanceOf(Lab::class, $color);
        $this->assertSame('lab(91.74 2.78 -9.72)', $color->toString());
    }

    public function testCreateFromStringLch(): void
    {
        $color = Color::createFromString('lch(91.74 10.11 285.93)');

        $this->assertInstanceOf(Lch::class, $color);
        $this->assertSame('lch(91.74 10.11 285.93)', $color->toString());
    }

    public function testCreateFromStringLchPercent(): void
    {
        $color = Color::createFromString('lch(91.74% 6.74% 285.93)');

        $this->assertInstanceOf(Lch::class, $color);
        $this->assertSame('lch(91.74 10.11 285.93)', $color->toString());
    }

    public function testCreateFromStringName(): void
    {
        $color = Color::createFromString('red');

        $this->assertInstanceOf(Rgb::class, $color);
        $this->assertSame('#f00', $color->toString());
    }

    public function testCreateFromStringOkLab(): void
    {
        $color = Color::createFromString('oklab(0.93 0.01 -0.03)');

        $this->assertInstanceOf(OkLab::class, $color);
        $this->assertSame('oklab(0.93 0.01 -0.03)', $color->toString());
    }

    public function testCreateFromStringOkLabPercent(): void
    {
        $color = Color::createFromString('oklab(93% 25% -75%)');

        $this->assertInstanceOf(OkLab::class, $color);
        $this->assertSame('oklab(0.93 0.01 -0.03)', $color->toString());
    }

    public function testCreateFromStringOkLch(): void
    {
        $color = Color::createFromString('oklch(0.93 0.03 285.8)');

        $this->assertInstanceOf(OkLch::class, $color);
        $this->assertSame('oklch(0.93 0.03 285.8)', $color->toString());
    }

    public function testCreateFromStringOkLchPercent(): void
    {
        $color = Color::createFromString('oklch(93% 75% 285.8)');

        $this->assertInstanceOf(OkLch::class, $color);
        $this->assertSame('oklch(0.93 0.03 285.8)', $color->toString());
    }

    public function testCreateFromStringProPhotoRgb(): void
    {
        $color = Color::createFromString('color(prophoto-rgb 0.89 0.88 0.96)');

        $this->assertInstanceOf(ProPhotoRgb::class, $color);
        $this->assertSame('color(prophoto-rgb 0.89 0.88 0.96)', $color->toString());
    }

    public function testCreateFromStringProPhotoRgbPercent(): void
    {
        $color = Color::createFromString('color(prophoto-rgb 89% 88% 96%)');

        $this->assertInstanceOf(ProPhotoRgb::class, $color);
        $this->assertSame('color(prophoto-rgb 0.89 0.88 0.96)', $color->toString());
    }

    public function testCreateFromStringRec2020(): void
    {
        $color = Color::createFromString('color(rec2020 0.89 0.89 0.97)');

        $this->assertInstanceOf(Rec2020::class, $color);
        $this->assertSame('color(rec2020 0.89 0.89 0.97)', $color->toString());
    }

    public function testCreateFromStringRec2020Percent(): void
    {
        $color = Color::createFromString('color(rec2020 89% 89% 97%)');

        $this->assertInstanceOf(Rec2020::class, $color);
        $this->assertSame('color(rec2020 0.89 0.89 0.97)', $color->toString());
    }

    public function testCreateFromStringRgb(): void
    {
        $color = Color::createFromString('rgb(230 230 250)');

        $this->assertInstanceOf(Rgb::class, $color);
        $this->assertSame('rgb(230 230 250)', $color->toString());
    }

    public function testCreateFromStringRgbaLegacy(): void
    {
        $color = Color::createFromString('rgba(230, 230, 250, 0.5)');

        $this->assertInstanceOf(Rgb::class, $color);
        $this->assertSame('rgb(230 230 250 / 50%)', $color->toString());
    }

    public function testCreateFromStringRgbLegacy(): void
    {
        $color = Color::createFromString('rgb(230, 230, 250)');

        $this->assertInstanceOf(Rgb::class, $color);
        $this->assertSame('rgb(230 230 250)', $color->toString());
    }

    public function testCreateFromStringRgbWithAlpha(): void
    {
        $color = Color::createFromString('rgb(230 230 250 / 50%)');

        $this->assertInstanceOf(Rgb::class, $color);
        $this->assertSame('rgb(230 230 250 / 50%)', $color->toString());
    }

    public function testCreateFromStringSrgb(): void
    {
        $color = Color::createFromString('color(srgb 0.9 0.9 0.98)');

        $this->assertInstanceOf(Srgb::class, $color);
        $this->assertSame('color(srgb 0.9 0.9 0.98)', $color->toString());
    }

    public function testCreateFromStringSrgbLinear(): void
    {
        $color = Color::createFromString('color(srgb-linear 0.79 0.79 0.96)');

        $this->assertInstanceOf(SrgbLinear::class, $color);
        $this->assertSame('color(srgb-linear 0.79 0.79 0.96)', $color->toString());
    }

    public function testCreateFromStringSrgbLinearPercent(): void
    {
        $color = Color::createFromString('color(srgb-linear 79% 79% 96%)');

        $this->assertInstanceOf(SrgbLinear::class, $color);
        $this->assertSame('color(srgb-linear 0.79 0.79 0.96)', $color->toString());
    }

    public function testCreateFromStringSrgbPercent(): void
    {
        $color = Color::createFromString('color(srgb 90% 90% 98%)');

        $this->assertInstanceOf(Srgb::class, $color);
        $this->assertSame('color(srgb 0.9 0.9 0.98)', $color->toString());
    }

    public function testCreateFromStringTransparent(): void
    {
        $color = Color::createFromString('transparent');

        $this->assertInstanceOf(Rgb::class, $color);
        $this->assertSame('transparent', $color->toString(name: true));
    }

    public function testCreateFromStringXyz(): void
    {
        $color = Color::createFromString('color(xyz 0.78 0.8 1.02)');

        $this->assertInstanceOf(XyzD65::class, $color);
        $this->assertSame('color(xyz-d65 0.78 0.8 1.02)', $color->toString());
    }

    public function testCreateFromStringXyzD50(): void
    {
        $color = Color::createFromString('color(xyz-d50 0.79 0.8 0.77)');

        $this->assertInstanceOf(XyzD50::class, $color);
        $this->assertSame('color(xyz-d50 0.79 0.8 0.77)', $color->toString());
    }

    public function testCreateFromStringXyzD50Percent(): void
    {
        $color = Color::createFromString('color(xyz-d50 79% 80% 77%)');

        $this->assertInstanceOf(XyzD50::class, $color);
        $this->assertSame('color(xyz-d50 0.79 0.8 0.77)', $color->toString());
    }

    public function testCreateFromStringXyzD65(): void
    {
        $color = Color::createFromString('color(xyz-d65 0.78 0.8 1.02)');

        $this->assertInstanceOf(XyzD65::class, $color);
        $this->assertSame('color(xyz-d65 0.78 0.8 1.02)', $color->toString());
    }

    public function testCreateFromStringXyzD65Percent(): void
    {
        $color = Color::createFromString('color(xyz-d65 78% 80% 102%)');

        $this->assertInstanceOf(XyzD65::class, $color);
        $this->assertSame('color(xyz-d65 0.78 0.8 1.02)', $color->toString());
    }

    public function testCreateFromStringXyzPercent(): void
    {
        $color = Color::createFromString('color(xyz 78% 80% 102%)');

        $this->assertInstanceOf(XyzD65::class, $color);
        $this->assertSame('color(xyz-d65 0.78 0.8 1.02)', $color->toString());
    }

    public function testCreateFromXyzD50(): void
    {
        $color = Color::createFromXyzD50(0.79, 0.8, 0.77);

        $this->assertInstanceOf(XyzD50::class, $color);
        $this->assertSame('color(xyz-d50 0.79 0.8 0.77)', $color->toString());
    }

    public function testCreateFromXyzD65(): void
    {
        $color = Color::createFromXyzD65(0.78, 0.8, 1.02);

        $this->assertInstanceOf(XyzD65::class, $color);
        $this->assertSame('color(xyz-d65 0.78 0.8 1.02)', $color->toString());
    }

    public function testGetAlpha(): void
    {
        $color = Color::createFromString('rgb(230 230 250 / 50%)');

        $this->assertSame(0.5, $color->getAlpha());
    }

    public function testMacroable(): void
    {
        $this->assertEmpty(
            array_diff([MacroTrait::class, StaticMacroTrait::class], class_uses(Color::class))
        );
    }

    public function testToInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Color::createFromString('lavender')->to('invalid');
    }
}
